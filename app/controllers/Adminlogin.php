<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
        $this->load->model('logs_model');
        $this->load->helper('url');
        $this->load->vars('version', DD_VERSION);
    }

    public function index() {

        $data = $this->session->userdata('user');
        if (!empty($data)) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/admin/index.html');
        }

        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $isLogin = $this->user_model->isLogin($username, $password);
            if ($isLogin) {
                $info = $this->user_model->getByUsername($username);
                $this->session->set_userdata('user', $info[0]);

                $this->logs_model->add(['msg' => '登录成功!', 'type' => 'login']);
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['code' => 0, 'msg' => '登录成功！']));
            } else {
                $msg = '登录失败![' . $username . ':' . $password . ']';
                $this->logs_model->add(['msg' => $msg, 'type' => 'login']);

                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['code' => -1, 'msg' => '登录失败!']));
            }
        }

        $this->load->view('admin/login');
    }

    public function out() {
        $this->session->unset_userdata('user');
        redirect('http://' . $_SERVER['HTTP_HOST'] . '/adminlogin/index.html');
    }
}
