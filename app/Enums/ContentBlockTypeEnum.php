<?php

namespace App\Enums;

enum ContentBlockTypeEnum
{
    case TEXT;
    case TEXT_HORIZONTAL;
    case TEXT_IMAGE;
    case QUOTE;
    case CTA;
    case TESTIMONIAL;
    case NEW_ITEMS;
    case GALLERY;
    case HERO;
    case TEXT_PRODUCT;

    public static function toSelectArray()
    {
        $cases = [
            ContentBlockTypeEnum::TEXT->name => 'Text',
            ContentBlockTypeEnum::TEXT_HORIZONTAL->name => 'Text-Horizontal',
            ContentBlockTypeEnum::TEXT_IMAGE->name => 'Text-Image',
            ContentBlockTypeEnum::QUOTE->name => 'Quote',
            ContentBlockTypeEnum::CTA->name => 'CTA',
            ContentBlockTypeEnum::TESTIMONIAL->name => 'Testimonial',
            ContentBlockTypeEnum::NEW_ITEMS->name => 'New Items',
            ContentBlockTypeEnum::GALLERY->name => 'Gallery',
            ContentBlockTypeEnum::HERO->name => 'Hero',
            ContentBlockTypeEnum::TEXT_PRODUCT->name => 'Text-Product',
        ];

        return $cases;
    }
}
