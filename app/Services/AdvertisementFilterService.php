<?php

namespace App\Services;

use App\Dto\AdvertisementFilterDto;
use App\Models\Advertisement;

/**
 * Class ProductFilterService
 *
 * This class is responsible for applying filters to the product query based on the provided DTO.
 *
 * @package Namespace\To\ProductFilterService
 */
class AdvertisementFilterService
{
    protected $query;
    protected AdvertisementFilterDTO $advertisementFilterDTO;

    // Constants for sorting types
    const SORT_HIGH_LOW = 'highlow';
    const SORT_LOW_HIGH = 'lowhigh';
    const SORT_NEWEST = 'newest';
    const SORT_OLDEST = 'oldest';

    public function __construct(AdvertisementFilterDTO $advertisementFilterDTO)
    {
        $this->query = Advertisement::query();
        $this->advertisementFilterDTO = $advertisementFilterDTO;
    }

    /**
     * Apply filters and sorting to the query.
     *
     * This method applies various filters and sorting to the query object.
     * The filters include archive, out of stock, search, price range, category, and subcategory filters.
     * The sorting filter determines the order in which the results are returned.
     *
     * @return mixed Returns the modified query object.
     */
    public function apply()
    {
        $this->applySortingFilter()
            ->applyOrder();

        return $this->query;
    }

    private function applySortingFilter()
    {
        $this->query->when($this->advertisementFilterDTO->sorting, $this->filterSortedAdvertisements());
        return $this;
    }

    private function applyOrder()
    {
        $this->query->orderBy('id', 'DESC');
        return $this;
    }

    private function filterSortedAdvertisements()
    {
        return function ($query) {
            return $query->when($this->advertisementFilterDTO->sorting == self::SORT_HIGH_LOW, function ($query) {
                return $query->orderByRaw('id, price DESC');
            })
                ->when($this->advertisementFilterDTO->sorting == self::SORT_LOW_HIGH, function ($query) {
                    return $query->orderBy('id', 'price ASC');
                })
                ->when($this->advertisementFilterDTO->sorting == self::SORT_NEWEST, function ($query) {
                    return $query->orderBy('id', 'desc');
                })
                ->when($this->advertisementFilterDTO->sorting == self::SORT_OLDEST, function ($query) {
                    return $query->orderBy('id', 'asc');
                });
        };
    }
}
