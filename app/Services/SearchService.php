<?php

namespace App\Services;

class SearchService
{
    protected $translatedAdvertisementTypes = [
        'huur' => 'HIRE',
        'verkoop' => 'SALE',
        'bod' => 'BID',
    ];

    public function singleSearch($query, $request, $model){
        $searchTerm = strtolower($request);
        $query->where(function ($query) use ($searchTerm, $model) {
            foreach ((new $model)->getSearchable() as $field) {
                $query->orWhereRaw('LOWER(' . $field . ') like ?', ['%' . $searchTerm . '%']);
            }
        });
    }

    public function search($query, mixed $search, string $class)
    {
        if (array_key_exists(strtolower($search), $this->translatedAdvertisementTypes)) {
            $this->singleSearch($query, $this->translatedAdvertisementTypes[strtolower($search)], $class);
        }
        else {
            $this->singleSearch($query, $search, $class);
        }
    }
}
