<?php

namespace App\Http\Controllers;

use App\Models\RetweetsData;
use App\Parsers\TweetUrlParser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twitter;

/**
 * Calculate reach of specific tweet
 *
 * Class CalculateReach
 * @package App\Http\Controllers
 */
class CalculateReach extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, ['tweetUrl' => ['required', 'url', 'tweet_url']]);

        $tweetId = (new TweetUrlParser($request->tweetUrl))->getTweetId();

        $followersCount = $this->getTotalFollowersOfRetweeters($tweetId);

        return redirect()->route('home')->with('followersCount', $followersCount)->withInput();
    }

    /**
     * @param $tweetId
     * @return mixed
     */
    private function getTotalFollowersOfRetweeters($tweetId)
    {
        $retweetData = $this->checkIfExistInDatabase($tweetId);

        if ($retweetData) {
            return $retweetData->followers_count;
        }

        $followersCount = $this->getFollowersFromTwitterApi($tweetId);

        $this->createOrUpdateInDatabase($tweetId, $followersCount);

        return $followersCount;

    }

    /**
     * @param $tweetId
     * @return mixed
     */
    private function checkIfExistInDatabase($tweetId)
    {
        $retweetData = RetweetsData::whereTweetId($tweetId)->first();

        if ($retweetData) {
            $todayDate = (new Carbon)->now();

            $hours = $retweetData->updated_at->diffInHours($todayDate, false);

            //Check For 2 hours if the same record requested
            if (!$hours < 2) {
                return false;
            }

            return $retweetData;
        }

        return $retweetData;
    }

    /**
     * @param $tweetId
     * @return mixed
     */
    private function getFollowersFromTwitterApi($tweetId)
    {
        $retweets = Twitter::getRts($tweetId);
        $retweetersFollowers = [];

        foreach ($retweets as $retweet) {
            $retweetersFollowers [] = $retweet->user->followers_count;
        }

        $followersCount = array_sum($retweetersFollowers);

        return $followersCount;
    }

    /**
     * @param $tweetId
     * @param $followersCount
     * @throws \Exception
     */
    private function createOrUpdateInDatabase($tweetId, $followersCount)
    {
        try {
            RetweetsData::updateOrCreate([
                'tweet_id' => $tweetId
            ], [
                'tweet_id' => $tweetId,
                'followers_count' => $followersCount
            ]);
        } catch (\Exception $e) {
            throw new \Exception('unable to update database');
        }
    }
}
