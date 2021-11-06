<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load libary pagination
        $this->load->library('pagination');

        //load the department_model
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $config['base_url'] = site_url('admin/index'); //site url
        $config['total_rows'] = $this->db->count_all('siswa'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        //$data['page'] = $this->uri->segment($config["uri_segment"]);
        $data['siswa'] = $this->Admin_model->get_siswa($config["per_page"], $data['page']);
        $data['lokasi'] = $this->Admin_model->get_asal();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin', $data);
        $this->load->view('template/dashboard/footer');
    }

    function filterasal($id) {
        $config['base_url'] = site_url('admin/filterasal/' . $id); //site url
        $config['total_rows'] = $this->db->count_all('siswa'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        //$data['page'] = $this->uri->segment($config["uri_segment"]);
        $data['siswa'] = $this->Admin_model->get_siswabyfilter($id,$config["per_page"], $data['page']);
        $data['lokasi'] = $this->Admin_model->get_asal();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin', $data);
        $this->load->view('template/dashboard/footer');        
    }

    function datanilai(){
        $config['base_url'] = site_url('admin/datanilai'); //site url
        $config['total_rows'] = $this->db->count_all('ujian'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        //$data['page'] = $this->uri->segment($config["uri_segment"]);
        $data['nilai'] = $this->Admin_model->get_nilai($config["per_page"], $data['page']);
        $data['mapel'] = $this->Admin_model->get_mapel();
        // var_dump($data['nilai']);
        // die();
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('datanilai', $data);
        $this->load->view('template/dashboard/footer');
    }

    function filtermapel($id){
        $config['base_url'] = site_url('admin/filtermapel/' . $id); //site url
        $config['total_rows'] = $this->db->count_all('ujian'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        //$data['page'] = $this->uri->segment($config["uri_segment"]);
        $data['nilai'] = $this->Admin_model->get_mapelbyfilter($id,$config["per_page"], $data['page']);
        $data['mapel'] = $this->Admin_model->get_mapel();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('datanilai', $data);
        $this->load->view('template/dashboard/footer');

    }

    // function getNilai() {

    // }
    // function insert_dumy()
    // {
    //     // jumlah data yang akan di insert
    //     $jumlah_data = 3500000;
    //     $min = 18;
    //     $max = 40;
    //     for ($i = 1; $i <= $jumlah_data; $i++) {
    //         $jml_benar = rand($min, $max);
    //         $nilai = $jml_benar * 2.5;
    //         $data   =   array(
    //             "id_siswa"  =>  "" . $i,
    //             "id_soal"         =>  "7",
    //             "jml_benar"         =>  "" . $jml_benar,
    //             "nilai"          =>  "" . $nilai
    //         );
    //         $this->db->insert('ujian', $data);
    //     }
    //     echo $i . ' Data Berhasil Di Insert';
    // }

    // function diagram()
    // {
    //     $this->load->view('diagram_copy');
    // }

    // function diagramnilai() {
    //     $data['graph'] = $this->admin_model-->graph();
    //     $this->load->view('chart', $data);
    // }
}
