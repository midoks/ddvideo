<?php

class Logs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('logs');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('logs', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('logs');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('logs', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('logs');
        return $total;
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("logs", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("logs");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("logs");
    }
}

?>