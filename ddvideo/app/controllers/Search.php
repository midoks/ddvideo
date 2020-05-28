<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video_model');
    }

    public function w($w = '') {

        $w = urldecode($w);
        $this->load->vars('__search_word', $w);
        $this->setSeo('__title', '搜索【' . $w . '】-');

        $offset = 0;

        $page_row = $this->page_rows;
        $data     = $this->video_model->searchList($w, $offset, $page_row);
        $this->load->vars('data_video_list', $data['data']);

        $config['base_url']   = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/search/p/' . $w;
        $config['total_rows'] = $data['total'];
        $config['per_page']   = $page_row;
        $config               = $this->initPageArgs($config);

        $this->pagination->initialize($config);
        $page_nav = $this->pagination->create_links();
        $this->load->vars('data_page_nav', $page_nav);

        $this->load->renderFront('fronted/page_search');
    }

    public function p($w, $offset = 1) {
        $w = urldecode($w);
        $this->load->vars('__search_word', $w);

        $this->setSeo('__title', '搜索【' . $w . '】-');
        if ($offset < 1) {
            $$offset = 0;
        }

        $page_row = $this->page_rows;
        $data     = $this->video_model->searchList($w, $offset, $page_row);
        $this->load->vars('data_video_list', $data['data']);

        $config['base_url']   = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/search/p/' . $w;
        $config['total_rows'] = $data['total'];
        $config['per_page']   = $page_row;
        $config               = $this->initPageArgs($config);

        $this->pagination->initialize($config);
        $page_nav = $this->pagination->create_links();
        $this->load->vars('data_page_nav', $page_nav);

        $this->load->renderFront('fronted/page_search');
    }

}
