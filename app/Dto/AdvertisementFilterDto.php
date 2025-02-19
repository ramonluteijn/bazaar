<?php

namespace App\Dto;

class AdvertisementFilterDto
{
    public $sorting;

    public function __construct(array $parameters)
    {

        $this->sorting = $parameters['sorting'] ?? null;
    }
}
