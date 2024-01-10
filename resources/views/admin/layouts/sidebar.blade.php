<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image pull-left">
                @if (empty(Auth::user()->avatar))
                    <img src="{{ asset('backend/assets/dist/img/avatar5.png') }}" class="img-circle"
                        alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('') }}{{ Auth::user()->avatar }}" class="img-circle"
                        alt="{{ Auth::user()->name }}">
                @endif

            </div>
            <div class="info">
                <h4>Welcome</h4>
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-hospital-o"></i><span>Dashboard</span>
                </a>
            </li>
            <li
                class="treeview {{ Request::routeIs('rolePermission') ? 'active' : '' }} {{ Request::routeIs('assign.permission.form') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-shield" aria-hidden="true"></i>
                    <span>Role & Permission</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li
                        class="{{ Request::routeIs('rolePermission') ? 'active' : '' }} {{ Request::routeIs('assign.permission.form') ? 'active' : '' }}">
                        <a href="{{ route('rolePermission') }}">Roll & Permission</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::routeIs('user.*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Mange User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ Request::routeIs('user.index') ? 'active' : '' }}"><a
                            href="{{ route('user.index') }}">Users</a></li>
                    <li class=" {{ Request::routeIs('user.add') ? 'active' : '' }}"><a
                            href="{{ route('user.add') }}">Add New User</a></li>
                    <li class=" {{ Request::routeIs('user.trashed.items') ? 'active' : '' }}"><a
                            href="{{ route('user.trashed.items') }}">Trashed User List</a></li>
                </ul>
            </li>
            <li
                class="treeview {{ Request::routeIs('category.*') ? 'active' : '' }} {{ Request::routeIs('subcategory.*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i><span>Manage Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('category.*') ? 'active' : '' }}"><a
                            href="{{ route('category.index') }}">Category</a></li>
                    <li class="{{ Request::routeIs('subcategory.*') ? 'active' : '' }}"><a
                            href="{{ route('subcategory.index') }}">Sub Category</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::routeIs('brand.*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-certificate" aria-hidden="true"></i>
                    <span>Manage Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('brand.*') ? 'active' : '' }}"><a
                            href="{{ route('brand.index') }}">Brand</a></li>
                </ul>
            </li>

            <li class="treeview {{ Request::routeIs('coupon.*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-ticket"></i>
                    <span>Mange Coupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('coupon.index') ? 'active' : '' }}"><a
                            href="{{ route('coupon.index') }}">Coupons</a></li>
                    <li class="{{ Request::routeIs('coupon.trashed.items') ? 'active' : '' }}"><a
                            href="{{ route('coupon.trashed.items') }}">Trashed Coupon Items</a></li>
                </ul>
            </li>

            <li class="treeview {{ Request::routeIs('product.*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-cube"></i><span>Manage Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('product.create') ? 'active' : '' }}"><a
                            href="{{ route('product.create') }}">Add New Product</a></li>
                    <li class="{{ Request::routeIs('product.index') ? 'active' : '' }}"><a
                            href="{{ route('product.index') }}">Product List</a></li>
                    <li class="{{ Request::routeIs('product.trashed.items') ? 'active' : '' }}"><a
                            href="{{ route('product.trashed.items') }}">Trashed Product List</a></li>
                </ul>
            </li>

            <li
                class="treeview {{ Request::routeIs('customerReview.*') ? 'active' : '' }} {{ Request::routeIs('influentialReview.*') ? 'active' : '' }}">
                <a href="#"
                    class="{{ Request::routeIs('customerReview.trashed.items') ? 'text-danger' : '' }}{{ Request::routeIs('influentialReview.trashed.items') ? 'text-danger' : '' }}">
                    <i class="fa fa-star"></i><span>Manage Review</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('customerReview.index') ? 'active' : '' }}"><a
                            href="{{ route('customerReview.index') }}">Customer Review</a></li>
                    <li class="{{ Request::routeIs('influentialReview.index') ? 'active' : '' }}"><a
                            href="{{ route('influentialReview.index') }}">Influential Review</a></li>
                    <li class="{{ Request::routeIs('influentialReview.trashed.items') ? 'active' : '' }}"><a
                            href="{{ route('influentialReview.trashed.items') }}"
                            class="{{ Request::routeIs('influentialReview.trashed.items') ? 'text-danger' : '' }}">Trashed
                            Influential Review</a></li>
                </ul>
            </li>









            <li class="treeview {{ Request::routeIs('order.*') ? 'active' : '' }}">
                <a href="#" class="{{ Request::routeIs('order.show.trashed.items') ? 'text-danger' : '' }}">
                    <i class="fa fa-list-ul"></i><span>Manage Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::routeIs('order.index') ? 'active' : '' }}"><a
                            href="{{ route('order.index') }}">All Order List</a></li>
                    <li class="{{ Request::routeIs('order.status.list.tab') ? 'active' : '' }}"><a
                            href="{{ route('order.status.list.tab') }}">Order Status List Tab</a></li>
                    <li class="{{ Request::routeIs('order.show.trashed.items') ? 'active' : '' }}"><a
                            href="{{ route('order.show.trashed.items') }} "
                            class="{{ Request::routeIs('order.show.trashed.items') ? 'text-danger' : '' }}">Trashed
                            Order List</a></li>
                </ul>
            </li>






        </ul>
    </div> <!-- /.sidebar -->
</aside>
