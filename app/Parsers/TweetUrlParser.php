<?php

namespace App\Parsers;

class TweetUrlParser
{
    private $url;
    private $screenName;
    private $tweetId;

    public function __construct($url)
    {
        $this->url = $url;
        $this->parse($this->url);
    }

    public function parse($url)
    {
        $urlPath = parse_url($url, PHP_URL_PATH);

        list($emptyString, $screenName, $apiFor, $tweetId) = explode('/', $urlPath);

        $this->screenName = $screenName;
        $this->tweetId = $tweetId;

        return $this;
    }

    public function getTweetId()
    {
        return $this->tweetId;
    }

    public function getScreenName()
    {
        return $this->screenName;
    }
}