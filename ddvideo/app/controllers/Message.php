<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function receive() {
        $this->load->renderFront('fronted/message');
    }

    public function lists() {

        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

        $data = $this->message_model->lists($page, $limit);

        return $this->retOk('ok', $data['data'], $data['total']);
    }

    public function add() {
        $data = $this->message_model->add($_POST);
        if ($data) {
            return $this->retOk('留言成功!');
        }
        return $this->retFail("留言失败!");
    }

    public function code() {
        $this->load->helper('captcha');

        $vals = array(
            'word'        => 'Random word',
            'img_path'    => './captcha/',
            'img_url'     => 'http://example.com/captcha/',
            'font_path'   => './path/to/fonts/texb.ttf',
            'img_width'   => '150',
            'img_height'  => 30,
            'expiration'  => 7200,
            'word_length' => 8,
            'font_size'   => 16,
            'img_id'      => 'Imageid',
            'pool'        => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'      => array(
                'background' => array(255, 255, 255),
                'border'     => array(255, 255, 255),
                'text'       => array(0, 0, 0),
                'grid'       => array(255, 40, 40),
            ),
        );

        $cap = create_captcha($vals);
        echo $cap['image'];
    }

}
