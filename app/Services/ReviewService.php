<?php
namespace App\Services;
use App\Models\Review;
class ReviewService {
    public function getReviewsUser($id) {
        return Review::where('user_id', $id)->get();
    }

    public function getReviewsAdvertisement($id) {
        return Review::where('advertisement_id', $id)->get();
    }
    public function getReview($id) {
        return Review::find($id);
    }

    public function createReview($data) {
        Review::create($data);
    }

    public function deleteReview($id) {
        Review::destroy($id);
    }
}
