<?php

class Option_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('option');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('option', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('option');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('option', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function getOne($id) {
        $query = $this->db->get_where('option', array('id' => $id));
        return $query->result_array();
    }

    public function getList($data) {
        return $this->db->where_in($data)->get('option')->result_array();
    }

    public function updateByData($data) {

        foreach ($data as $k => $v) {
            $info = $this->db->get_where('option', array('name' => $k))->result_array();
            if (!empty($info)) {
                $this->db->where('id', $info[0]['id']);
                $info[0]['name']         = $k;
                $info[0]['value']        = $v;
                $info[0]['updated_time'] = date('Y-m-d H:i:s');
                $this->db->update("option", $info[0]);
            } else {
                $insert['created_time'] = date('Y-m-d H:i:s');
                $insert['updated_time'] = date('Y-m-d H:i:s');
                $insert['name']         = $k;
                $insert['value']        = $v;
                $this->db->insert("option", $insert);
            }
        }
        return true;
    }

}

?>