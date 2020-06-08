<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $_table_Menu = 'tb_Menu';
    public $_table_Order = 'tb_Order';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Uuid');
    }

    public function get()
    {
        $query = $this->db->query('SELECT * FROM tb_Menu')->result();
        return $query;
    }

    public function addItemToCart()
    {
        $Quantity = 1;
        $MenuID = $this->input->post('MenuID');
        $Price = $this->input->post('Price');
        $Total = $Price * $Quantity;
        $OrderID = $this->uuid->v4();

        $data = array(
            'OrderID' => $OrderID,
            'MenuID'  => $MenuID,
            'Quantity' => $Quantity,
            'Total'    => $Total,
            'Checkout' => 0
        );

        $result = $this->db->insert($this->_table_Order, $data);
        return $result;
    }

    public function getOrderID()
    {
        return $this->db->query("SELECT OrderID FROM $this->_table_Order WHERE Checkout = 0 ORDER BY ID DESC LIMIT 1")->row();
    }

    public function addOtherItemToCart($OrderID)
    {
        $MenuID = $this->input->post('MenuID');
        // $MenuID = 3;
        // $OrderID = 'd3a37137-e5c7-4ba0-a614-fde8d1ab2c7c';
        $Price = $this->db->query("SELECT Price FROM tb_Menu WHERE MenuID = $MenuID")->row();
        $Price = $Price->Price;
        $Cart = $this->db->query("SELECT ID, MenuID, Quantity FROM $this->_table_Order WHERE OrderID = '$OrderID'")->result();
        foreach ($Cart as $CartItem) {
            $MenuIDFromCart = $CartItem->MenuID;
            $QuantityFromCart = $CartItem->Quantity;
            $onCart = null;
            if ($MenuIDFromCart == $MenuID) {
                $onCart = true;
            }
            if ($onCart) {
                $Quantity = $QuantityFromCart + 1;
                $Total = $Price * $Quantity;
                $data = array(
                    'OrderID' => $OrderID,
                    'MenuID'  => $MenuID,
                    'Quantity' => $Quantity,
                    'Total'    => $Total,
                    'Checkout' => 0
                );
                var_dump($data);
                $result = $this->db->update($this->_table_Order, $data, array('ID' => $CartItem->ID));
                var_dump($result);
                // return $result;
            }
            // if (!$onCart) {
            //     $Quantity = 1;
            //     $Total = $Price * $Quantity;
            //     var_dump($Total);
            //     $data = array(
            //         'OrderID' => $OrderID,
            //         'MenuID'  => $MenuID,
            //         'Quantity' => $Quantity,
            //         'Total'    => $Total,
            //         'Checkout' => 0
            //     );
            //     $result = $this->db->insert($this->_table_Order, $data);
            //     var_dump($result);
            // }
        }
    }
}
    /* End of file: Menu_model.php */
