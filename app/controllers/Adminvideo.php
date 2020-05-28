<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvideo extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video_model');
        $this->load->model('column_model');
    }

    public function index() {
        $this->load->view('admin/video/index');
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->video_model->lists($page, $limit);

        $this->retOk('ok', $data['data'], $data['total']);
    }

    public function add() {

        $column_data = $this->column_model->lists(1, 100, 'status=1 and type=0');
        $column_list = $column_data['data'];
        $this->load->vars('data_column_list', $column_list);

        if (isset($_GET['id'])) {
            $id   = $_GET['id'];
            $data = $this->video_model->getOne($id)[0];
            return $this->load->view('admin/video/edit', $data);

        }
        return $this->load->view('admin/video/add');
    }

    public function addPlay() {

        $data['vid'] = isset($_GET['id']) ? $_GET['id'] : 0;
        return $this->parser->parse('admin/video/play', $data);
    }

    public function ajaxAdd() {

        if (isset($_POST['id'])) {
            $data = $this->video_model->update($_POST['id'], $_POST);
            return $this->retOk('更新成功!');
        }

        $data = $this->video_model->add($_POST);
        return $this->retOk('添加成功!', $_POST);
    }

    public function ajaxDelete() {
        if (isset($_GET['id'])) {
            $isOk = $this->video_model->delete($_GET['id']);
            if ($isOk) {
                return $this->retOk("删除成功!");
            }
        }
        return $this->retFail("删除失败!");
    }

    public function ajaxBatchDelete() {
        if (isset($_GET['ids'])) {
            $isOk = $this->video_model->batchDelete($_GET['ids']);
            if ($isOk) {
                return $this->retOk("批量删除成功!");
            }
        }
        return $this->retFail("批量删除失败!");
    }

    public function ajaxTriggerStatus() {
        if (isset($_GET['id'])) {
            $data   = $this->video_model->getOne($_GET['id'])[0];
            $status = $data['status'] == 1 ? 0 : 1;
            $isOk   = $this->video_model->update($_GET['id'], ['status' => $status]);
            if ($isOk) {
                return $this->retOk("更改状态成功!");
            }
        }
        return $this->retFail("错误命令!");
    }

}

?>