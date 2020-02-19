<?php

namespace App\Controllers;


use App\Exceptions\InvalidArgumentException;
use App\Models\User\User;
use App\Services\UsersAuthService\UsersAuthService;

class RegisterController extends AbstractController
{


    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $_SESSION['error']= $e->getMessage();
                $this->view->renderHtml('loginPage.php');
                return;
            }
        }

        $this->view->renderHtml('loginPage.php');
    }

    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }

}