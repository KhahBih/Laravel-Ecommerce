<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantItemDataTable;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.products.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId){
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('admin.products.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = new ProductVariantItem();
        $productVariantItem->product_variant_id = $request->variant_id;
        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Created Successfully!', 'success', 'success');
        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }

    public function edit(string $productVariantItemId){
        $productVariantItem = ProductVariantItem::findOrFail($productVariantItemId);
        return view('admin.products.product-variant-item.edit', compact('productVariantItem'));
    }

    public function update(string $productVariantItemId, Request $request){
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = ProductVariantItem::findOrFail($productVariantItemId);
        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->route('admin.products-variant-item.index',
        ['productId' => $productVariantItem->productVariant->product_id, 'variantId' => $productVariantItem->product_variant_id]);
    }

    public function destroy(string $productVariantItemId){
        $productVariantItem = ProductVariantItem::findOrFail($productVariantItemId);
        $productVariantItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}