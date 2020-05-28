<?php

class Columntype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('column_type');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('column_type', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('column_type');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('column_type', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('column_type');
        return $total;
    }

    public function getOne($id) {
        $query = $this->db->get_where('column_type', array('id' => $id));
        return $query->result_array();
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("column_type", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("column_type");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("column_type");
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("column_type", $data);
    }

    public function listBySort($row = 5) {
        $this->db->order_by('sort', 'DESC');
        $query = $this->db->get_where('column_type', 'status=1', $row);
        return $query->result_array();
    }
}

?>