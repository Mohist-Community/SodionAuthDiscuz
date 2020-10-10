<?php

namespace Mohist\SodionAuth\Controller;

use Mohist\SodionAuth\Response\Response;
use Mohist\SodionAuth\Result\NoSuchUserResult;
use Mohist\SodionAuth\Result\PasswordIncorrectResult;
use Mohist\SodionAuth\Result\SuccessResult;

class LoginEmailController extends Controller
{
    protected function hand($request)
    {
        $result = $this->provider->loginEmail($request->email, $request->password);
        switch (get_class($result)) {
            case NoSuchUserResult::class:
                return Response::no_user();
            case PasswordIncorrectResult::class:
                return Response::password_incorrect();
            case SuccessResult::class:
                return Response::ok([
                    'correct' => $result->correct
                ]);
            default:
                return Response::unknown('server_error', 'server_error');
        }
    }
}
