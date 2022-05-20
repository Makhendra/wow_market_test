<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePriceRequest;
use App\Http\Requests\GeneratePriceListRequest;
use App\Price;
use App\Product;
use App\Services\PriceService;
use App\Store;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PriceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $stores = Store::select(['id', 'name'])->get();
        $products = Product::select(['id', 'name', 'code'])->get();
        return view('prices.form', [
            'title' => trans('texts.prices'),
            'action' => route('prices.store'),
            'method' => method_field('POST'),
            'stores' => $stores,
            'products' => $products,
            'today' => Carbon::today()->format('Y-m-d\TH:i:s'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePriceRequest $request
     * @return RedirectResponse
     */
    public function store(CreatePriceRequest $request): RedirectResponse
    {
        Price::create($request->validated());
        return Redirect::route('prices.index');
    }

    /**
     * @return Factory|Application|View
     */
    public function list()
    {
        $stores = Store::select(['id', 'name'])->get();
        return view('prices.list', [
            'action' => route('prices.generate'),
            'method' => method_field('post'),
            'stores' => $stores,
            'today' => Carbon::today()->format('Y-m-d\TH:i:s'),
        ]);
    }

    /**
     * @param PriceService $priceService
     * @param GeneratePriceListRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function generate(PriceService $priceService, GeneratePriceListRequest $request): JsonResponse
    {
        $prices = $priceService->getStorePrices($request->store_id, $request->starts_at, self::PER_PAGE);
        $html = view('prices.table', ['prices' => $prices])->render();
        return response()->json([
            'html' => $html
        ], Response::HTTP_OK);
    }

}
