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

    public function addItemToNewCart()
    {
        $Quantity = 1;
        $MenuID = $this->input->post('MenuID');
        $Price = $this->CheckItemPrice($MenuID);
        $Price = $Price->Price;
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

    public function UpdateItemToCart($ID, $MenuID)
    {
        $Price = $this->CheckItemPrice($MenuID);
        $Price = $Price->Price;
        $Quantity = $this->CheckItemQuantity($ID);
        $Quantity = ($Quantity->Quantity) + 1;
        $data = array(
            'Quantity' => $Quantity,
            'Total' => $Quantity * $Price
        );
        return $this->db->update($this->_table_Order, $data, array('ID' => $ID));
    }

    public function updateItemOnCart($ID, $Quantity, $Total)
    {
        $data = array(
            'Quantity' => $Quantity,
            'Total'    => $Total,
        );
        $this->db->update($this->_table_Order, $data, array('ID' => $ID));
    }

    public function CheckItemPrice($MenuID)
    {
        return $this->db->query("SELECT Price FROM $this->_table_Menu WHERE MenuID = $MenuID")->row();
    }

    public function CheckItemOnCart($MenuID, $OrderID)
    {
        $ItemOnCart = $this->db->query("SELECT ID, MenuID AS ItemOnCart FROM $this->_table_Order WHERE OrderID = '$OrderID'")->result_array();
        $ItemsOnCart = array();

        foreach ($ItemOnCart as $key => $Item) {
            $ItemsOnCart[] = $Item['ItemOnCart'];
        }

        if (in_array($MenuID, $ItemsOnCart)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function GetWhereID($MenuID, $OrderID)
    {
        return $this->db->query("SELECT ID FROM $this->_table_Order WHERE OrderID = '$OrderID' AND MenuID = $MenuID LIMIT 1")->row();
    }

    public function CheckItemQuantity($resultID)
    {
        return $this->db->query("SELECT Quantity FROM tb_Order WHERE ID = $resultID LIMIT 1")->row();
    }

    public function AddOtherItemToCart($OrderID, $MenuID)
    {
        $Price = $this->CheckItemPrice($MenuID);
        $Price = $Price->Price;
        $Quantity = 1;
        $data = array(
            'OrderID' => $OrderID,
            'MenuID' => $MenuID,
            'Quantity' => $Quantity,
            'Total' => $Price *  $Quantity,
            'Checkout' => 0
        );

        return $this->db->insert($this->_table_Order, $data);
    }

    public function getItemOnCart($OrderID)
    {
        return $this->db->query("SELECT O.ID, M.Menu, O.OrderID, O.MenuID, O.Quantity, M.Image, M.Price
                                FROM $this->_table_Order AS O
                                JOIN $this->_table_Menu AS M
                                ON O.MenuID = M.MenuID
                                WHERE OrderID = '$OrderID' AND Checkout = 0")->result_array();
    }
}   
    /* End of file: Menu_model.php */
