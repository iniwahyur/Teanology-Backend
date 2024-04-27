<?php

namespace App\Controllers;

// use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Category extends ResourcePresenter
{
    protected $modelName = 'App\Models\CategoryModel';
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['category'] = $this->model->findAll();
        return view('category/index', $data);
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
        return view('category/new');
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
        $photo = $this->request->getFile('photo_category');

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'upload_category'; // Simpan di direktori public/uploads
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $categoryData = [
                'photo_category' => $photoName,
                'name_category' => $this->request->getVar('name_category'),
                'description_category' => $this->request->getVar('description_category'),
            ];

            $this->model->insert($categoryData);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('category'))->with('success', 'Data Berhasil Disimpan');
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
        $category = $this->model->where('id_category', $id)->first();
        if (is_object($category)) {
            $data['category'] = $category;
            return view('category/edit', $data);
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
        $photo = $this->request->getFile('photo_category');

        // Ambil data produk berdasarkan ID
        $category = $this->model->find($id);

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'upload_category'; // Simpan di direktori public/upload_product
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $categoryData = [
                'name_category' => $this->request->getVar('name_category'),
                'description_category' => $this->request->getVar('description_category'),
                'photo_category' => $photoName,
            ];

            // Update data produk ke database
            $this->model->update($id, $categoryData);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('category'))->with('success', 'Data Berhasil Diupdate');
        } else {
            // Jika file tidak diunggah atau tidak valid, update data produk tanpa mengubah foto
            $data = [
                'name_category' => $this->request->getVar('name_category'),
                'description_category' => $this->request->getVar('description_category'),
                
            ];

            // Update data produk ke database tanpa mengubah foto
            $this->model->update($id, $data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('category'))->with('success', 'Data Berhasil Diupdate');
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
        $category = $this->model->find($id);

        // Periksa apakah data admin ditemukan
        if (!$category) {
            return redirect()->to(site_url('category'))->with('error', 'Admin not found');
        }

        // Dapatkan nama file gambar admin
        $photoName = $category->photo_category;

        // Hapus data admin dari database
        $this->model->delete($id);

        // Hapus file gambar dari folder uploads
        $uploadPath = FCPATH . 'upload_category/' . $photoName;
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->to(site_url('category'))->with('success', 'Data berhasil dihapus');
    
    }

    public function trash()
    {
        $data['category'] = $this->model->onlyDeleted()->findAll();
        return view('category/trash', $data);
    }

    public function restore($id = null)
    {
        $this->db = \Config\Database::connect();
        if ($id != null) {
            $this->db->table('category')
                ->set('deleted_at', null, true)
                ->where(['id_category' => $id])
                ->update();
        } else {
            $this->db->table('category')
                ->set('deleted_at', null, true)
                ->where('deleted_at is NOT NULL', NULL, TRUE)
                ->update();
        }
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('category'))->with('success', 'Data Berhasil Direstore');
        }
    }

    public function delete2($id = null)
    {
        if ($id != null) {
            $this->model->delete($id, true);
            return redirect()->to(site_url('category/trash'))->with('success', 'Data Berhasil Dihapus Permanen');
        } else {
            $this->model->purgeDeleted();
            return redirect()->to(site_url('category/trash'))->with('success', 'Data Trash Berhasil Dihapus Permanen');
        }
    }
}
