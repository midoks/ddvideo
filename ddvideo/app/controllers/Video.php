<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video_model');
        $this->load->model('videolist_model');
    }

    public function i($id) {

        $data_video = $this->video_model->getOne($id);
        $this->load->vars('data_video', $data_video[0]);

        $columnData = $this->column_model->getOne($data_video[0]['col_id']);
        $this->load->vars('data_column', $columnData[0]);

        $this->setSeo('__title', $data_video[0]['name']);
        $this->setSeo('__keyword', $data_video[0]['intro']);
        $this->setSeo('__desc', $data_video[0]['intro']);

        $data = $this->video_model->getList($id);
        $this->load->vars('data_video_list', $data);

        $this->load->renderFront('fronted/video');
    }

    public function ii($id) {

        $videolist_data = $this->videolist_model->getOne($id);
        $this->load->vars('data_video_seleced', $videolist_data[0]);

        $data_video = $this->video_model->getOne($videolist_data[0]['vid']);

        $this->setSeo('__title', $data_video[0]['name']);
        $this->setSeo('__keyword', $data_video[0]['intro']);
        $this->setSeo('__desc', $data_video[0]['intro']);

        $this->load->vars('data_video', $data_video[0]);
        $this->load->vars('data_video_list', []);

        $columnData = $this->column_model->getOne($data_video[0]['col_id']);
        $this->load->vars('data_column', $columnData[0]);

        if (!empty($videolist_data)) {
            $data = $this->video_model->getListSelect($videolist_data[0]['vid'], $id);

            if (!empty($data['data'])) {

                $this->load->vars('data_video_select', $data['select']);
                $this->load->vars('data_video_list', $data['data']);
            }
        }
        $this->load->renderFront('fronted/play');
    }
}
