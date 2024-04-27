<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoryModel;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Products extends ResourcePresenter
{

    function __construct()
    {
        $this->category = new CategoryModel();
        $this->products = new ProductsModel();
    }

    // protected $modelName = 'App\Models\ProductsModel';
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['products'] = $this->products->getAll();
        return view('products/index', $data);
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */

    public function getAllProducts()
    {
        $products = $this->products->getAll();
        return $this->response->setJSON($products);
    }

    public function show($id = null)
    {
        // Validasi ID
        if (!is_numeric($id) || $id <= 0) {
            // Jika ID tidak valid, kirim respons dengan kode status 400 (Bad Request)
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Invalid ID provided'
            ]);
        }
    
        // Ambil data produk berdasarkan ID
        $product = $this->products->find($id);
    
        // Jika produk tidak ditemukan
        if (!$product) {
            // Kirim respons dengan kode status 404 (Not Found)
            return $this->response->setStatusCode(404)->setJSON([
                'error' => true,
                'message' => 'Product not found'
            ]);
        }
    
        // Kirim respons dengan data produk yang ditemukan
        return $this->response->setJSON($product);
    }
    

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $data['category'] = $this->category->findAll();
        return view('products/new', $data);
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
        $photo = $this->request->getFile('photo_product');

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'upload_product'; // Simpan di direktori public/uploads
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $data = [
                'name_product' => $this->request->getVar('name_product'),
                'id_category' => $this->request->getVar('id_category'),
                'description_product' => $this->request->getVar('description_product'),
                'rating_product' => $this->request->getVar('rating_product'),
                'price_product' => $this->request->getVar('price_product'),
                'stock_product' => $this->request->getVar('stock_product'),
                'order_count_product' => $this->request->getVar('order_count_product'),
                'status_product' => $this->request->getVar('status_product'),
                'photo_product' => $photoName, // Simpan nama file foto ke dalam data produk
            ];

            // Insert data ke database
            $this->products->insert($data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('products'))->with('success', 'Data Berhasil Disimpan');
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
        $products = $this->products->where('id_product', $id)->first();
        if (is_object($products)) {
            $data['products'] = $products;
            $data['category'] = $this->category->findAll();
            return view('products/edit', $data);
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
        $photo = $this->request->getFile('photo_product');

        // Ambil data produk berdasarkan ID
        $product = $this->products->find($id);

        // Periksa apakah file foto valid dan sudah diunggah
        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            // Direktori penyimpanan di dalam direktori public
            $uploadPath = FCPATH . 'upload_product'; // Simpan di direktori public/upload_product
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Buat direktori dengan izin tertinggi jika belum ada
            }

            // Generate nama unik untuk file foto
            $photoName = time() . '_' . $photo->getClientName();

            // Pindahkan file foto ke direktori penyimpanan
            $photo->move($uploadPath, $photoName);

            // Siapkan data untuk disimpan ke database
            $data = [
                'name_product' => $this->request->getVar('name_product'),
                'id_category' => $this->request->getVar('id_category'),
                'description_product' => $this->request->getVar('description_product'),
                'rating_product' => $this->request->getVar('rating_product'),
                'price_product' => $this->request->getVar('price_product'),
                'stock_product' => $this->request->getVar('stock_product'),
                'order_count_product' => $this->request->getVar('order_count_product'),
                'status_product' => $this->request->getVar('status_product'),
                'photo_product' => $photoName, // Simpan nama file foto ke dalam data produk
            ];

            // Update data produk ke database
            $this->products->update($id, $data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('products'))->with('success', 'Data Berhasil Diupdate');
        } else {
            // Jika file tidak diunggah atau tidak valid, update data produk tanpa mengubah foto
            $data = [
                'name_product' => $this->request->getVar('name_product'),
                'id_category' => $this->request->getVar('id_category'),
                'description_product' => $this->request->getVar('description_product'),
                'rating_product' => $this->request->getVar('rating_product'),
                'price_product' => $this->request->getVar('price_product'),
                'stock_product' => $this->request->getVar('stock_product'),
                'order_count_product' => $this->request->getVar('order_count_product'),
                'status_product' => $this->request->getVar('status_product'),
            ];

            // Update data produk ke database tanpa mengubah foto
            $this->products->update($id, $data);

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->to(site_url('products'))->with('success', 'Data Berhasil Diupdate');
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
        $product = $this->products->find($id);

        // Periksa apakah data admin ditemukan
        if (!$product) {
            return redirect()->to(site_url('products'))->with('error', 'Admin not found');
        }

        // Dapatkan nama file gambar admin
        $photoName = $product->photo_product;

        // Hapus data admin dari database
        $this->products->delete($id);

        // Hapus file gambar dari folder uploads
        $uploadPath = FCPATH . 'upload_product/' . $photoName;
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->to(site_url('products'))->with('success', 'Data berhasil dihapus');
    }

    public function detail($id = null)
    {
        // Ambil data produk berdasarkan ID
        $product = $this->products->find($id);

        if ($product) {
            // Jika produk ditemukan, kirim data produk ke halaman detail
            $data['product'] = $product;
            return view('products/detail', $data);
        } else {
            // Jika produk tidak ditemukan, lempar exception Page Not Found
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getProductsApi($id)
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
        $product = $this->products->find($id);

        // Jika produk tidak ditemukan
        if (!$product) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'message' => 'Product not found'
            ]);
        }

        // Mengembalikan respons dengan produk yang ditemukan
        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $product
        ]);
    }

    public function readProductsApi()
    {
        $products = $this->products->getAll();

        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $products
        ]);
    }

    public function getImage($id = null)
{
    if (!is_numeric($id) || $id <= 0) {
        return $this->response->setStatusCode(400)->setJSON([
            'error' => true,
            'message' => 'Invalid ID provided'
        ]);
    }

    // Cari produk berdasarkan ID
    $product = $this->products->find($id);

    // Jika produk tidak ditemukan
    if (!$product) {
        return $this->response->setStatusCode(404)->setJSON([
            'error' => true,
            'message' => 'Product not found'
        ]);
    }

    // Dapatkan nama file gambar dari data produk
    $photoName = $product->photo_product;

    // Lokasi direktori tempat gambar disimpan
    $imagePath = FCPATH . 'upload_product/' . $photoName;

    // Periksa apakah file gambar ada
    if (!file_exists($imagePath)) {
        return $this->response->setStatusCode(404)->setJSON([
            'error' => true,
            'message' => 'Image not found'
        ]);
    }

    // Mendapatkan tipe konten gambar (misalnya: jpeg, png, dll.)
    $imageType = mime_content_type($imagePath);

    // Membaca file gambar
    $imageData = file_get_contents($imagePath);

    // Konversi gambar ke base64
    $base64Image = base64_encode($imageData);

    // Format respons dengan tipe konten gambar dan base64 encoded gambar
    return $this->response->setStatusCode(200)->setContentType($imageType)->setBody($base64Image)->setJSON([
        'success' => true,
        'message' => 'Image retrieved successfully'
    ]);
}


 


}
