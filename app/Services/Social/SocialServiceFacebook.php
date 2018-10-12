<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 10.10.2018
 *
 *
 */

namespace App\Services\Social;

use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\FacebookRequest;
use App\Enums\SocialServiceEnum;

class SocialServiceFacebook extends SocialServiceAbstract implements SocialServiceInterface
{
    protected $fbApp;

    protected const FIELDS = 'id,name';

    /**
     * SocialServiceFacebook constructor.
     *
     * @param $token
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct($token)
    {
        parent::__construct($token);

        $this->credentials = [
            'appId' => config('services.facebook.client_id'),
            'appSecret' => config('services.facebook.client_secret'),
        ];

        $this->fbApp = new FacebookApp($this->credentials['appId'], $this->credentials['appSecret']);
    }

    /**
     * @return array
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getUserData(): array
    {
        $fbRequest = new FacebookRequest($this->fbApp, $this->token, 'GET', '/me?fields=' . self::FIELDS);

        $client = new FacebookClient();

        $response = $client->sendRequest($fbRequest);

        $userData = $response->getDecodedBody();

        $userData['social_provider'] = SocialServiceEnum::SERVICE_FACEBOOK;

        return $userData;
    }
}
