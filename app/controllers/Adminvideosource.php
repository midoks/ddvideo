<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvideosource extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('videosource_model');
    }

    public function index() {
        $this->load->view('admin/video_source/index');
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->videosource_model->lists($page, $limit);

        $this->retOk('ok', $data['data'], $data['total']);
    }

    public function add() {

        if (isset($_GET['id'])) {
            $id   = $_GET['id'];
            $data = $this->videosource_model->getOne($id)[0];
            return $this->parser->parse('admin/video_source/edit', $data);

        }
        return $this->load->view('admin/video_source/add');
    }

    public function ajaxAdd() {

        if (isset($_POST['id'])) {
            $data = $this->videosource_model->update($_POST['id'], $_POST);
            return $this->retOk('更新成功!');
        }

        $data = $this->videosource_model->add($_POST);
        return $this->retOk('添加成功!', $_POST);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->videosource_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxBatchDelete() {
        if (isset($_GET['ids'])) {
            $isOk = $this->videosource_model->batchDelete($_GET['ids']);
            if ($isOk) {
                return $this->retOk("批量删除成功!");
            }
        }
        return $this->retFail("批量删除失败!");
    }

}

?>