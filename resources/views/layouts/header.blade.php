<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">

            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>Products</strong>
            </a>

            <form method="GET" action="{{ route('products.index') }}" class="form-inline mt-3 d-flex align-items-center">
                <input class="form-control mr-sm-2" name="search_terms" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

        </div>


    </div>
</header>
