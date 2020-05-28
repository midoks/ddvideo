<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogs extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logs_model');
    }

    public function index() {
        $this->load->view('admin/logs/index');
    }

    public function lists() {

        $this->load->model('logs_model');

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->logs_model->lists($page, $limit);

        return $this->retOk('ok', $data['data'], $data['total']);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->logs_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxBatchDelete() {
        if (isset($_GET['ids'])) {
            $isOk = $this->logs_model->batchDelete($_GET['ids']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

}
