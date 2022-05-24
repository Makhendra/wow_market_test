<?php

namespace App\Services;

use App\Price;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PriceService
{
    const PER_PAGE = 10;

    /**
     * @param int|null $storeId
     * @param string $startsAt
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getStorePrices(?int $storeId, string $startsAt, int $perPage = self::PER_PAGE): LengthAwarePaginator
    {
        $query = Price::with('product');

        if ($storeId) {
            $query->whereStoreId($storeId);
        }

        if ($startsAt) {
            $query->where('starts_at', '>=', $startsAt);
        }

        return $query->paginate($perPage);
    }
}