<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 10.10.2018
 *
 *
 */

namespace App\Factories;

use App\DTO\SocialServiceDto;
use App\Enums\SocialServiceEnum;
use App\Exceptions\SocialServiceFactoryException;
use App\Services\Social\SocialServiceFacebook;

class SocialServiceFactory
{

    /**
     * @param $service
     * @param $token
     *
     * @return SocialServiceFacebook|SocialServiceGoogle
     * @throws SocialServiceFactoryException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function getSocialServiceInstance($service, SocialServiceDto $socialService)
    {
        switch ($service) {
            case SocialServiceEnum::SERVICE_FACEBOOK:
                return new SocialServiceFacebook($socialService->getToken());
            default:
                throw new SocialServiceFactoryException("Illegal service name: $service");
        }
    }

}
