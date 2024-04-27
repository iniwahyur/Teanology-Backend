<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Admin extends ResourcePresenter
{
    protected $modelName = 'App\Models\AdminModel';
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['admin'] = $this->model->findAll();
        return view('admin/index', $data);
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
        return view('admin/new');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Ambil file foto yang diunggah
        $photo = $this->request->getFile('photo_admin');

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'uploads'; // Simpan di direktori public/uploads
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $adminData = [
                'photo_admin' => $photoName,
                'name_admin' => $this->request->getVar('name_admin'),
                'email_admin' => $this->request->getVar('email_admin'),
                'password_admin' => password_hash($this->request->getVar('password_admin'), PASSWORD_BCRYPT),
                'role_admin' => $this->request->getVar('role_admin'),
            ];

            $this->model->insert($adminData);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('admin'))->with('success', 'Data Berhasil Disimpan');
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
        $admin = $this->model->where('id_admin', $id)->first();
        if (is_object($admin)) {
            $data['admin'] = $admin;
            return view('admin/edit', $data);
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
        // Ambil file foto yang diunggah
        $photo = $this->request->getFile('photo_admin');

        // Ambil data produk berdasarkan ID
        $admin = $this->model->find($id);

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'uploads'; // Simpan di direktori public/upload_product
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $data = [
                'name_admin' => $this->request->getVar('name_admin'),
                'email_admin' => $this->request->getVar('email_admin'),
                'password_admin' => password_hash($this->request->getVar('password_admin'), PASSWORD_BCRYPT),
                'role_admin' => $this->request->getVar('role_admin'),
                'photo_admin' => $photoName, // Simpan nama file foto ke dalam data produk
            ];

            // Update data produk ke database
            $this->model->update($id, $data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('admin'))->with('success', 'Data Berhasil Diupdate');
        } else {
            // Jika file tidak diunggah atau tidak valid, update data produk tanpa mengubah foto
            $data = [
                'name_admin' => $this->request->getVar('name_admin'),
                'email_admin' => $this->request->getVar('email_admin'),
                'password_admin' => password_hash($this->request->getVar('password_admin'), PASSWORD_BCRYPT),
                'role_admin' => $this->request->getVar('role_admin'),
                
            ];

            // Update data produk ke database tanpa mengubah foto
            $this->model->update($id, $data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('admin'))->with('success', 'Data Berhasil Diupdate');
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
        $admin = $this->model->find($id);

        // Periksa apakah data admin ditemukan
        if (!$admin) {
            return redirect()->to(site_url('admin'))->with('error', 'Admin not found');
        }

        // Dapatkan nama file gambar admin
        $photoName = $admin->photo_admin;

        // Hapus data admin dari database
        $this->model->delete($id);

        // Hapus file gambar dari folder uploads
        $uploadPath = FCPATH . 'uploads/' . $photoName;
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->to(site_url('admin'))->with('success', 'Data berhasil dihapus');
    }
}
