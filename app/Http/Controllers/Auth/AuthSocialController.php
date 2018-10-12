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
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthSocialController extends Controller
{
    /**
     * Create a new AuthSocialController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'loginSocial',
        ]]);
    }


    public function loginSocial(Request $request, $service): JsonResponse
    {
        $socialServiceDto = new SocialServiceDto(
            $request->get('token'),
            $request->get('device')
        );
        $serviceInstance = SocialServiceFactory::getSocialServiceInstance($service, $socialServiceDto);

        $userData = $serviceInstance->getUserData();

        $token = $this->authSocialUser($userData);

        return $this->respondWithToken($token);
    }


    protected function authSocialUser($socialUserData)
    {
        $user = User::firstOrCreate([
            'social_id' => $socialUserData['id'],
            'social_provider' => $socialUserData['social_provider'],
        ], [
            'name' => $socialUserData['name'],
        ]);

        return Auth::login($user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }


}
