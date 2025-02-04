<?php

namespace App\Enums;

enum AdvertisementType: string
{
    case HIRE = 'HIRE';
    case SALE = 'SALE';

    public function getReadableAdvertisementType(): string
    {
        return match ($this) {
            AdvertisementType::HIRE => __('Hire'),
            AdvertisementType::SALE => __('Sale'),
        };
    }
}
