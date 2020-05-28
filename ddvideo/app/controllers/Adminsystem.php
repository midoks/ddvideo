<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsystem extends MY_Controller {

    private $key_list = ['__title', '__keyword', '__desc', '__statis'];

    public function __construct() {
        parent::__construct();
        $this->load->model('option_model');
    }

    public function seo() {
        $key_list = $this->key_list;

        $list_data = $this->option_model->getList($key_list);

        foreach ($list_data as $k => $v) {
            $this->load->vars($v['name'], $v['value']);

        }
        $this->load->view('admin/system/seo');
    }

    public function ajaxAdd() {

        $key_list = $this->key_list;

        $data = [];
        foreach ($key_list as $v) {
            if (isset($_POST[$v])) {
                $data[$v] = $_POST[$v];
            } else {
                $data[$v] = "";
            }
        }
        $data = $this->option_model->updateByData($data);
        return $this->retOk('更新成功!', $_POST);
    }
}
