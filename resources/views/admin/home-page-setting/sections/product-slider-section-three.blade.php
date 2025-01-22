<?php $sectionThreeProduct = json_decode($productSliderSectionThree->value)?>
<div class="tab-pane fade" id="list-settings3" role="tabpanel" aria-labelledby="list-settings-three">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.product-slider-section-three')}}" method="POST">
                @csrf
                @method('PUT')
                <h5>Part 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Main Category3</label>
                            <select name="cat_one" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$sectionThreeProduct[0]->category == $category->id ? 'selected' : ''}}
                                        value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                <?php $subCategories = \App\Models\SubCategory::where('category_id', $sectionThreeProduct[0]->category)->get() ?>
                                @foreach ($subCategories as $subCategory)
                                    <option {{$sectionThreeProduct[0]->sub_category == $subCategory->id ? 'selected' : ''}}
                                        value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select name="child_cat_one" id="" class="form-control child-category">
                                <option value="">Select</option>
                                <?php $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sectionThreeProduct[0]->sub_category)->get() ?>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$sectionThreeProduct[0]->child_category == $childCategory->id ? 'selected' : ''}}
                                        value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <h5>Part 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Main Category3</label>
                            <select name="cat_two" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$sectionThreeProduct[1]->category == $category->id ? 'selected' : ''}}
                                        value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_cat_two" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                <?php $subCategories = \App\Models\SubCategory::where('category_id', $sectionThreeProduct[1]->category)->get() ?>
                                @foreach ($subCategories as $subCategory)
                                    <option {{$sectionThreeProduct[1]->sub_category == $subCategory->id ? 'selected' : ''}}
                                        value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select name="child_cat_two" id="" class="form-control child-category">
                                <option value="">Select</option>
                                <?php $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sectionThreeProduct[1]->sub_category)->get() ?>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$sectionThreeProduct[1]->child_category == $childCategory->id ? 'selected' : ''}}
                                        value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                let row = $(this).closest('.row')
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subCategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        let selector = row.find('.sub-category')
                        selector.html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            selector.append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                let row = $(this).closest('.row')
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        let selector = row.find('.child-category')
                        selector.html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            selector.append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush

