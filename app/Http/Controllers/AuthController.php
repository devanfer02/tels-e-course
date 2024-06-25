<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends \Illuminate\Routing\Controller
{
    private $AuthService;
    public function __construct()
    {
        $this->AuthService = new AuthService;
    }

    public function login(Request $request){
        return $this->AuthService->login($request);
    }

    public function adminLogin(Request $request) {
        return $this->AuthService->adminLogin($request);
    }

    public function adminLogout()
    {
        return $this->AuthService->adminLogout();
    }

    public function register(Request $request){
        return $this->AuthService->register($request, "api");
    }

    public function webRegister(Request $request){
        return $this->AuthService->register($request, "web");
    }

    public function webLogin(Request $request){
        return $this->AuthService->login($request, "web");
    }

    public function webLogout(Request $request) {
        return $this->AuthService->webLogout($request);
    }

    public function logout(Request $request)
    {
        return $this->AuthService->logout($request);
    }

}
