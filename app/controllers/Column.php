<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Column extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video_model');
        $this->load->model('videolist_model');
        $this->load->model('column_model');
    }

    public function i($col_id = 1) {

        $columnData = $this->column_model->getOne($col_id);
        $this->load->vars('data_column', $columnData[0]);

        $page_row = $this->page_rows;
        $data     = $this->video_model->indexList(0, $page_row, $col_id);

        // var_dump($data);
        $this->load->vars('data_video_list', $data['data']);

        $config['base_url'] = $_SERVER['REQUEST_SCHEME'] . '://' .
            $_SERVER['HTTP_HOST'] . '/column/ii/' . $col_id . '/';
        $config['total_rows'] = $data['total'];
        $config['per_page']   = $page_row;
        $config               = $this->initPageArgs($config);

        $this->pagination->initialize($config);
        $page_nav = $this->pagination->create_links();
        $this->load->vars('data_page_nav', $page_nav);

        $this->load->renderFront('fronted/page_column');
    }

    public function ii($col_id = 1, $page = 0) {

        $columnData = $this->column_model->getOne($col_id);
        $this->load->vars('data_column', $columnData[0]);

        $page_row = $this->page_rows;
        $data     = $this->video_model->indexList($page, $page_row, $col_id);

        $this->load->vars('data_video_list', $data['data']);

        $config['base_url'] = $_SERVER['REQUEST_SCHEME'] . '://' .
            $_SERVER['HTTP_HOST'] . '/column/ii/' . $col_id . '/';
        $config['total_rows'] = $data['total'];
        $config['per_page']   = $page_row;
        $config               = $this->initPageArgs($config);

        $this->pagination->initialize($config);
        $page_nav = $this->pagination->create_links();
        $this->load->vars('data_page_nav', $page_nav);

        $this->load->renderFront('fronted/page_column');
    }

}
