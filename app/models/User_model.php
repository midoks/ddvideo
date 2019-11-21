<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('user');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('user', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('user');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('user', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('user');
        return $total;
    }

    public function getOne($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->result_array();
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("user", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("user");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("video");
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("user", $data);
    }

    public function getByUsername($username) {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->result_array();
    }

    public function isLogin($username, $password) {
        $query = $this->db->get_where('user', array('username' => $username));
        $data  = $query->result_array();

        if (empty($data)) {
            return false;
        }

        $result = $data[0];

        $md5_pwd = md5($password);
        if ($md5_pwd == $result['password']) {
            return true;
        }

        return false;
    }

}

?>