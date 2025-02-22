<?php

namespace App\Rules;

use App\Models\Advertisement;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxAmountOfAdvertisementsRule implements ValidationRule
{
    protected $maxAmountOfAdvertisements;

    public function __construct($maxAmountOfAdvertisements = 4)
    {
        $this->maxAmountOfAdvertisements = $maxAmountOfAdvertisements;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $type = request()->input('type');
        $advertisementId = request()->route('id');

        $advertisementCount = Advertisement::where('type', $type)
            ->where('user_id', auth()->id())
            ->whereNot('id', $advertisementId)
            ->count();

        if ($advertisementCount >= $this->maxAmountOfAdvertisements) {
            $fail("You can't have more than {$this->maxAmountOfAdvertisements} advertisements of type {$type}.");
        }
    }
}
