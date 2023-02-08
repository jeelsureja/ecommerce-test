<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- centers Navbar elements in a container -->

        <a class="navbar-brand" href="#">Ecommerce</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- ml-auto shifts nav items to right -->
                <li class="nav-item {{ Route::is('home*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item {{ Route::is('product*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('product-list') }}">Product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->full_name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping text-light mt-3 ml-2"></i></a>
                </li>
            </ul>
        </div>

    </div>
</nav>