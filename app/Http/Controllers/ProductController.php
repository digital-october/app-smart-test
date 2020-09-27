<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Source\Openfoodfacts\OpenfoodfactsSource;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\IndexProductsRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexProductsRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\OpenFoodsFacts\OopsException
     */
    public function index(IndexProductsRequest $request)
    {
        $defaultParameters = [
            'action' => 'process',
            'sort_by' => 'unique_scans_n',
            'json' => 1,
        ];
        $parameters = array_merge($defaultParameters, $request->validated());
        $data = OpenfoodfactsSource::get($parameters);
        $data['products'] = OpenfoodfactsSource::checkExists($data['products']);

        return view('products.index', compact('data'));
    }

    /**
     * Store a newly or Update existing resource in storage.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        Product::updateOrCreate([
            '_id' => $request->_id
        ], $request->validated());

        return redirect()->back();
    }

}
