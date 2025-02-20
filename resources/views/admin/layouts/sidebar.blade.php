<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          {{-- <ul class="dropdown-menu">
            <li class=active><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul> --}}
        </li>

        <li class="menu-header">Starter</li>
        <li class="dropdown {{setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.category.*'])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Category</a></li>
            <li class="{{setActive(['admin.sub-category.*'])}}"><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub Category</a></li>
            <li class="{{setActive(['admin.child-category.*'])}}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Child Category</a></li>
          </ul>
        </li>

        <li class="dropdown {{setActive(['admin.order.*', 'admin.pending-orders', 'admin.processed-orders',
         'admin.dropped-off-orders', 'admin.shipped-orders', 'admin.out-for-delivery-orders', 'admin.delivered-orders', 'admin.canceled-orders'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Orders</span></a>
            <ul class="dropdown-menu">
                <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                    href="{{ route('admin.order.index') }}">All Orders</a></li>
                <li class="{{ setActive(['admin.pending-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.pending-orders') }}">All Pending Orders</a></li>
                <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.processed-orders') }}">All Processed Orders</a></li>
                <li class="{{ setActive(['admin.dropped-off-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.dropped-off-orders') }}">All Dropped Off Orders</a></li>
                <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.shipped-orders') }}">All Shipped Orders</a></li>
                <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.out-for-delivery-orders') }}">All Out For Delivery Orders</a></li>
                <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.delivered-orders') }}">All Delivered Orders</a></li>
                <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link"
                        href="{{ route('admin.canceled-orders') }}">All Canceled Orders</a></li>
            </ul>
        </li>

        <li class="{{setActive(['admin.transaction'])}}"><a href="{{route('admin.transaction')}}"
            class="nav-link"><i class="fas fa-square"></i><span>Transaction</span></a></li>

        <li class="dropdown {{setActive(['admin.vendor-profile.*', 'admin.slider.*', 'admin.home-page-settings'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
            <ul class="dropdown-menu">
              <li class="{{setActive(['admin.slider.*'])}}"><a class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
              <li class="{{setActive(['admin.vendor-profile.*'])}}"><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
              <li class="{{setActive(['admin.home-page-settings'])}}"><a class="nav-link" href="{{route('admin.home-page-settings')}}">Home Page Settings</a></li>
            </ul>
        </li>

        <li class="dropdown {{setActive(['admin.footer-info.*'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Footer</span></a>
            <ul class="dropdown-menu">
              <li class="{{setActive(['admin.footer-info.*'])}}"><a class="nav-link" href="{{route('admin.footer-info.index')}}">Footer Info</a></li>
            </ul>
        </li>

        <li class="dropdown {{setActive(['admin.flash-sale.*', 'admin.coupons.*', 'admin.shipping-rule.*', 'admin.payment-settings.*'])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Ecommerce</span></a>
            <ul class="dropdown-menu">
              <li class="{{setActive(['admin.flash-sale.*'])}}"><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sale</a></li>
              <li class="{{setActive(['admin.coupons.*'])}}"><a class="nav-link" href="{{route('admin.coupons.index')}}">Coupons</a></li>
              <li class="{{setActive(['admin.shipping-rule.*'])}}"><a class="nav-link" href="{{route('admin.shipping-rule.index')}}">Shipping Rule</a></li>
              <li class="{{setActive(['admin.payment-settings.*'])}}"><a class="nav-link" href="{{route('admin.payment-settings.index')}}">Payment Settings</a></li>
            </ul>
        </li>

        <li class="dropdown {{setActive(['admin.brand.*', 'admin.products.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Product</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.brand.*'])}}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
            <li class="{{setActive(['admin.products.*'])}}"><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
            <li class="{{setActive(['admin.seller-products.*'])}}"><a class="nav-link" href="{{route('admin.seller-products.index')}}">Seller Products</a></li>
            <li class="{{setActive(['admin.seller-pending-products.*'])}}"><a class="nav-link" href="{{route('admin.seller-pending-products.index')}}">Pending Product</a></li>
          </ul>
        </li>
        <li><a class="nav-link" href="{{route('admin.settings.index')}}"><i class="far fa-square"></i> <span>Settings</span></a></li>
      </ul>
    </aside>
  </div>
