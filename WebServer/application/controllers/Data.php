<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //load the department_model
        $this->load->model('data_model');
    }

    public function index()
    {
        $this->load->view('home');
    }

    function insert_dumy()
    {
        // jumlah data yang akan di insert
        $jumlah_data = 3500000;
        $min = 18;
        $max = 40;
        for ($i = 1; $i <= $jumlah_data; $i++) {
            $jml_benar = rand($min, $max);
            $nilai = $jml_benar * 2.5;
            $data   =   array(
                "id_siswa"  =>  "" . $i,
                "id_soal"         =>  "7",
                "jml_benar"         =>  "" . $jml_benar,
                "nilai"          =>  "" . $nilai
            );
            $this->db->insert('ujian', $data);
        }
        echo $i . ' Data Berhasil Di Insert';
    }

    function getOption()
    {
        $n = 1;
        $characters = 'ABCD';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        //echo $randomString;
        return $randomString;
    }
    #Generating data ujian 3,5juta waktu 1 jam 3 menit
    function dataUjian()
    {
        // jumlah data yang akan di insert
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        $jumlah_siswa = 500000;
        $jumlah_mapel = 7;
        $ujian = 1;
        for ($mapel = 1; $mapel <= $jumlah_mapel; $mapel++) {
            for ($siswa = 1; $siswa <= $jumlah_siswa; $siswa++) {
                $listjawaban = "1:" . $this->getOption() . ":N,2:" . $this->getOption() . ":N,3:" . $this->getOption() . ":N,4:" . $this->getOption() . ":N,5:" . $this->getOption() . ":N,6:" . $this->getOption() . ":N,7:" . $this->getOption() . ":N,8:" . $this->getOption() . ":N,9:" . $this->getOption() . ":N,10:" . $this->getOption() . ":N,11:" . $this->getOption() . ":N,12:" . $this->getOption() . ":N,13:" . $this->getOption() . ":N,14:" . $this->getOption() . ":N,15:" . $this->getOption() . ":N,16:" . $this->getOption() . ":N,17:" . $this->getOption() . ":N,18:" . $this->getOption() . ":N,19:" . $this->getOption() . ":N,20:" . $this->getOption() . ":N,21:" . $this->getOption() . ":N,22:" . $this->getOption() . ":N,23:" . $this->getOption() . ":N,24:" . $this->getOption() . ":N,25:" . $this->getOption() . ":N,26:" . $this->getOption() . ":N,27:" . $this->getOption() . ":N,28:" . $this->getOption() . ":N,29:" . $this->getOption() . ":N,30:" . $this->getOption() . ":N,31:" . $this->getOption() . ":N,,32:" . $this->getOption() . ":N,33:" . $this->getOption() . ":N,34:" . $this->getOption() . ":N,35:" . $this->getOption() . ":N,36:" . $this->getOption() . ":N,37:" . $this->getOption() . ":N,38:" . $this->getOption() . ":N,39:" . $this->getOption() . ":N,40:" . $this->getOption() . ":N";
                $listsoal = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40";
                $data   =   array(
                    "id_siswa"    =>  "" . $siswa,
                    "id_mapel"    =>  "" . $mapel,
                    "list_soal"   => "" . $listsoal,
                    "list_jawab"  => "" . $listjawaban,
                    "jml_benar"   =>  "NULL",
                    "nilai"       =>  "NULL",
                    "nilai_bobot" => 100
                );
                //var_dump($data); die; exit;
                $this->db->insert('ujian', $data);
                $ujian++;
            }
        }
        echo $ujian . ' Data Berhasil Di Insert';
    }
    #Generating waktu ngga smpe 1 menit, cuepet.
    function CreateSoal()
    {
        $jawaban = $this->getOption();
        $jumlah_soal = 40;
        $jumlah_mapel = 7;
        $id_soal = 1;
        for ($mapel = 1; $mapel <= $jumlah_mapel; $mapel++) {
            for ($soal = 1; $soal <= $jumlah_soal; $soal++) {
                $soalnya = "Soal Mapel " . $mapel . " Nomor " . $soal;
                $opsi_a = "Pilihan A, Mapel:" . $mapel;
                $opsi_b = "Pilihan B, Mapel:" . $mapel;
                $opsi_c = "Pilihan C, Mapel:" . $mapel;
                $opsi_d = "Pilihan D, Mapel:" . $mapel;
                $jawaban = $this->getOption();
                $data   =   array(
                    "id_mapel"  =>  "" . $mapel,
                    "soal"      =>  "" . $soalnya,
                    "no_soal"   =>  "" . $soal,
                    "file_soal" =>  "NULL",
                    "opsi_a"    =>  "" . $opsi_a,
                    "opsi_b"    =>  "" . $opsi_b,
                    "opsi_c"    =>  "" . $opsi_c,
                    "opsi_d"    =>  "" . $opsi_d,
                    "jawaban"   =>  "" . $jawaban
                );
                $this->db->insert('soal', $data);
                $id_soal++;
            }
        }
        echo $id_soal . ' Data Berhasil Di Insert';
    }

    #Buat Reset DB UPDATE ujian SET nilai = 0, jml_benar = 0 WHERE id_ujian <= 100;
    function cekJawaban()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;

        //$total_ujian = 3500000;
        $total_ujian = 1000;
        for ($id_ujian = 1; $id_ujian <= $total_ujian; $id_ujian++) {
            //Get Jawaban
            $list = $this->data_model->getJawaban($id_ujian);
            foreach ($list as $lj) {
                $list_jawaban = $lj->list_jawab;
                // Pecah Jawaban
                $pc_jawaban = explode(",", $list_jawaban);
                $jumlah_benar     = 0;
                $jumlah_salah     = 0;
                $jumlah_ragu      = 0;
                $nilai_bobot     = 0;
                $total_bobot    = 0;
                $jumlah_soal    = sizeof($pc_jawaban);

                foreach ($pc_jawaban as $jwb) {
                    $pc_dt       = explode(":", $jwb);
                    $no_soal     = @$pc_dt[0];
                    $jawaban     = @$pc_dt[1];
                    $ragu        = @$pc_dt[2];
                    $cek_jwb     = $this->data_model->getSoalById((int)$no_soal, $lj->id_mapel);
                    $total_bobot = $total_bobot + 2.5;
                    foreach ($cek_jwb as $kunci) {
                        $jawaban == $kunci->jawaban ? $jumlah_benar++ : $jumlah_salah++;
                    }
                }
                $nilai = ($jumlah_benar / $jumlah_soal)  * 100;
                $d_update = [
                    'jml_benar'        => $jumlah_benar,
                    'nilai'            => number_format(floor($nilai), 0)
                ];

                $this->data_model->update('ujian', $d_update, 'id_ujian', $lj->id_ujian);
            }
        }
        echo "Ujian yang berhasil dikoreksi " . $id_ujian;
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $start), 4);
        echo '<br>';
        echo 'Kecepatan Koreksi '.$total_time.' detik.';
    }
}
