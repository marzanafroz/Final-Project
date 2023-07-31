<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $helpers = ['form'];
  
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel ();
    }

    public function login()
    {
        return view("auth/login");
    }
    public function register()
    {
        helper('redirect');
        if (! $this->request->is('post')) {
            return view("auth/register");
        }

        $rules = [
            "name" => "required|min_length[8]",
            "email" => "required|valid_email|is_unique[users.email]",
            "password" => "required|min_length[6] ",
            "confirmPassword" => "required|matches[password]" 
        ];

        if(!$this->validate($rules)){
            return view("auth/register");
        }


        $data = [
            "name" => $this->request->getPost('name'),
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password'),
        ];

       if($this->model->insert($data)){
        return redirect()->to(base_url("/login"));
       }

        
       
       
    }
}
