<?php

namespace App\Http\Controllers;

use App\DTO\SourceImageDTO;
use App\Http\Requests\CreateOrUpdateProductRequest;
use App\Price;
use App\Product;
use App\Services\FileService;
use App\Services\ImageService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
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
    public function store(
        CreateOrUpdateProductRequest $request
    ): RedirectResponse
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('image')) {
            $sourceImageDTO = SourceImageDTO::create(Product::TYPE, $product->id);
            $this->saveImage($request->file('image'), $sourceImageDTO);
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
    public function update(
        CreateOrUpdateProductRequest $request,
        Product                      $product
    ): RedirectResponse
    {
        Product::findOrFail($product->id)->update($request->validated());
        $sourceImageDTO = SourceImageDTO::create(Product::TYPE, $product->id);

        if ($request->hasFile('image') && !$request->get('image_delete')) {
            $this->saveImage($request->file('image'), $sourceImageDTO);
        }

        if ($request->get('image_delete')) {
            $this->deleteImage($sourceImageDTO);
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
        $product = Product::findOrFail($product->id);

        Price::whereProductId($product->id)->delete();
        $this->deleteImage(SourceImageDTO::create(Product::TYPE, $product->id));
        $product->delete();

        return $this->redirectProductsPage();
    }

    /**
     * @param UploadedFile $image
     * @param SourceImageDTO $sourceImageDTO
     * @return void
     */
    public function saveImage(UploadedFile $image, SourceImageDTO $sourceImageDTO)
    {
        $path = app(FileService::class)->saveFile($image, $sourceImageDTO->getDirectoryPath());
        app(ImageService::class)->createOrUpdate($sourceImageDTO, $path);
    }

    /**
     * @param SourceImageDTO $sourceImageDTO
     * @return void
     * @throws Exception
     */
    public function deleteImage(SourceImageDTO $sourceImageDTO)
    {
        $imageService = app(ImageService::class);
        $fileService = app(FileService::class);

        $image = $imageService->find($sourceImageDTO);
        $fileService->deleteFile($image->path);
        $imageService->delete($sourceImageDTO);
    }
}
