<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('accounts_warehouses_model');
    }

    function index() {
        check_logged_in($this->session);

        try {
            $this->db->trans_begin();

            $data['title']  =   'Items';

            $data['items']  =   $this->accounts_warehouses_model->get_account_warehouse(get_account()->getId());

            $this->load->view('templates/header', $data);
            $this->load->view('templates/warehouse_item_type_select_menu');
            $this->load->view('warehouse_view', $data);
            $this->load->view('templates/footer');

            if ($this->db->trans_status() === FALSE) throw new Exception("Transaction Failed");

            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
}

?>

