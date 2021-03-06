<?php

class Column_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('column');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('column', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('column');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('column', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('column');
        return $total;
    }

    public function getOne($id) {
        $query = $this->db->get_where('column', array('id' => $id));
        return $query->result_array();
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("column", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("column");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("column");
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("column", $data);
    }

    public function listBySort($row = 5) {
        $this->db->order_by('sort', 'DESC');
        $query = $this->db->get_where('column', 'status=1', $row);
        return $query->result_array();
    }
}

?>