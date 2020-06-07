<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
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
            'title' => 'Menu'
        ];
        $this->load->view('admin/menu', $data);
    }

    public function order()
    {
        $data = [
            'title' => 'Order'
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
        $menu = $this->input->post('MenuID');

        var_dump($menu);
    }
}

/* End of file: Admin.php */
