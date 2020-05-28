<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video_model');

    }

    public function id($page = 1) {
        if ($page < 1) {
            $page = 1;
        }
        $page_row = $this->page_rows;
        $data     = $this->video_model->indexList($page, $page_row);
        $this->load->vars('data_video_list', $data['data']);

        $config['base_url']   = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/page/id';
        $config['total_rows'] = $data['total'];
        $config['per_page']   = $page_row;
        $config               = $this->initPageArgs($config);

        $this->pagination->initialize($config);
        $page_nav = $this->pagination->create_links();
        $this->load->vars('data_page_nav', $page_nav);

        $this->load->renderFront('fronted/page');

    }
}
