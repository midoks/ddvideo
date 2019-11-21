<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincolumn extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('column_model');
    }

    public function index() {
        $this->load->view('admin/column/index');
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->column_model->lists($page, $limit);

        return $this->retOk('ok', $data['data'], $data['total']);
    }

    public function add() {

        if (isset($_GET['id'])) {
            $id   = $_GET['id'];
            $data = $this->column_model->getOne($id)[0];
            return $this->load->view('admin/column/edit', $data);
        }
        return $this->load->view('admin/column/add');
    }

    public function ajaxAdd() {

        if (isset($_POST['id'])) {
            $data = $this->column_model->update($_POST['id'], $_POST);
            return $this->retOk('更新成功!');
        }

        $data = $this->column_model->add($_POST);
        return $this->retOk('添加成功!', $_POST);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->column_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxTriggerStatus() {
        if (isset($_GET['id'])) {
            $data   = $this->column_model->getOne($_GET['id'])[0];
            $status = $data['status'] == 1 ? 0 : 1;
            $isOk   = $this->column_model->update($_GET['id'], ['status' => $status]);
            if ($isOk) {
                return $this->retOk("更改状态成功!");
            }
        }
        return $this->retFail("错误命令!");
    }

}
