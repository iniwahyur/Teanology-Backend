<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\CustomersModel;
use App\Models\CartModel;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Cart extends ResourcePresenter
{
    function __construct() {
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
        if(is_object($cart)) {
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
}
