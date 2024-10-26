<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SellerProductsDataTable;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable){
        return $dataTable->render('admin.products.seller-product.index');
    }
}
