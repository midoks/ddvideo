<?php

class Video_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lists($page = 1, $row = 10, $where = '') {

        if (!empty($where)) {
            $total = $this->db->where($where)->count_all_results('video');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get_where('video', $where, $row, ($page - 1) * $row);

        } else {
            $total = $this->db->count_all_results('video');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('video', $row, ($page - 1) * $row);
        }

        return [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
    }

    public function count() {
        $total = $this->db->count_all_results('video');
        return $total;
    }

    public function getOne($id) {
        $query = $this->db->get_where('video', array('id' => $id));
        return $query->result_array();
    }

    public function getList($id) {

        $tb_video = $this->db->select('id,sid')
            ->group_by('sid')
            ->get_where('video_list', array('vid' => $id))
            ->result_array();

        foreach ($tb_video as $k => $value) {

            $info = $this->db->order_by('sort', 'DESC')
                ->get_where('video_list', array('vid' => $id, 'sid' => $value['sid']))
                ->result_array();
            $tb_video[$k]['list'] = $info;

            if ($value['sid'] == 0) {
                $tb_video[$k]['source_name'] = "无设置";
            } else {
                $tb_source = $this->db->select('id,name')
                    ->get_where('video_source', array('id' => $value['sid']))
                    ->result_array();

                if (!empty($tb_source)) {
                    $tb_video[$k]['source_name'] = $tb_source[0]['name'];
                } else {
                    $tb_video[$k]['source_name'] = "来源已删除";
                }
            }
        }

        return $tb_video;
    }

    public function getListSelect($id, $list_id) {

        $tb_video = $this->db->select('id,sid')
            ->group_by('sid')
            ->get_where('video_list', array('vid' => $id))
            ->result_array();

        $select_data = [];
        foreach ($tb_video as $k => $value) {

            $info = $this->db->order_by('sort', 'DESC')
                ->get_where('video_list', array('vid' => $id, 'sid' => $value['sid']))
                ->result_array();
            $tb_video[$k]['list'] = $info;

            foreach ($info as $ik => $iv) {
                if ($iv['id'] == $list_id) {
                    $select = $info[$ik];
                }
            }

            if ($value['sid'] == 0) {
                $tb_video[$k]['source_name'] = "无设置";
            } else {
                $tb_source = $this->db->select('id,name')
                    ->get_where('video_source', array('id' => $value['sid']))
                    ->result_array();

                if (!empty($tb_source)) {
                    $tb_video[$k]['source_name'] = $tb_source[0]['name'];
                } else {
                    $tb_video[$k]['source_name'] = "来源已删除";
                }
            }
        }
        return ['data' => $tb_video, 'select' => $select];
    }

    public function add($data) {
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->insert("video", $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete("video");
    }

    public function batchDelete($ids) {
        $ids = explode(',', trim($ids, ','));
        return $this->db->where_in('id', $ids)->delete("video");
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $data['updated_time'] = date('Y-m-d H:i:s');
        return $this->db->update("video", $data);
    }

    public function statisToday() {
        $time  = date('Y-m-d') . ' 00:00:00';
        $total = $this->db->where('status', 1)
            ->where('updated_time > ', $time)
            ->count_all_results('video');
        return $total;
    }

    public function statisAll() {
        $total = $this->db->where('status', 1)->count_all_results('video');
        return $total;
    }

    //

    public function indexList($offset = 0, $row = 10, $col_id = 0) {
        // var_dump($page, $row, $col_id);
        $dataSql = $this->db->select('video.id,video.name,column_type.updated_time, column_type.name as col_type_name');

        if ($col_id) {
            $dataSql = $dataSql->where('video.col_id', $col_id);
        }

        $dataSql = $dataSql->where('video.status', 1);
        $dataSql = $dataSql->from('video');
        $dataSql = $dataSql->join('column_type', ' column_type.id =  video.col_type', 'left');
        $dataSql = $dataSql->order_by('video.id', 'DESC');
        $dataSql = $dataSql->limit($row, $offset);
        // var_dump($this->db->get_compiled_select());exit;
        $query = $dataSql->get();

        $totalQuery = $this->db->where('status', 1);
        if ($col_id) {
            $totalQuery = $this->db->where('col_id', $col_id);
        }
        $total = $totalQuery->count_all_results('video');

        $r = [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
        return $r;
    }

    public function searchList($word, $offset = 0, $row = 10, $col_id = 0) {
        $dataSql = $this->db->select('video.id,video.name,column_type.updated_time, column_type.name as col_type_name');

        if ($col_id) {
            $dataSql = $dataSql->where('video.col_id', $col_id);
        }

        $dataSql = $dataSql->where('video.status', 1);
        $dataSql = $dataSql->from('video');
        $dataSql = $dataSql->join('column_type', ' column_type.id =  video.col_type', 'left');
        $dataSql = $dataSql->order_by('video.id', 'DESC');
        $dataSql = $dataSql->limit($row, $offset);

        $dataSql = $dataSql->where('video.name like "%' . $word . '%"');
        // var_dump($this->db->get_compiled_select());exit;
        $query = $dataSql->get();

        $totalQuery = $this->db->where('status', 1);
        $totalQuery = $totalQuery->where('name like "%' . $word . '%"');
        if ($col_id) {
            $totalQuery = $this->db->where('col_id', $col_id);
        }
        $total = $totalQuery->count_all_results('video');

        $r = [
            'data'  => $query->result_array(),
            'total' => $total,
        ];
        return $r;
    }

}

?>