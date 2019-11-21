<?php

class Server_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('server');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('server', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('server');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('server', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('server');
        return $total;
    }

    public function getOne($id) {
        $query = $this->db->get_where('server', array('id' => $id));
        return $query->result_array();
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("server", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("server");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("server");
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("server", $data);
    }

    public function listBySort($row = 5) {
        $this->db->order_by('sort', 'DESC');
        $query = $this->db->get_where('server', 'status=1', $row);
        return $query->result_array();
    }

    public function getList($page = 1, $row = 10) {
        $query = $this->db->where('status', 1)->select('id,addr')->get('server', $row, ($page - 1) * $row);
        return $query->result_array();
    }
}

?>