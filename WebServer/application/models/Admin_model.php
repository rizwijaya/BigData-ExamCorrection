<?php
class admin_model extends CI_Model
{
    function siswa() {
        $q = "SELECT t1.*, t2.nama_asal FROM siswa t1 INNER JOIN asal t2 ON t1.id_asal=t2.id_asal";
        $res = $this->db->query($q);
        return $res->result();  
    }

    function get_siswa($limit, $start){
        $query = $this->db->select('t1.*, t2.nama_asal')
                    ->from('siswa as t1')
                    ->join('asal as t2', 't1.id_asal = t2.id_asal', 'LEFT')
                    ->get('siswa', $limit, $start);
        return $query;
    }

    function get_siswabyfilter($id, $limit, $start){
        $query = $this->db->select('t1.*, t2.nama_asal')
                    ->from('siswa as t1')
                    ->join('asal as t2', 't1.id_asal = t2.id_asal', 'LEFT')
                    ->where('t1.id_asal', $id)
                    ->get('siswa', $limit, $start);
        return $query;
    }

    function get_nilai($limit, $start){
        // $q = $this->db->select('t1.nama_siswa, t1.nisn,
        // sum(IF(t2.id_mapel = 1, nilai, NULL)) AS BINDO,
        // sum(IF(t2.id_mapel = 2, nilai, NULL)) AS MTK,
        // sum(IF(t2.id_mapel = 3, nilai, NULL)) AS BIO,
        // sum(IF(t2.id_mapel = 4, nilai, NULL)) AS FIS,
        // sum(IF(t2.id_mapel = 5, nilai, NULL)) AS KIM,
        // sum(IF(t2.id_mapel = 6, nilai, NULL)) AS ENG,
        // sum(IF(t2.id_mapel = 7, nilai, NULL)) AS EKO')
        // ->from('siswa as t1')
        // ->join('ujian as t2', 't1.id_siswa = t2.id_siswa', 'INNER');
        
        // Kalo mau bisa uncomment ini //
        $query = $this->db->select('t1.id_ujian, t1.jml_benar, t1.nilai, t1.nilai_bobot, t2.*, t3.nama_mapel')
                    ->from('ujian as t1')
                    ->join('siswa as t2', 't1.id_siswa = t2.id_siswa', 'INNER')
                    ->join('mapel as t3', 't1.id_mapel = t3.id_mapel', 'INNER')
                    ->get('ujian', $limit, $start);
        // Kalo mau bisa uncomment ini //

        // $query = "SELECT
        //             t1.nama_siswa, t1.nisn,
        //             sum(IF(t2.id_mapel = 1, nilai, NULL)) AS BINDO,
        //             sum(IF(t2.id_mapel = 2, nilai, NULL)) AS MTK,
        //             sum(IF(t2.id_mapel = 3, nilai, NULL)) AS BIO,
        //             sum(IF(t2.id_mapel = 4, nilai, NULL)) AS FIS,
        //             sum(IF(t2.id_mapel = 5, nilai, NULL)) AS KIM,
        //             sum(IF(t2.id_mapel = 6, nilai, NULL)) AS ENG,
        //             sum(IF(t2.id_mapel = 7, nilai, NULL)) AS EKO
        //             FROM
        //                 siswa as t1 INNER JOIN ujian as t2 ON t1.id_siswa = t2.id_siswa
        //             WHERE
        //                 t2.id_siswa BETWEEN 1 AND 1000
        //             GROUP BY
        //                 t2.id_siswa";

        // $res = $this->db->query($query);
        // return $res->result_array();  
        return $query;
    }

    function get_mapel(){
        $q = "SELECT * FROM mapel";
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function get_mapelbyfilter($id, $limit, $start){
        $query = $this->db->select('t2.nisn, t2.nama_siswa, t3.nama_mapel, t1.nilai')
                    ->from('ujian as t1')
                    ->join('siswa as t2', 't1.id_siswa = t2.id_siswa', 'LEFT')
                    ->join('mapel as t3', 't1.id_mapel = t3.id_mapel', 'LEFT')
                    ->where('t1.id_mapel', $id)
                    ->get('ujian', $limit, $start);
        return $query;
    }

    function get_asal(){
        $query = "SELECT * FROM asal";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    function get_kj(){
        $q = "SELECT id_soal, id_mapel, no_soal, jawaban FROM `soal` ";
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function get_jawabansiswa(){
        $q = "SELECT id_siswa, id_mapel, list_jawab FROM `ujian` ";
        $res = $this->db->query($q);
        return $res->result_array();
    }
}