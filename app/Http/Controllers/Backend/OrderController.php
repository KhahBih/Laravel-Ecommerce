<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrdersDataTable;
use App\DataTables\ProcessedOrdersDataTable;
use App\DataTables\DroppedOffOrdersDataTable;
use App\DataTables\ShippedOrdersDataTable;
use App\DataTables\OutForDeliveryOrdersDataTable;
use App\DataTables\DeliveredOrdersDataTable;
use App\DataTables\CanceledOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function pendingOrders(PendingOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-orders');
    }

    public function processedOrders(ProcessedOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-orders');
    }

    public function droppedOffOrders(DroppedOffOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-off-orders');
    }

    public function shippedOrders(ShippedOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-orders');
    }

    public function outForDeliveryOrders(OutForDeliveryOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery-orders');
    }

    public function deliveredOrders(DeliveredOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-orders');
    }

    public function canceledOrders(CanceledOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled-orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        // delete order products
        $order->orderProducts()->delete();
        // delete transaction
        $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Updated Order Status!']);
    }

    public function changePaymentStatus(Request $request)
    {
        $payment = Order::findOrFail($request->id);
        $payment->payment_status = $request->status;
        $payment->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status!']);
    }
}
