<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductDataTable;
use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable){
        return $dataTable->render('admin.products.seller-product.index');
    }

    public function pending(SellerPendingProductDataTable $dataTable){
        return $dataTable->render('admin.products.pending-products.index');
    }

    public function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();
        return response(['message' => 'Product Approve Status Has Been Changed']);
    }
}
