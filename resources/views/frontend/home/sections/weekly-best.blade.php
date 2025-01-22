<?php $categoryProductSliderSectionThree = json_decode($categoryProductSliderSectionThree->value, true)?>
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @foreach ($categoryProductSliderSectionThree as $item)
                <?php
                    $lastKey = [];
                    foreach ($item as $key => $category){
                        if(!isset($category)){
                            break;
                        }
                        $lastKey = [$key => $category];
                    }
                    if(array_keys($lastKey)[0] == 'category'){
                        $category = \App\Models\Category::findOrFail($lastKey['category']);
                        $products = \App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->take(6)->get();
                    }elseif(array_keys($lastKey)[0] == 'sub_category'){
                        $category = \App\Models\SubCategory::findOrFail($lastKey['sub_category']);
                        $products = \App\Models\Product::where('sub_category_id', $category->id)->orderBy('id', 'DESC')->take(6)->get();
                    }elseif(array_keys($lastKey)[0] == 'child_category'){
                        $category = \App\Models\ChildCategory::findOrFail($lastKey['child_category']);
                        $products = \App\Models\Product::where('child_category_id', $category->id)->orderBy('id', 'DESC')->take(6)->get();
                    }
                ?>
                <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{$category->name}}</h3>
                    </div>
                    <div class="row weekly_best2">
                        {{-- <div class="col-xl-4 col-lg-4">
                            <a class="wsus__hot_deals__single" href="#">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="images/pro9.jpg" alt="bag" class="img-fluid w-100">
                                </div>
                                <div class="wsus__hot_deals__single_text">
                                    <h5>men's sholder bag</h5>
                                    <p class="wsus__rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </p>
                                    <p class="wsus__tk">$120.20 <del>130.00</del></p>
                                </div>
                            </a>
                        </div> --}}
                        @foreach ($products as $item)
                            <div class="col-xl-4 col-lg-4">
                                <a class="wsus__hot_deals__single" href="{{route('product-detail', $item->slug)}}">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{asset($item->thumb_image)}}" alt="bag" class="img-fluid w-100 cropB" style="height: 100px!important">
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
