<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function getAdvertismentReviews($id) {
        return Review::where('advertisement_id', $id)->get();
    }
}
