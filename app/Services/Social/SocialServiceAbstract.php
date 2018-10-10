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

    /** @var array  $credentials */
    protected $credentials;

    /**
     * SocialServiceAbstract constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
}
