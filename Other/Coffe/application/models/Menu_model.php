<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $_table = 'tb_Menu';

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->query('SELECT * FROM tb_Menu')->result();
        return $query;
    }

    public function addToCart()
    {
    }
}

/* End of file: Menu_model.php */
