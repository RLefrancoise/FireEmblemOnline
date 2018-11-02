<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__ . '/../models/config/constants.php');
require_once(__DIR__ . '/../models/classes/Weapon.class.php');

class Shop extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('items_instances_model');
        $this->load->model('accounts_warehouses_model');
        $this->load->model('accounts_model');
        $this->load->helper('items');
        $this->load->helper('ajax');
        $this->load->helper('session');
        $this->load->helper('account');
    }

    function index() {
        check_logged_in($this->session);

        try {
            $this->db->trans_begin();

            $data['title']  =   'Shop';

            $data['items'] = get_shop();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/warehouse_item_type_select_menu');
            $this->load->view('shop_view', $data);
            $this->load->view('templates/footer');

            if ($this->db->trans_status() === FALSE) throw new Exception("Transaction Failed");

            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    function buy() {
        send_ajax_if_not_logged_in($this->session);

        try {
            $this->db->trans_begin();

            $item_type = $this->input->post_get('type');
            $item_id = $this->input->post_get('id');

            if(!$item_type || !$item_id) throw new Exception('Missing parameter');

            $item_type = $this->security->xss_clean($item_type);
            $item_id = $this->security->xss_clean($item_id);

            if(in_array($item_type, Weapon::$WEAPON_TYPES)) $item_type = ITEM_TYPE_WEAPON;
            if($item_type == 'other') $item_type = ITEM_TYPE_GENERIC_ITEM;

            $item = get_item_by_type($item_type, $item_id);
            if($item === false) {
                throw new Exception("Item doesn't exist");
            }

            $account = get_account();

            if($item->getWorth() === null) throw new Exception('Item not buyable');
            if($item->getWorth() > $account->getGold()) throw new Exception('Not enough gold');

            //create item instance
            $instance = $this->items_instances_model->create_instance($item);

            //add it to the warehouse
            $this->accounts_warehouses_model->add_item_to_warehouse($account->getId(), $instance->getInstanceId());

            //decrease gold
            give_gold($account, -1 * $item->getWorth());

            if ($this->db->trans_status() === FALSE) throw new Exception("Transaction Failed");

            $this->db->trans_commit();

            send_ajax_success(array(
                'gold'  =>  $account->getGold(),
            ));
        } catch(Exception $e) {
            $this->db->trans_rollback();
            send_ajax_error($e->getMessage());
        }
    }
}

?>

