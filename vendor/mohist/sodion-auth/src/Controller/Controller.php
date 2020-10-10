<?php

namespace Mohist\SodionAuth\Controller;

use Mohist\SodionAuth\Provider\UserProvider;
use Mohist\SodionAuth\Response\Response;

class Controller
{
    /** @var UserProvider */
    protected $provider;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function handle($post)
    {
        $response = $this->hand((object)$post);
        return $response;
    }

    protected function hand($request)
    {
        switch ($request->action) {
            case 'register':
                return (new RegisterController($this->provider))->hand($request);
            case 'login':
                return (new LoginController($this->provider))->hand($request);
            case 'loginEmail':
                return (new LoginEmailController($this->provider))->hand($request);
            case 'join':
                return (new JoinController($this->provider))->hand($request);
            default:
                return Response::unknown('flarum_error','ah?'.$request->action);
        }
    }
}
