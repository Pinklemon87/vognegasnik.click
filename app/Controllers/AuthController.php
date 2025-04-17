<?php

namespace App\Controllers;

use App\Services\Auth;

class AuthController extends Controller
{
    protected Auth $auth;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth($this->conn);
        session_start();
    }

    public function login(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            $message = $this->auth->login($email, $password);

            if ($message === "success") {
                header("Location: /");
            } else {
                $_SESSION['error'] = $message;
                header("Location: /login");
            }
            exit;
        }
    }

    public function register(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            $message = $this->auth->register($name, $email, $password);

            if ($message === "success") {
                $_SESSION['success'] = "Реєстрація успішна! Увійдіть у свій акаунт.";
                header("location: /login");
            } else {
                $_SESSION['error'] = $message;
                header("location: /registration");
            }
            exit;
        }
    }

    public function logout(): void
    {
        $this->auth->logout();
        header("Location: /");
    }

    public function noAuth(): void
    {
        if (!$this->auth->isAuthenticated()) {
            header("Location: /login");
            exit;
        }
    }

    public function isAuth(): void
    {
        if ($this->auth->isAuthenticated()) {
            header("Location: /");
            exit;
        }
    }

    public function loginBtn(): string
    {
        if ($this->auth->isAuthenticated()) {
            return "<span class='badge d-flex align-items-center rounded-pill'>
                <a href='/profile' class='button' id='loginBtn'>
                    <i class='fas fa-user my-2'></i>
                    Кабінет
                </a>  
                <a href='/logout' class='mx-2 clear-button fs-5' id='loginBtn'><i class='fas fa-sign-out'></i></a>
            </span>";
        } else {
            return "<a class='button' style='margin-top: 0.475em' id='loginBtn' href='/login'>
                        <i class='fas fa-sign-in'></i> Вхід
                    </a>";
        }
    }

    public function loginBtnMobile(): string
    {
        if ($this->auth->isAuthenticated()){
            return "<a href='/profile'  ><i class='fas fa-user'></i> Кабінет</a>
                <a href='/logout'><i class='fas fa-sign-out'></i> Вихід</a>";
        }else{
            return "<a href='/login'><i class='fas fa-user' aria-label='true'></i> Вхід</a>";
        }
    }

    public function statusAccount():string
    {
        if($this->auth->isAdmin()){
            return 'Admin';
        }else{
            return 'User';
        }
    }

    public function isAdminStatus(): bool
    {
        return $this->auth->isAdmin();
    }

}