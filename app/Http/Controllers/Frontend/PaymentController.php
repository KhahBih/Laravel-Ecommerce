<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index(){
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }else{
            return view('frontend.pages.payment');
        }
    }

    public function clearSession(){
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName){
        // Store Order
        $order = new Order();
        $setting = GeneralSetting::first();
        $order->invocie_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->default_currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 0;

        $order->save();

        // Store Order Product
        foreach(Cart::content() as $item){
            $product = Product::findOrFail($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();
        }

        // Store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;
        $transaction->save();
    }

    public function paymentSuccess(){

        return view('frontend.pages.payment-success');
    }

    public function paymentCancel(){
        toastr('Something went wrong, please try again later!', 'error', 'error');
        return view('frontend.pages.payment-success');
    }

    public function paypalConfig(){
        $paypalSetting = PaypalSetting::first();
        $config = [
            // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'mode'    => $paypalSetting->mode == 1 ? 'live' : 'sandbox', //env('PAYPAL_MODE', 'sandbox')
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id, //env('PAYPAL_SANDBOX_CLIENT_ID', ''),
                'client_secret'     => $paypalSetting->secret_key, //env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id, //env('PAYPAL_SANDBOX_CLIENT_ID', ''),
                'client_secret'     => $paypalSetting->secret_key, //env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
                'app_id'            => '',
            ],
            // Can only be 'Sale', 'Authorization' or 'Order'
            'payment_action' => 'Sale',  //env('PAYPAL_PAYMENT_ACTION', 'Sale'),
            'currency'       => $paypalSetting->currency_name,   //env('PAYPAL_CURRENCY', 'USD'),
            'notify_url'     => '',  //env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => 'en_US',  //env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true  //env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
        return $config;
    }

    public function payWithPaypal(){
        $paypalSetting = PaypalSetting::first();
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        // $provider->setApiCredentials($config);

        // Calculate payable amount
        $total = getFinalPayableAmount();
        $payableAmount = round($total, 2);
        // $payableAmount = round($total*$paypalSetting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != null){
            foreach($response['links'] as $link){
                if($link['rel'] == 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request){
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);
        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            $paypalSetting = PaypalSetting::first();
            $total = getFinalPayableAmount();
            $payableAmount = round($total*$paypalSetting->currency_rate, 2);
            $this->storeOrder('paypal', 1, $response['id'], $payableAmount, $paypalSetting->currency_name);
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }
        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel(){

    }
}
