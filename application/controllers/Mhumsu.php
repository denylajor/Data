<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mhumsu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Tabel MHU & MSU');
        $this->load->view('Layanan/list_mshu&msu', $data);
        $this->footer();
    }

    public function listMhumsu()
    {

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.tbl_mhu_dan_msu',
            ['no', 'kode', 'kanca', 'project', 'type_mesin', 'serial_number', 'versi_software', 'tahun_produksi', 'tahun_pengadaan', 'jumlah_pocket', 'jenis_mesin', 'aktivitas_mesin', 'kepemilikan', 'kondisi', 'keterangan','user','tanggal_update'],
            ['kode', 'kanca', 'project', 'type_mesin', 'serial_number', 'versi_software', 'tahun_produksi', 'tahun_pengadaan', 'jumlah_pocket', 'jenis_mesin', 'aktivitas_mesin', 'kepemilikan', 'kondisi', 'keterangan','user','tanggal_update'],
            ['tahun_produksi' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->kode;
            $row[] = $results->kanca;
            $row[] = $results->project;
            $row[] = $results->type_mesin;
            $row[] = $results->serial_number;
            $row[] = $results->versi_software;
            $row[] = $results->tahun_produksi;
            $row[] = $results->tahun_pengadaan;
            $row[] = $results->jumlah_pocket;
            $row[] = $results->jenis_mesin;
            $row[] = $results->aktivitas_mesin;
            $row[] = $results->kepemilikan;
            $row[] = $results->kondisi;
            $row[] = $results->keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.tbl_mhu_dan_msu'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.tbl_mhu_dan_msu'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
