<?php

namespace Mohist\SodionAuth\Controller;

use Mohist\SodionAuth\Response\Response;
use Mohist\SodionAuth\Result\NameIncorrectResult;
use Mohist\SodionAuth\Result\NoSuchUserResult;
use Mohist\SodionAuth\Result\PasswordIncorrectResult;
use Mohist\SodionAuth\Result\SuccessResult;

class LoginController extends Controller
{
    protected function hand($request)
    {
        $result = $this->provider->login($request->username, $request->password);
        switch (get_class($result)) {
            case NoSuchUserResult::class:
                return Response::no_user();
            case NameIncorrectResult::class:
                return Response::name_incorrect($result->correct);
            case PasswordIncorrectResult::class:
                return Response::password_incorrect();
            case SuccessResult::class:
                return Response::ok();
            default:
                return Response::unknown('server_error', 'server_error');
        }
    }
}
