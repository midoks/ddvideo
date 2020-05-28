<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Home_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function us() {
        $this->load->renderFront('fronted/about_us');
    }

}
