<?php

class Db_model extends CI_Model {

    public function __construct() {
    }

    public function check() {
        return $this->db->version();
    }

    public function query($sql) {
        return $this->db->query($sql);
    }

    public function addUser($user, $pwd) {
        $data['username']     = $user;
        $data['nick']         = $user;
        $data['password']     = md5($pwd);
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("user", $data);
    }
}

?>