<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.product-slider-section-one')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Main Category</label>
                            <select name="cat_one" id="" class="form-control main-category">
                                <option value="">Select</option>
                                <?php $sectionOneProduct = json_decode($productSliderSectionOne->value); ?>
                                @foreach ($categories as $category)
                                    <option {{$sectionOneProduct->category == $category->id ? 'selected' : ''}}
                                        value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <?php $subCategories = \App\Models\SubCategory::where('category_id', $sectionOneProduct->category)->get() ?>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($subCategories as $subCategory)
                                    <option {{$sectionOneProduct->sub_category == $subCategory->id ? 'selected' : ''}}
                                        value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <?php $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sectionOneProduct->sub_category)->get() ?>
                            <select name="child_cat_one" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$sectionOneProduct->child_category == $childCategory->id ? 'selected' : ''}}
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

