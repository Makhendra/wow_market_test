<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateProductRequest;
use App\Price;
use App\Product;
use App\Services\FileService;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;

class ProductController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::with(['images'])->orderBy('id')->paginate(self::PER_PAGE);
        return view('products.list', ['products' => $products]);
    }

    /**
     * @param CreateOrUpdateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrUpdateProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('image')) {
            app(FileService::class)->saveFile(Product::TYPE, $product->id, $request->file('image'));
        }

        return $this->redirectProductsPage();
    }

    /**
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
     * @return RedirectResponse
     */
    private function redirectProductsPage(): RedirectResponse
    {
        return Redirect::route('products.index');
    }

    /**
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
            app(FileService::class)->deleteFileRelation(Product::TYPE, $product->id);
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
        Price::whereProductId($product->id)->delete();
        app(FileService::class)->deleteFileRelation(Product::TYPE, $product->id);
        Product::findOrFail($product->id)->delete();
        return $this->redirectProductsPage();
    }
}
