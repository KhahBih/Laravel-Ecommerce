<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
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

        // $request->validate([
        //     'image' => ['required', 'image', 'max:3048'],
        //     'name' => ['required', 'max:40'],
        //     'category' => ['required'],
        //     'brand' => ['required'],
        //     'price' => ['required'],
        //     'qty' => ['required'],
        //     'short_desc' => ['required', 'max:500'],
        //     'long_desc' => ['required'],
        //     'is_top' => ['required'],
        //     'is_best' => ['required'],
        //     'is_featured' => ['required']
        // ]);

        // $product = new Product();
        // // $product->thumb_image = '';
        // // $product->name = $request->name;
        // // $product->vendor_id = $request->name;
        // // $product->name = $request->name;
        dd(Auth::user()->vendor);
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
        //
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
