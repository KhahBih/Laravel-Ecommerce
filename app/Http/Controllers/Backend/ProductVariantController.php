<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantDataTable;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.products.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'status' =>['required']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.products-variant.index', ['product' => $request->product]);
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
        return view('admin.products.product-variant.edit', compact('productVariant'));
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
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin.products-variant.index', ['product' => $request->product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariantItemCheck = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();
        if($productVariantItemCheck > 0){
            return response(['status' => 'error', 'message' => 'This variant contain items in it, delete variant items first!']);
        }
        $productVariant->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
