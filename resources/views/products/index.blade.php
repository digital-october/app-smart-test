@extends('layouts.app')


@section('content')

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @for($i = $data['start']; $i < $data['end']; $i++)
            <li class="page-item">
                <a class="page-link"
                   href="{{ route('products.index', ['page' => $i, 'search_terms' => request()->search_terms]) }}">
                    {{ $i }}
                </a>
            </li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>

            <span>Page: {{ $data['page'] }} skip: {{ $data['skip'] }} from ({{ $data['count'] }})</span>
        </ul>


    </nav>

    <div class="row">
        @foreach($data['products'] as $product)
            <div class="col-md-4 gallery">
                <div class="card mb-4 shadow-sm frame">
                    <img class="bd-placeholder-img card-img-top"
                         src="{{ $product['image_url'] ?? 'http://www.w3.org/2000/svg' }}"/>
                    <div class="card-body">
                        <h4>{{ $product['product_name'] ?? 'Without name' }}</h4>
                        <p class="card-text">
                            <b>Categories:</b> {{ $product['categories'] ?? 'null' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <form method="POST" action="{{ route('products.store') }}"
                                      class="form-inline mt-3 d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" name="image_url" value="{{ $product['image_url'] }}">
                                    <input type="hidden" name="product_name" value="{{ $product['product_name'] }}">
                                    <input type="hidden" name="categories" value="{{ $product['categories'] }}">
                                    <input type="hidden" name="_id" value="{{ $product['_id'] }}">
                                    @if ($product['saved'])
                                        <button type="submit" class="btn btn-sm btn-outline-warning">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-success">Save</button>
                                    @endif
                                </form>
                            </div>
                            <small class="text-muted">{{ $product['_id'] ?? 'null' }} mins</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection

<style>
    .gallery {
        overflow: hidden;
        width: 480px;
    }

    .gallery .frame {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .gallery img {
        width: 338px;
        height: 330px;
        object-fit: contain;
        background-color: #63676e;
    }
</style>
