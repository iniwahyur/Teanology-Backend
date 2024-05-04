<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CustomersModel;
use App\Models\CartModel;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;

class Cart extends ResourcePresenter
{
    use ResponseTrait;

    protected $format = 'json';

    function __construct()
    {
        $this->products = new ProductsModel();
        $this->customers = new CustomersModel();
        $this->cart = new CartModel();
    }
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['cart'] = $this->cart->getAll();
        return view('cart/index', $data);
    }

    public function readCartApi()
    {
        $cart = $this->cart->getAll();

        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $cart
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


    public function getCartApi($id)
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

        // Cari data keranjang berdasarkan ID
        $cart = $this->cart->find($id);

        // Jika data keranjang tidak ditemukan
        if (!$cart) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'message' => 'Cart not found'
            ]);
        }

        // Ambil informasi pelanggan berdasarkan ID pelanggan dalam data keranjang
        $customers = $this->customers->find($cart->id_customer);

        // Ambil informasi produk berdasarkan ID produk dalam data keranjang
        $products = $this->products->find($cart->id_product);

        // Menggabungkan data dari keranjang, pelanggan, dan produk
        $response = [
            'id_cart' => $cart->id_cart,
            'id_customer' => $customers->id_customer,
            'id_product' => $products->id_product,
            'quantity_cart' => $cart->quantity_cart,
            'created_at' => $cart->created_at,
            'updated_at' => $cart->updated_at,
            'deleted_at' => $cart->deleted_at,
            'photo_customer' => $customers->photo_customer,
            'first_name_customer' => $customers->first_name_customer,
            'last_name_customer' => $customers->last_name_customer,
            'email_customer' => $customers->email_customer,
            'phone_customer' => $customers->phone_customer,
            'birthdate_customer' => $customers->birthdate_customer,
            'photo_product' => $products->photo_product,
            'name_product' => $products->name_product,
            'id_category' => $products->id_category,
            'description_product' => $products->description_product,
            'rating_product' => $products->rating_product,
            'price_product' => $products->price_product,
            'stock_product' => $products->stock_product,
            'order_count_product' => $products->order_count_product,
            'status_product' => $products->status_product
        ];

        // Mengembalikan respons dengan data yang ditemukan
        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $response
        ]);
    }



    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $data['customers'] = $this->customers->findAll();
        $data['products'] = $this->products->findAll();
        return view('cart/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();
        $this->cart->insert($data);
        return redirect()->to(site_url('cart'))->with('success', 'Data Berhasil Disimpan');
    }


    public function insertCartApi()
    {
        $requestData = $this->request->getJSON();

        // Validasi dengan menghapus 'required' untuk photo_product
        $validation = [
            'id_customer' => 'required',
            'id_product' => 'required',
            'quantity_cart' => 'required'
        ];

        $validation = $this->validate($validation);

        if (!$validation) {
            $this->response->setStatusCode(400);
            return $this->response->setJSON([
                'code' => 400,
                'status' => 'BAD REQUEST',
                'data' => null
            ]);
        }

        $data = [
            'id_customer' => $requestData->id_customer,
            'id_product' => $requestData->id_product,
            'quantity_cart' => $requestData->quantity_cart
        ];

        $cartModel = new \App\Models\CartModel(); // Buat objek model
        $insert = $cartModel->insert($data); // Gunakan metode insert() dari model

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
                'message' => null
            ]);
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
        $cart = $this->cart->find($id);
        if (is_object($cart)) {
            $data['cart'] = $cart;
            $data['customers'] =  $this->customers->findAll();
            $data['products'] =  $this->products->findAll();
            return view('cart/edit', $data);
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
        $data = $this->request->getPost();
        $this->cart->update($id, $data);
        return redirect()->to(site_url('cart'))->with('success', 'Data Berhasil Diupdate');
    }


    public function updateCartApi($id)
    {
        $cart = $this->cart->find($id);

        if (!$cart) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'data' => 'Product not found'
            ]);
        }

        $requestData = $this->request->getJSON();

        // Persiapkan data untuk pembaruan
        $data = [];

        // Cek atribut mana yang ada dalam permintaan dan tambahkan ke data pembaruan
        if (isset($requestData->id_customer)) {
            $data['id_customer'] = $requestData->id_customer;
        }

        if (isset($requestData->id_product)) {
            $data['id_product'] = $requestData->id_product;
        }

        if (isset($requestData->quantity_cart)) {
            $data['quantity_cart'] = $requestData->quantity_cart;
        }

        // Lakukan pembaruan data produk
        $this->cart->update($id, $data);

        // Kirim respons berhasil
        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => 'Cart updated successfully'
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
        $this->cart->delete($id);
        return redirect()->to(site_url('cart'))->with('success', 'Data Berhasil Dihapus');
    }

    public function deleteCartApi($id)
    {
        $cart = $this->cart->find($id);

        if (!$cart) {
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'NOT FOUND',
                'data' => 'Cart not found'
            ]);
        }

        $this->cart->delete($id);

        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => 'Cart deleted successfully'
        ]);
    }
}
