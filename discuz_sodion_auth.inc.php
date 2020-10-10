<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require 'vendor/autoload.php';
require libfile('function/member');

class UserProvider extends \Mohist\SodionAuth\Provider\UserProvider{
    public function nameVerify($username)
    {
        $result=uc_get_user($username);
        if(!$result){
            return new \Mohist\SodionAuth\Result\NoSuchUserResult();
        }
        list(,$correct,) = $result;
        if($username != $correct){
            return new \Mohist\SodionAuth\Result\NameIncorrectResult([
                'correct'=>$correct,
            ]);
        }
        return new \Mohist\SodionAuth\Result\SuccessResult();
    }

    public function login($username, $password)
    {
        $result=uc_user_login($username,$password);
        list($uid, $correct,,) = $result;
        if($uid > 0) {
            if($correct==$username){
                return new \Mohist\SodionAuth\Result\SuccessResult();
            }else{
                return new \Mohist\SodionAuth\Result\NameIncorrectResult([
                    'correct'=>$correct
                ]);
            }
        } elseif($uid == -1) {
            return new \Mohist\SodionAuth\Result\NoSuchUserResult();
        } elseif($uid == -2) {
            return new \Mohist\SodionAuth\Result\PasswordIncorrectResult();
        } else {
            return new \Mohist\SodionAuth\Result\UnknownResult();
        }
    }

    public function loginEmail($email, $password)
    {
        $result=uc_user_login($email,$password,2);
        list($uid, $correct,,) = $result;
        if($uid > 0) {
            return new \Mohist\SodionAuth\Result\SuccessResult([
                'correct'=>$correct
            ]);
        } elseif($uid == -1) {
            return new \Mohist\SodionAuth\Result\NoSuchUserResult();
        } elseif($uid == -2) {
            return new \Mohist\SodionAuth\Result\PasswordIncorrectResult();
        } else {
            return new \Mohist\SodionAuth\Result\UnknownResult();
        }
    }

    public function register($username, $email, $password)
    {
        $result = uc_user_register($username,$password,$email);
        if($result <= 0) {
            switch ($result){
                case -1:
                case -2:
                case -3:
                    return new \Mohist\SodionAuth\Result\UserExistResult();
                case -4:
                case -5:
                case -6:
                    return new \Mohist\SodionAuth\Result\EmailExistResult();
                default:
                    return new \Mohist\SodionAuth\Result\UnknownResult();
            }
        } else {
            return new \Mohist\SodionAuth\Result\SuccessResult();
        }
    }
}

loaducenter();
exit(json_encode(
    (new \Mohist\SodionAuth\Controller\Controller(new UserProvider()))
        ->handle($_POST)->data));