<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImageGallery;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3048'],
            'name' => ['required', 'max:40'],
            'category' => ['required'],
            'sub_category' => ['nullable'],
            'child_category' => ['nullable'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_desc' => ['required', 'max:500'],
            'long_desc' => ['required'],
            'seo_title' => ['max:200', 'nullable'],
            'seo_desc' => ['max:1000', 'nullable'],
            'status' => ['required']
        ]);

        // Handle image upload
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->quantity = $request->qty;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_desc = $request->seo_desc;
        $product->status = $request->status;
        $product->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.products.index');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $productTypes = ['new_arrival', 'featured_product', 'top_product', 'best_product'];
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories', 'productTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'max:3048'],
            'name' => ['required', 'max:40'],
            'category' => ['required'],
            'sub_category' => ['nullable'],
            'child_category' => ['nullable'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_desc' => ['required', 'max:500'],
            'long_desc' => ['required'],
            'seo_title' => ['max:200', 'nullable'],
            'seo_desc' => ['max:1000', 'nullable'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

        // Handle image upload
        $imagePath = $this->updateImage($request, 'image', 'uploads', asset($product->thumb_image));

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->quantity = $request->qty;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_desc = $request->seo_desc;
        $product->status = $request->status;
        $product->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // Delete product main image
        $this->deleteImage($product->thumb_image);
        // Delete product image gallery
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        $productVariants = ProductVariant::where('product_id', $product->id)->get();
        foreach($productVariants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }
        $product->delete();

        toastr('success', 'Deleted Successfully!');
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();
        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childCategories;
    }
}
