<?php

namespace App\Services;

use App\Price;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PriceService
{
    const PER_PAGE = 10;

    /**
     * @param int|null $store_id
     * @param string $starts_at
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    public function getStorePrices(?int $store_id, string $starts_at, int $per_page = self::PER_PAGE): LengthAwarePaginator
    {
        $query = Price::with('product');

        if ($store_id) {
            $query->whereStoreId($store_id);
        }

        if ($starts_at) {
            $query->where('starts_at', '>=', $starts_at);
        }

        return $query->paginate($per_page);
    }
}