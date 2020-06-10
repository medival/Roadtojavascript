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
        if ($OrderID != NULL) {
            $OrderID = $OrderID->OrderID;
        } else if ($OrderID == NULL) {
            echo 'create new cart';
        }

        if ($OrderID) {
            $MenuID = $this->input->post('MenuID');
            $resultCheck = $this->Menu_model->CheckItemOnCart($MenuID, $OrderID);
        }

        if ($resultCheck === 1) {
            $resultID = $this->Menu_model->GetWhereID($MenuID, $OrderID);
            $ID = $resultID->ID;
            $this->Menu_model->UpdateItemToCart($ID, $MenuID);
        } else if ($resultCheck === 0) {
            $MenuID = $this->input->post('MenuID');
            $this->Menu_model->AddOtherItemToCart($OrderID, $MenuID);
        }

        if (!$OrderID) {
            $data = $this->Menu_model->addItemToNewCart();
            return $data;
        }
    }

    public function isCheckout()
    {
        $OrderID = $this->Menu_model->getOrderID();
        $OrderID = $OrderID->OrderID;
    }

    public function showCart()
    {
        $OrderID = $this->Menu_model->getOrderID();
        if ($OrderID != NULL) {
            $OrderID = $OrderID->OrderID;
        } else {
            echo 'no item';
        }
        // var_dump($OrderID);
        $data = array(
            'data' => $this->Menu_model->getItemOnCart($OrderID),
            'Total' => $this->Menu_model->getTotalOrderOnCart($OrderID)
        );
        // $Total = $this->Menu_model->getTotalOrderOnCart($OrderID);
        echo json_encode($data);
    }

    public function removeItemFromChart()
    {
        $ID = $this->input->post('ID');
        $data =  $this->Menu_model->removeItem($ID);
        echo json_encode($data);
    }

    public function updateQuantity()
    {
        $ID = $this->input->post('ID');
        $MenuID = $this->input->post('MenuID');
        $Quantity = $this->input->post('Quantity');

        if ($ID && $MenuID && ($Quantity > 0)) {
            $data =  $this->Menu_model->updateQuantity($ID, $MenuID, $Quantity);
            echo json_encode($data);
        }
    }

    public function checkoutCart()
    {
        $data = $this->Menu_model->checkoutCart();
        echo json_encode($data);
    }
    // public function 
}

/* End of file: Admin.php */
