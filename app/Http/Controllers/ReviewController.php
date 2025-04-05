<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\User;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController
{
    private ReviewService $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(ReviewRequest $request)
    {
        $this->reviewService->createReview($request);
        return redirect()->back();
    }

    public function show($id)
    {
        $reviews = $this->reviewService->getReviewsUser($id);
        $user = User::find($id)->Select(['name', 'id'])->first();
        return view('reviews.show', compact('reviews', 'user'));
    }

    public function delete($id){
        $this->reviewService->deleteReview($id);
        return redirect()->back();
    }
}
