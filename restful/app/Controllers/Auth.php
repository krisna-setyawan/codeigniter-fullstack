<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AuthModel;

class Auth extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $model = new AuthModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();
        if (!$data) return $this->fail("Wrong username");

        if ($data['password'] != md5($password)) {
            return $this->fail("Wrong password");
        }

        helper('jwt_helper');
        $response = [
            'message' => 'Authentication success',
            'data' => [
                'username' => $data['username'],
                'password' => $data['password']
            ],
            'access_token' => createJWT($username)
        ];
        return $this->respond($response);
    }
}
