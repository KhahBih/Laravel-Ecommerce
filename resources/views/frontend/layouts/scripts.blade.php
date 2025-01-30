<script>
    $(document).ready(function(){
            getSidebarCartSubtotal()
            $('body').on('submit', '.shopping-cart-form', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: "{{ route('add-to-cart') }}",
                    success: function(data) {
                        if(data.status == 'success'){
                            getCartCount();
                            fetchSidebarCartProducts();
                            getSidebarCartSubtotal();
                            $('.mini_cart_actions').removeClass('d-none')
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            $('body').on('click', '.remove_sidebar_product', function(e) {
                e.preventDefault();
                let rowId = $(this).data('rowid')
                $.ajax({
                    method: 'POST',
                    url: "{{ route('cart.remove-sidebar-product')}}",
                    data:{
                        rowId: rowId
                    },
                    success: function(data) {
                        let productId = '#mini_cart_' + data.rowId;
                        $(productId).remove();
                        getCartCount();
                        getSidebarCartSubtotal();
                        if($('.mini_cart_wrapper').find('li').length == 0){
                            $('.mini_cart_actions').addClass('d-none')
                            $('.mini_cart_wrapper').html('<li class="text-center">Cart is empty</li>')
                        }
                        toastr.success(data.message);
                    },
                    error: function(data) {
                        console.log(data);

                    }
                })
            })

            function getCartCount() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart-count') }}",
                    success: function(data) {
                        $('#cart-count').text(data);
                    },
                    error: function(data) {

                    }
                })
            }
            function fetchSidebarCartProducts(){
                    $.ajax({
                        url: "{{route('cart-products')}}",
                        method: 'GET',
                        success: function(data){
                            $('.mini_cart_wrapper').html("");
                            var html = "";
                            for(let item in data){
                                let product = data[item]
                                let price = (product.price + product.options.variants_total) * product.qty
                                let variantsPrice = product.options.variants_total
                                html += `<li id="mini_cart_${product.rowId}">
                                    <div class="wsus__cart_img">
                                        <a href="">
                                            <img src="{{asset('/')}}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                        <a class="wsis__del_icon remove_sidebar_product" data-rowId="${product.rowId}" href="">
                                            <i class="fas fa-minus-circle"></i></a>
                                    </div>
                                    <div class="wsus__cart_text">
                                        <a class="wsus__cart_title" href="{{url('product-detail/')}}/${product.options.slug}">${product.name}</a>
                                        <p style="font-weight: 300!important; font-size: 15px!important;">Total price: ${price}{{$settings->currency_icon}}</p>
                                        <small>Variant price: ${variantsPrice}{{$settings->currency_icon}}</small>
                                        <small>Quantity: ${product.qty}</small>
                                    </div>
                                </li>`
                            }
                            $('.mini_cart_wrapper').html(html);
                        },
                        error: function(data){

                        }
                    })
            }

            function getSidebarCartSubtotal(){
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.total') }}",
                    success: function(data) {
                        $('#mini_cart_subtotal').html(`sub total <span>${data}{{$settings->currency_icon}}</span>`)
                    },
                    error: function(data) {

                    }
                })
            }

            // Add product to wishlist
            $('.wishlist').on('click', function(e){
                e.preventDefault()
                let id = $(this).data()
                $.ajax({
                    method: 'GET',
                    url: "{{route('user.wishlist.add')}}",
                    data: {
                        id: id
                    },
                    success: function(data){
                        if(data){
                            toastr.success(data.message)
                        }else if(data.status == 'error'){
                            toastr.error(data.message)
                        }
                    },
                    error: function(data){
                        toastr.error(data.message)
                    }
                })

            })
        })

</script>
