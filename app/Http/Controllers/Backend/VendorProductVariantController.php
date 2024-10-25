<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\VendorProductVariantDataTable;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductVariantDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' =>['required', 'integer'],
            'name' => ['required', 'max:100'],
            'status' =>['required']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Created Successfully!', 'success', 'success');
        return redirect()->route('vendor.products-variant.index', ['product' => $request->product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        if($productVariant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return view('vendor.product.product-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>['max: 50']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $request->name;
        $productVariant->product_id = $request->product;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->route('vendor.products-variant.index', ['product' => $request->product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        if($variant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        $variant->delete();
        toastr('Updated Successfully!', 'success');
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
