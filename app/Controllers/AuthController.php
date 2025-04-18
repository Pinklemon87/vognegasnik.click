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

    /**
     * User login controller
     *
     * @return void
     */
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

    /**
     * User register controller
     *
     * @return void
     */
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

    /**
     * User logout controller
     *
     * @return void
     */
    public function logout(): void
    {
        $this->auth->logout();
        header("Location: /");
    }

    /**
     * Redirect when user no authenticated
     *
     * @return void
     */
    public function noAuth(): void
    {
        if (!$this->auth->isAuthenticated()) {
            header("Location: /login");
            exit;
        }
    }

    /**
     * Redirect when user is authenticated
     *
     * @return void
     */
    public function isAuth(): void
    {
        if ($this->auth->isAuthenticated()) {
            header("Location: /");
            exit;
        }
    }

    /**
     * Render login buttons
     *
     * @return string
     */
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

    /**
     * Render login buttons in mobile device
     *
     * @return string
     */
    public function loginBtnMobile(): string
    {
        if ($this->auth->isAuthenticated()) {
            return "<a href='/profile'  ><i class='fas fa-user'></i> Кабінет</a>
                <a href='/logout'><i class='fas fa-sign-out'></i> Вихід</a>";
        } else {
            return "<a href='/login'><i class='fas fa-user' aria-label='true'></i> Вхід</a>";
        }
    }

    /**
     * Check user status
     *
     * @return string
     */
    public function statusAccount(): string
    {
        if ($this->auth->isAdmin()) {
            return 'Admin';
        } else {
            return 'User';
        }
    }

    /**
     * Return user status
     *
     * @return bool
     */
    public function isAdminStatus(): bool
    {
        return $this->auth->isAdmin();
    }
}
