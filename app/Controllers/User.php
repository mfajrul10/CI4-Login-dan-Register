<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;
    public function __construct()
    {

        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('user/index', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'name' => session()->get('name'),
            'email' => session()->get('email'),
        ];
        return view('user/profile', $data);
    }
}
