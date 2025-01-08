<!-- resources/views/partials/sidebar.blade.php -->
<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/home') }}">
                Home
            </a>
        </li>

        <!-- Category 1 -->
        <li class="nav-item">
            <a href="#category1Submenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                Category 1
            </a>
            <ul class="collapse list-unstyled" id="category1Submenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customers') ? 'active' : '' }}" href="{{ url('/customers') }}">
                        Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('patients') ? 'active' : '' }}" href="{{ url('/patients') }}">
                        Patients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('invoices') ? 'active' : '' }}" href="{{ url('/invoices') }}">
                        Invoices
                    </a>
                </li>
            </ul>
        </li>

        <!-- Category 2 -->
        <li class="nav-item">
            <a href="#category2Submenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                Category 2
            </a>
            <ul class="collapse list-unstyled" id="category2Submenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category2/item1') ? 'active' : '' }}" href="{{ url('/category2/item1') }}">
                        Item 1
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category2/item2') ? 'active' : '' }}" href="{{ url('/category2/item2') }}">
                        Item 2
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category2/item3') ? 'active' : '' }}" href="{{ url('/category2/item3') }}">
                        Item 3
                    </a>
                </li>
            </ul>
        </li>

        <!-- Category 3 -->
        <li class="nav-item">
            <a href="#category3Submenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                Category 3
            </a>
            <ul class="collapse list-unstyled" id="category3Submenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category3/item1') ? 'active' : '' }}" href="{{ url('/category3/item1') }}">
                        Item 1
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category3/item2') ? 'active' : '' }}" href="{{ url('/category3/item2') }}">
                        Item 2
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category3/item3') ? 'active' : '' }}" href="{{ url('/category3/item3') }}">
                        Item 3
                    </a>
                </li>
            </ul>
        </li>

        <!-- Contact Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">
                Contact
            </a>
        </li>
    </ul>
</div>
