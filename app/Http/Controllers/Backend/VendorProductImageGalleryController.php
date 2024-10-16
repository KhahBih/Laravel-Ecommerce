<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductImageGallery;
use App\DataTables\VendorProductImageGalleryDataTable;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
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
        $request->validate([
            'image.*' => ['required', 'max:3048', 'image']
        ]);
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');
        foreach($imagePaths as $imagePath){
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $imagePath;
            $productImageGallery->product_id = $request->product;
            $productImageGallery->save();
        }

        toastr('Upload Successfully!', 'success');
        return redirect()->route('vendor.vendor-product-image-gallery.index', ['product' => $request->product]);
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
        $productImage = ProductImageGallery::findOrFail($id);
        $this->deleteImage($productImage->image);
        $productImage->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
