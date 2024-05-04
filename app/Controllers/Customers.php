<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;

class Customers extends ResourcePresenter
{

    protected $format = 'json';

    use ResponseTrait;
    protected $modelName = 'App\Models\CustomersModel';
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['customers'] = $this->model->findAll();
        return view('customers/index', $data);
    }

    public function readCustomersApi()
    {
        // $customers = $this->model->findAll();
        // return $this->response->setJSON($customers);

        $customers = $this->model->findAll();

        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $customers
        ]);
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view ('customers/new');
    }

    public function getCustomersApi($id)
    {
        // Validasi ID
        if (!is_numeric($id) || $id <= 0) {
            $this->response->setStatusCode(400);
            return $this->response->setJSON([
                'code' => 400,
                'status' => 'BAD REQUEST',
                'message' => 'Invalid ID provided'
            ]);
        }

        // Cari produk berdasarkan ID
        $customers = $this->model->find($id);

        // Jika produk tidak ditemukan
        if (!$customers) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'message' => 'Customers not found'
            ]);
        }

        // Mengembalikan respons dengan produk yang ditemukan
        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $customers
        ]);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        
        $photo = $this->request->getFile('photo_customer');

        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = FCPATH . 'upload_customer';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photoName = time() . '_' . $photo->getClientName();

            $photo->move($uploadPath, $photoName);

            $customerData = [
                'photo_customer' => $photoName,
                'first_name_customer' => $this->request->getVar('first_name_customer'),
                'last_name_customer' => $this->request->getVar('last_name_customer'),
                'email_customer' => $this->request->getVar('email_customer'),
                'password_customer' => password_hash($this->request->getVar('password_customer'), PASSWORD_BCRYPT),
                'phone_customer' => $this->request->getVar('phone_customer'),
                'birthdate_customer' => $this->request->getVar('birthdate_customer'),
            ];

            $this->model->insert($customerData);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('customers'))->with('success', 'Data Berhasil Disimpan');
        } else {
            // Jika file tidak diunggah atau tidak valid, kirim pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Failed to upload photo.');
        }
    }

    

    /**
     * Present a view to edit the properties of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $customer = $this->model->where('id_customer', $id)->first();
        if(is_object($customer)) {
            $data['customers'] = $customer;
            return view('customers/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        
        $photo = $this->request->getFile('photo_customer');

        
        $admin = $this->model->find($id);

  
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
           
            $uploadPath = FCPATH . 'upload_customer';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photoName = time() . '_' . $photo->getClientName();

            $photo->move($uploadPath, $photoName);

            $data = [
                'photo_customer' => $photoName,
                'first_name_customer' => $this->request->getVar('first_name_customer'),
                'last_name_customer' => $this->request->getVar('last_name_customer'),
                'email_customer' => $this->request->getVar('email_customer'),
                'password_customer' => password_hash($this->request->getVar('password_customer'), PASSWORD_BCRYPT),
                'phone_customer' => $this->request->getVar('phone_customer'),
                'birthdate_customer' => $this->request->getVar('birthdate_customer'),
            ];

            $this->model->update($id, $data);

            return redirect()->to(site_url('customers'))->with('success', 'Data Berhasil Diupdate');
        } else {

            $data = [
                'first_name_customer' => $this->request->getVar('first_name_customer'),
                'last_name_customer' => $this->request->getVar('last_name_customer'),
                'email_customer' => $this->request->getVar('email_customer'),
                'password_customer' => password_hash($this->request->getVar('password_customer'), PASSWORD_BCRYPT),
                'phone_customer' => $this->request->getVar('phone_customer'),
                'birthdate_customer' => $this->request->getVar('birthdate_customer'),
                
            ];

            $this->model->update($id, $data);

            return redirect()->to(site_url('customers'))->with('success', 'Data Berhasil Diupdate');
        }
    }


    public function updateCustomersApi($id)
    {
        $customers = $this->model->find($id);

        if (!$customers) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'data' => 'Customers not found'
            ]);
        }

        $requestData = $this->request->getJSON();

        // Persiapkan data untuk pembaruan
        $data = [];

        // Cek atribut mana yang ada dalam permintaan dan tambahkan ke data pembaruan
        if (isset($requestData->first_name_customer)) {
            $data['first_name_customer'] = $requestData->first_name_customer;
        }

        if (isset($requestData->last_name_customer)) {
            $data['last_name_customer'] = $requestData->last_name_customer;
        }

        if (isset($requestData->email_customer)) {
            $data['email_customer'] = $requestData->email_customer;
        }

        if (isset($requestData->password_customer)) {
            $data['password_customer'] = password_hash($requestData->password_customer, PASSWORD_BCRYPT);
        }

        if (isset($requestData->phone_customer)) {
            $data['phone_customer'] = $requestData->phone_customer;
        }

        if (isset($requestData->birthdate_customer)) {
            $data['birthdate_customer'] = $requestData->birthdate_customer;
        }

        // Jika 'photo_product' ada dalam data permintaan, tambahkan ke data pembaruan
        if (isset($requestData->photo_customer)) {
            $data['photo_customer'] = $requestData->photo_customer;
        }

        // Lakukan pembaruan data produk
        $this->model->update($id, $data);

        // Kirim respons berhasil
        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => 'Customers updated successfully'
        ]);
    }


    /**
     * Present a view to confirm the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        // Dapatkan data admin berdasarkan ID
        $customer = $this->model->find($id);

        // Periksa apakah data admin ditemukan
        if (!$customer) {
            return redirect()->to(site_url('customers'))->with('error', 'Admin not found');
        }

        // Dapatkan nama file gambar admin
        $photoName = $customer->photo_customer;

        // Hapus data admin dari database
        $this->model->delete($id);

        // Hapus file gambar dari folder uploads
        $uploadPath = FCPATH . 'upload_customer/' . $photoName;
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->to(site_url('customers'))->with('success', 'Data berhasil dihapus');
    }

    public function deleteCustomersApi($id)
    {
        $customers = $this->model->find($id);

        if (!$customers) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'data' => 'Customers not found'
            ]);
        }

        $this->model->delete($id);

        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => 'Customers deleted successfully'
        ]);
    }

}
