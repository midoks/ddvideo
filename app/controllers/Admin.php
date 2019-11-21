<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logs_model');
        $this->load->model('message_model');
        $this->load->model('user_model');
        $this->load->model('video_model');
    }

    public function index() {
        $this->load->renderAdmin('admin/index');
    }

    public function info() {
        $this->load->view('admin/info');
    }

    public function repwd() {
        $this->load->view('admin/repwd');
    }

    public function console() {

        $this->load->view('admin/console');
    }

    public function ajaxConsole() {

        $data['logs_num']    = $this->logs_model->count();
        $data['message_num'] = $this->message_model->count();
        $data['video_num']   = $this->video_model->count();
        $data['user_num']    = $this->user_model->count();

        return $this->retOk('资源获取成功!', $data);
    }

    public function menu() {
        $this->load->view('admin/menu');
    }

}
