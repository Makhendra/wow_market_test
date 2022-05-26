<?php

namespace App\Services;

use App\Price;
use App\Product;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

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
        $productsTable = (new Product())->getTable();
        $pricesTable = (new Price())->getTable();
        $query = DB::table($pricesTable)
            ->select([
                "{$productsTable}.id",
                'name',
                'code',
                DB::raw('(' . $this->subQueryFirstPrice($pricesTable, $productsTable, $storeId, $startsAt) . ') as price')
            ])
            ->leftJoin($productsTable, 'product_id', '=', "{$productsTable}.id");

        if ($storeId) {
            $query->where(function (Builder $query) use ($storeId) {
                $query->where('store_id', '=', $storeId)->orWhereNull('store_id');
            });
        }

        if ($startsAt) {
            $query->where('starts_at', '>=', $startsAt);
        }

        $query->distinct()->groupBy(['name', 'code', 'price', "{$productsTable}.id"]);

        return $query->paginate($perPage);
    }

    /**
     * @param string $pricesTable
     * @param string $productsTable
     * @param int|null $storeId
     * @param string $startsAt
     * @return string
     */
    private function subQueryFirstPrice(string $pricesTable, string $productsTable, ?int $storeId, string $startsAt): string
    {
        $query = "SELECT price FROM prices where $productsTable.id = $pricesTable.product_id ";

        if ($storeId) {
            $query .= "AND (store_id = $storeId OR store_id IS NULL) ";
        }

        if ($startsAt) {
            $query .= "AND starts_at >= '$startsAt' ";
        }

        $query .= "LIMIT 1";

        return $query;
    }

}