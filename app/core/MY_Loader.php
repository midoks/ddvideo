<?php

class MY_Loader extends CI_Loader {

    public function renderAdmin($template_name, $vars = array(), $return = FALSE) {

        if ($return) {
            $content = $this->view('admin/layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('admin/layout/footer', $vars, $return);
            return $content;
        } else {
            $this->view('admin/layout/header', $vars, $return);
            $this->view($template_name, $vars, $return);
            $this->view('admin/layout/footer', $vars, $return);
        }
    }

    public function renderFront($template_name, $vars = array(), $return = FALSE) {

        if ($return) {
            $content = $this->view('fronted/layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('fronted/layout/footer', $vars, $return);
            return $content;
        } else {
            $this->view('fronted/layout/header', $vars, $return);
            $this->view($template_name, $vars, $return);
            $this->view('fronted/layout/footer', $vars, $return);
        }
    }

    public function renderInstall($template_name, $vars = array(), $return = FALSE) {

        if ($return) {
            $content = $this->view('install/layout/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('fronted/layout/footer', $vars, $return);
            return $content;
        } else {
            $this->view('install/layout/header', $vars, $return);
            $this->view($template_name, $vars, $return);
            $this->view('install/layout/footer', $vars, $return);
        }
    }
}