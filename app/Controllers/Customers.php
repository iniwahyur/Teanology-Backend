<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Customers extends ResourcePresenter
{
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
}
