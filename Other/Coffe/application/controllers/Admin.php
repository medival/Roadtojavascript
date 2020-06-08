<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->library('Uuid');
    }

    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $this->load->view('admin/index', $data);
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu',
            'menu' => $this->Menu_model->get()
        ];
        $this->load->view('admin/menu', $data);
    }

    public function order()
    {

        $data = [
            'title' => 'Order',
        ];
        $this->load->view('admin/order', $data);
    }

    public function getMenu()
    {
        $data = $this->Menu_model->get();
        echo json_encode($data);
    }

    public function addToCart()
    {
        $OrderID = $this->Menu_model->getOrderID();
        $OrderID = $OrderID->OrderID;
        if ($OrderID) {
            $data = $this->Menu_model->addOtherItemToCart($OrderID);
            return $data;
        }

        if (!$OrderID) {
            $data = $this->Menu_model->addItemToCart();
            return $data;
        }
    }

    public function isCheckout()
    {
        $OrderID = $this->Menu_model->getOrderID();
        $OrderID = $OrderID->OrderID;
    }

    // public function showCart()
    // {
    // }
}

/* End of file: Admin.php */
