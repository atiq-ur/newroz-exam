<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.index') }}"><img src="{{ asset('backend/assets/images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ Route::is('admin.index') ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="ti-dashboard"></i> <span>dashboard</span></a></li>
                    {{--<li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sidebar
                                    Types
                                </span></a>
                        <ul class="collapse">
                            <li><a href="index.html">Left Sidebar</a></li>
                            <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                        </ul>
                    </li>--}}
                    <li class="{{ Route::is('products.index') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}"> <i class="ti-cloud"></i><span>Products</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('order.index') ? 'active' : '' }}">
                        <a href="{{ route('order.index') }}"> <i class="ti-cloud"></i><span>Order Product</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('order.lists') ? 'active' : '' }}">
                        <a href="{{ route('order.lists') }}"> <i class="ti-paint-roller"></i><span>Manage Orders</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('preOrder.index') ? 'active' : '' }}">
                        <a href="{{ route('preOrder.offers.index') }}"> <i class="ti-paint-roller"></i><span>Manage Offers</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('preOrder.orders.index') ? 'active' : '' }}">
                        <a href="{{ route('preOrder.orders.index') }}"> <i class="ti-paint-bucket"></i><span>Pre Order</span>
                        </a>
                    </li>
                   {{-- <li class="{{ Route::is('admin.portfolio.index') || Route::is('admin.portfolio.edit') ? 'active' : '' }}"><a href="{{ route('admin.portfolio.index') }}"
                        > <i class="ti-image"></i><span>Portfolio</span>
                        </a>
                    </li>--}}
                    {{--<li>
                        --}}{{--<a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>--}}{{--
                        <a class="dropdown-item" href="#logoutModal" data-toggle="modal" data-target="#logoutModal">Log Out</a>
                    </li>--}}
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
