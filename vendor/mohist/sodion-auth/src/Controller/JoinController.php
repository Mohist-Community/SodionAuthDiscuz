<?php

namespace Mohist\SodionAuth\Controller;


use Mohist\SodionAuth\Response\Response;
use Mohist\SodionAuth\Result\NameIncorrectResult;
use Mohist\SodionAuth\Result\NoSuchUserResult;
use Mohist\SodionAuth\Result\SuccessResult;

class JoinController extends Controller
{
    protected function hand($request)
    {
        $result = $this->provider->nameVerify($request->username);
        switch (get_class($result)) {
            case NoSuchUserResult::class:
                return Response::no_user();
            case NameIncorrectResult::class:
                return Response::name_incorrect($result->correct);
            case SuccessResult::class:
                return Response::ok();
            default:
                return Response::unknown('server_error', 'server_error');
        }
    }
}
