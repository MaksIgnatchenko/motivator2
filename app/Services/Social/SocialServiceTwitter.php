<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 12.10.2018
 *
 *
 */

namespace App\Services\Social;

use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\FacebookRequest;
use App\Enums\SocialServiceEnum;
use Freebird\Services\freebird\Client;
use Abraham\TwitterOAuth\TwitterOAuth;

class SocialServiceTwitter extends SocialServiceAbstract implements SocialServiceInterface
{
    protected $twitterApp;

    public function __construct($token, $tokenSecret)
    {
        parent::__construct($token, $tokenSecret);

        $this->credentials = [
            'appId' => config('services.twitter.client_id'),
            'appSecret' => config('services.twitter.client_secret'),
        ];
        $this->twitterApp = new TwitterOAuth($this->credentials['appId'], $this->credentials['appSecret'], $this->token, $this->tokenSecret);
    }

    /**
     * @return array
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getUserData(): array
    {
        $content = $this->twitterApp->get("account/verify_credentials");
        $userData = [
            'id' => $content->id_str,
            'name' => $content->name,
            'social_provider' => SocialServiceEnum::SERVICE_TWITTER
        ];
        return $userData;
    }
}