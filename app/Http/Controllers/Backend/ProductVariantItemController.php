<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantItemDataTable;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.products.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $id){
        $variant = ProductVariant::findOrFail($id);
        return view('admin.products.product-variant-item.create', compact('variant'));
    }
}
