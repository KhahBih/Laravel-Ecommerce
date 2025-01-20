<?php $popularCategories = json_decode($popularCategory->value); $products = [];?>
<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="wsus__monthly_top_banner">
                    <div class="wsus__monthly_top_banner_img">
                        <img src="images/monthly_top_img3.jpg" alt="img" class="img-fluid w-100">
                        <span></span>
                    </div>
                    <div class="wsus__monthly_top_banner_text">
                        <h4>Black Friday Sale</h4>
                        <h3>Up To <span>70% Off</span></h3>
                        <H6>Everything</H6>
                        <a class="shop_btn" href="#">shop now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">
                        @foreach ($popularCategories as $key => $popularCategory)
                            <?php
                                $lastKey = [];
                                foreach ($popularCategory as $key => $category){
                                    if(!isset($category)){
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                if(array_keys($lastKey)[0] == 'category'){
                                    $category = \App\Models\Category::findOrFail($lastKey['category']);
                                    $products[] = \App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }elseif(array_keys($lastKey)[0] == 'sub_category'){
                                    $category = \App\Models\SubCategory::findOrFail($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::where('sub_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }elseif(array_keys($lastKey)[0] == 'child_category'){
                                    $category = \App\Models\ChildCategory::findOrFail($lastKey['child_category']);
                                    $products[] = \App\Models\Product::where('child_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }
                            ?>
                            <button class="{{$loop->index === 0 ? 'autoClick active' : ''}}" data-filter=".category-{{$loop->index}}">{{$category->name}}</button>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{$key}}">
                                <a class="wsus__hot_deals__single" href="#">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{asset($item->thumb_image)}}" alt="bag" class="img-fluid w-100 h-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!!limitText($item->name, 20)!!}</h5>
                                        <p class="wsus__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </p>
                                        <p class="wsus__tk">
                                            @if (checkDiscount($item))
                                                {{$item->offer_price}} {{$settings->currency_icon}} <del>{{$item->price}} {{$settings->currency_icon}}</del>
                                            @else
                                                {{$item->price}} {{$settings->currency_icon}}
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

