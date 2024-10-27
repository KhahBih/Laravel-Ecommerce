<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SellerProductsDataTable;
use App\DataTables\SellerPendingProductDataTable;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable){
        return $dataTable->render('admin.products.seller-product.index');
    }

    public function pending(SellerPendingProductDataTable $dataTable){
        return $dataTable->render('admin.products.pending-products.index');
    }
}
