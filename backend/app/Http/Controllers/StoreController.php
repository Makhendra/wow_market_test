<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateStoreRequest;
use App\Store;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Redirect;

class StoreController extends Controller
{

    /**
     * @return RedirectResponse
     */
    private function redirectStoresPage(): RedirectResponse
    {
        return Redirect::route('stores.index');
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $stores = Store::paginate(self::PER_PAGE);
        return view('stores.list', ['stores' => $stores]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('stores.form', [
            'action' => route('stores.store'),
            'title' => trans('texts.new_store'),
            'method' => method_field('POST'),
        ]);
    }

    /**
     * @param CreateOrUpdateStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrUpdateStoreRequest $request): RedirectResponse
    {
        Store::create($request->validated());
        return $this->redirectStoresPage();
    }

    /**
     * @param Store $store
     * @return Application|Factory|View
     */
    public function edit(Store $store)
    {
        return view('stores.form', [
            'action' => route('stores.update', $store->id),
            'title' => trans('texts.edit_store'),
            'method' => method_field('PUT'),
            'store' => $store
        ]);
    }

    /**
     * @param CreateOrUpdateStoreRequest $request
     * @param Store $store
     * @return RedirectResponse
     */
    public function update(CreateOrUpdateStoreRequest $request, Store $store): RedirectResponse
    {
        Store::findOrFail($store->id)->update($request->validated());
        return $this->redirectStoresPage();
    }

    /**
     * @param Store $store
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Store $store): RedirectResponse
    {
        Store::findOrFail($store->id)->delete();
        return $this->redirectStoresPage();
    }
}
