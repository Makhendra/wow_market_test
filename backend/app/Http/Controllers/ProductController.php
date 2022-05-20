<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateProductRequest;
use App\Product;
use App\Services\FileService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;

class ProductController extends Controller
{
    /**
     * @return RedirectResponse
     */
    private function redirectProductsPage(): RedirectResponse
    {
        return Redirect::route('products.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::with(['images'])->orderBy('id')->paginate(self::PER_PAGE);
        return view('products.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('products.form', [
            'action' => route('products.store'),
            'title' => trans('texts.new_product'),
            'method' => method_field('POST'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrUpdateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrUpdateProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());
        if ($request->hasFile('image')) {
            app(FileService::class)->saveFile(Product::class, $product->id, $request->file('image'));
        }

        return $this->redirectProductsPage();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        return view('products.form', [
            'action' => route('products.update', $product->id),
            'title' => trans('texts.edit_product'),
            'method' => method_field('PUT'),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateOrUpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(CreateOrUpdateProductRequest $request, Product $product): RedirectResponse
    {
        Product::findOrFail($product->id)->update($request->validated());

        if ($request->hasFile('image') && !$request->get('image_delete')) {
            app(FileService::class)->saveFile(Product::TYPE, $product->id, $request->file('image'));
        }

        if($request->get('image_delete')) {
            app(FileService::class)->deleteFile(Product::TYPE, $product->id);
        }

        return $this->redirectProductsPage();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        Product::findOrFail($product->id)->delete();
        return $this->redirectProductsPage();
    }
}
