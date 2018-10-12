<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 10.10.2018
 *
 *
 */

namespace App\Services\Social;

abstract class SocialServiceAbstract
{
    /** @var string $token */
    protected $token;

    /** @var string $tokenSecret */
    protected $tokenSecret;

    /**
     * SocialServiceAbstract constructor.
     *
     * @param $token
     */
    public function __construct($token, $tokenSecret = null)
    {
        $this->token = $token;
        $this->tokenSecret = $tokenSecret;
    }
}
