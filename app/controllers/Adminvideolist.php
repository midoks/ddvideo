<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvideolist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('videolist_model');
        $this->load->model('videosource_model');
    }

    public function index() {
        $this->load->view('admin/video_list/index');
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $where = '';
        if (isset($_GET['vid'])) {
            $where = 'vid=' . $_GET['vid'];
        }

        $data = $this->videolist_model->lists($page, $limit, $where);

        $this->retOk('ok', $data['data'], $data['total']);
    }

    public function add() {

        $source_list = $this->videosource_model->lists(1, 50);
        $this->load->vars('source_list', $source_list['data']);

        if (isset($_GET['vid'])) {
            $this->load->vars('data_vid', $_GET['vid']);
        }

        if (isset($_GET['id'])) {
            $id   = $_GET['id'];
            $data = $this->videolist_model->getOne($id)[0];
            return $this->parser->parse('admin/video_list/edit', $data);
        }

        return $this->load->view('admin/video_list/add');
    }

    public function ajaxAdd() {

        if (!isset($_POST['vid']) || $_POST['vid'] == "0") {
            return $this->retFail("请输入正确的视频ID");
        }

        if (isset($_POST['id'])) {
            $data = $this->videolist_model->update($_POST['id'], $_POST);
            return $this->retOk('更新成功!');
        }

        $data = $this->videolist_model->add($_POST);
        return $this->retOk('添加成功!', $_POST);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->videolist_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxBatchDelete() {
        if (isset($_GET['ids'])) {
            $isOk = $this->videolist_model->batchDelete($_GET['ids']);
            if ($isOk) {
                return $this->retOk("批量删除成功!");
            }
        }
        return $this->retFail("批量删除失败!");
    }

}

?>