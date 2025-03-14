<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class AdvertisementsFilter extends ApiFilter
{
    protected $allowedFields = [
        'type'=> ['eq'],
        'title' => ['like'],
        'description' => ['like'],
        'price' => ['eq', 'lt', 'gt'],
        'expiresAt' => ['eq', 'lt', 'gt'],
    ];

    protected $columnMap = [
        'type' => 'type',
        'title' => 'title',
        'description' => 'description',
        'price' => 'price',
        'expiresAt' => 'expires_at',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'like' => 'like',
    ];
}
