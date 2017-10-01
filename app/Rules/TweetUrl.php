<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TweetUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.tweet_url');
    }

    /**
     * @param $value
     * @return bool
     */
    private function validate($value)
    {
        $urlParts = parse_url($value);

        if (count($urlParts) == 0) {
            return false;
        }

        if (!isset($urlParts['host'])) {
            return false;
        }

        if ($urlParts['host'] != "twitter.com") {
            return false;
        }

        if (!isset($urlParts['path'])) {
            return false;
        }

        $pathParts = explode('/', $urlParts['path']);

        if (count($pathParts) != 4) {
            return false;
        }

        return true;
    }
}
