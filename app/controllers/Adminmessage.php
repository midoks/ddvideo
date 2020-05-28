<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmessage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function index() {
        $this->load->view('admin/message/index');
    }

    public function reply() {

        if (isset($_GET['id'])) {
            $id   = isset($_GET['id']) ? $_GET['id'] : 0;
            $data = $this->message_model->getOne($id)[0];
            $this->parser->parse('admin/message/reply', $data);
        }
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->message_model->lists($page, $limit);

        return $this->retOk('ok', $data['data'], $data['total']);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->message_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxBatchDelete() {
        if (isset($_GET['ids'])) {
            $isOk = $this->message_model->batchDelete($_GET['ids']);
            if ($isOk) {
                return $this->retOk("批量删除成功!");
            }
        }
        return $this->retFail("批量删除失败!");
    }

    public function ajaxReply() {
        if (isset($_POST['id'])) {
            $data['reply']  = $_POST['reply'];
            $data['status'] = 1;
            $isOk           = $this->message_model->update($_POST['id'], $data);
            if ($isOk) {
                return $this->retOk("回复成功!");
            }
        }
        return $this->retFail("回复失败!");
    }
}

?>