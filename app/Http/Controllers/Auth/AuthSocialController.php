<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 10.10.2018
 *
 *
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DTO\SocialServiceDto;
use App\Factories\SocialServiceFactory;
use App\Http\Requests\LoginSocialRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class AuthSocialController extends Controller
{
    public function loginSocial(Request $request, $service): JsonResponse
    {
        $socialServiceDto = new SocialServiceDto(
            $request->get('token'),
            $request->get('device')
        );
        $serviceInstance = SocialServiceFactory::getSocialServiceInstance($service, $socialServiceDto);

        $userData = $serviceInstance->getUserData();

        return response()->json($userData);
    }

}
