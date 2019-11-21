<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminuser extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function ajaxUpdate() {

        if (isset($_POST['id'])) {

            if (isset($_POST['password'])) {
                $_POST['password'] = md5($_POST['password']);
            }

            $isOk = $this->user_model->update($_POST['id'], $_POST);
            if ($isOk) {
                $data = $this->user_model->getOne($_POST['id']);
                $this->session->set_userdata('user', $data[0]);

                return $this->retOk('更新成功!');
            }
        }
        return $this->retFail('更新失败!');
    }

}
