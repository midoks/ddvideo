<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Base_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');

        if (!file_exists(ROOTPATH . '/dd-config.php')) {
            redirect($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/install');
            exit;
        }

        $this->load->database();
        $this->load->model('logs_model');
        $this->load->library('parser');

        $this->load->vars('version', DD_VERSION);
    }

    public function log($msg, $type = 'log') {
        $this->logs_model->add(['msg' => $msg, 'type' => $type]);
    }

    public function retOk($msg = 'ok', $data = [], $count = 0) {
        $_data['code'] = 0;
        $_data['msg']  = $msg;
        if (!empty($data)) {
            $_data['data'] = $data;
        }
        if (!empty($count)) {
            $_data['count'] = $count;
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($_data));
    }

    public function retFail($msg = 'fail', $data = []) {
        $_data['code'] = -1;
        $_data['msg']  = $msg;
        if (!empty($data)) {
            $_data['data'] = $data;
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($_data));
    }
}

class MY_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->initAdmin();
    }

    public function initAdmin() {

        $data = $this->session->userdata('user');
        if (empty($data)) {
            redirect('http://' . $_SERVER['HTTP_HOST'] . '/adminlogin/index');
        }
        $this->baseVer();
    }

    public function baseVer() {
        $this->load->vars('_userinfo', $this->session->userdata('user'));
    }

}

class Home_Controller extends Base_Controller {

    protected $page_rows = 10;

    protected $__seo = [];

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('column_model');
        $this->load->model('video_model');
        $this->load->model('option_model');
        $this->initVars();
    }

    public function initVars() {

        $_column_list = $this->column_model->listBySort();
        $this->load->vars('_column_list', $_column_list);

        $_statis_today = $this->video_model->statisToday();
        $this->load->vars('_statis_today', $_statis_today);

        $_statis_all = $this->video_model->statisAll();
        $this->load->vars('_statis_all', $_statis_all);

        $key_list  = ['__title', '__keyword', '__desc', '__statis'];
        $list_data = $this->option_model->getList($key_list);
        foreach ($list_data as $k => $v) {
            $this->__seo[$v['name']] = $v['value'];
            $this->load->vars($v['name'], $v['value']);
        }
    }

    public function setSeo($key, $value) {
        if (isset($this->__seo[$key])) {
            $v = $value . ' - ' . $this->__seo[$key];
            $this->load->vars($key, $v);
        }
    }

    public function initPageArgs($config) {
        $config['base_url']   = $config['base_url'];
        $config['total_rows'] = $config['total_rows'];
        $config['per_page']   = $config['per_page'];

        $config['cur_tag_open']    = '<li><a>';
        $config['cur_tag_close']   = '</a></li>';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['num_links'] = 3;

        $config['suffix'] = '.html';
        return $config;
    }

}