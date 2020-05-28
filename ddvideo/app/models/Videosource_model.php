<?php

class Videosource_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        $this->db->order_by('id', 'DESC');

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('video_source');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('video_source', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('video_source');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('video_source', $row, ($page - 1) * $row);
        }
        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function getOne($id) {
        $query = $this->db->get_where('video_source', array('id' => $id));
        return $query->result_array();
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("video_source", $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("video_source", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("video_source");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("video_source");
    }

}

?>