<?php
class data_model extends CI_Model
{
    function getJawaban($id_ujian) {
        // $this->db->select('list_jawab');
        // $this->db->from('ujian');
        // $this->db->where('id_ujian', $id_ujian);
        // return $this->db->get()->row()->list_jawab;
        $q = "SELECT * FROM ujian WHERE id_ujian = " . $id_ujian;
        $res = $this->db->query($q);
        return $res->result();  
    }

    function getSoalById($no, $mapel) {
        $q = "SELECT * FROM soal WHERE no_soal = " . $no . " AND id_mapel = " . $mapel;
        $res = $this->db->query($q);
        return $res->result(); 
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if($batch === false){
            $insert = $this->db->update($table, $data, array($pk => $id));
        }else{
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }
}