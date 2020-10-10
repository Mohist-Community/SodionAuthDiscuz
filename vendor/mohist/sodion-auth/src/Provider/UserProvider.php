<?php


namespace Mohist\SodionAuth\Provider;

use Mohist\SodionAuth\Result\Result;

abstract class UserProvider
{
    /**
     * @param $username
     * @return Result
     */
    public abstract function nameVerify($username);

    /**
     * @param $username
     * @param $password
     * @return Result
     */
    public abstract function login($username, $password);

    /**
     * @param $email
     * @param $password
     * @return Result
     */
    public abstract function loginEmail($email, $password);

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return Result
     */
    public abstract function register($username, $email, $password);
}
