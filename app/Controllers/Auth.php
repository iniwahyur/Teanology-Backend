<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $modelName = 'App\Models\CustomersModel'; // Ubah sesuai dengan nama model Anda

    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('id_admin')) {
            return redirect()->to(site_url('home'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('admin')->getWhere(['email_admin' => $post['email_admin']]);
        $admin = $query->getRow();
        if ($admin) {
            if (password_verify($post['password_admin'], $admin->password_admin)) {
                $params = [
                    'id_admin' => $admin->id_admin,
                    'role_admin' => $admin->role_admin // Asumsikan ada kolom 'role_admin' di tabel 'admin'
                ];
                session()->set($params);

                return redirect()->to(site_url('home'));
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->remove('id_admin');
        return redirect()->to(site_url('login'));
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $post = $this->request->getPost();
        $hashedPassword = password_hash($post['password_customer'], PASSWORD_BCRYPT);

        $userData = [
            'first_name_customer' => $post['first_name_customer'],
            'last_name_customer' => $post['last_name_customer'],
            'email_customer' => $post['email_customer'],
            'birthdate_customer' => $post['birthdate_customer'],
            'password_customer' => $hashedPassword,
            'phone_customer' => $post['phone_customer']
        ];

        $model = new $this->modelName();
        $model->insert($userData);

        return redirect()->to(site_url('login'))->with('success', 'Registration successful! Please log in.');
    }

    public function insertCustomersApi()
    {
        $requestData = $this->request->getJSON();

        $validation = $this->validate([
            'first_name_customer' => 'required',
            'last_name_customer' => 'required',
            'email_customer' => 'required',
            'password_customer' => 'required',
            'birthdate_customer' => 'required',
            'phone_customer' => 'required',
        ]);

        if (!$validation) {
            $this->response->setStatusCode(400);
            echo json_encode([
                'code' => 400,
                'status' => 'BAD REQUEST',
                'data' => null
            ]);
            return;
        }

        $hashedPassword = password_hash($requestData->password_customer, PASSWORD_BCRYPT);

        $data = [
            'first_name_customer' => $requestData->first_name_customer,
            'last_name_customer' => $requestData->last_name_customer,
            'email_customer' => $requestData->email_customer,
            'password_customer' => $hashedPassword,
            'birthdate_customer' => $requestData->birthdate_customer,
            'phone_customer' => $requestData->phone_customer
        ];

        if (property_exists($requestData, 'photo_customer')) {
            $data['photo_customer'] = $requestData->photo_customer;
        }

        $model = new \App\Models\CustomersModel(); // Inisialisasi model
        $insert = $model->insert($data); // Gunakan metode insert() dari model

        if ($insert) {
            echo json_encode([
                'code' => 200,
                'status' => 'OK',
                'data' => $data
            ]);
        } else {
            $this->response->setStatusCode(500);
            echo json_encode([
                'code' => 500,
                'status' => 'INTERNAL SERVER ERROR',
                'message' => 'Failed to insert customer data into the database',
                'data' => null
            ]);
        }
    }
}
