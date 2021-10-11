<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataAset extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        cekPergroup();
        $this->header('Tabel Data Aset');
        $this->load->view('CHM/list_dataaset', $data);
        $this->footer();
    }

    public function listDataAset()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_data_aset',
            ['no', 'term_id', 'lokasi', 'alamat', 'kantor_layanan', 'uker_induk', 'cluster', 'jam_operational', 'garansi', 'cctv_ada', 'cctv_tidak_ada', 'ups_ada', 'ups_tidak_ada', 'latitude', 'longitude', 'pagu', 'denom', 'keterangan','user','tanggal_update'],
            ['term_id', 'lokasi', 'alamat', 'kantor_layanan', 'uker_induk', 'cluster', 'jam_operational', 'garansi', 'cctv_ada', 'cctv_tidak_ada', 'ups_ada', 'ups_tidak_ada', 'latitude', 'longitude', 'pagu', 'denom', 'keterangan','user','tanggal_update'],
            ['no' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->term_id;
            $row[] = $results->lokasi;
            $row[] = $results->alamat;
            $row[] = $results->kantor_layanan;
            $row[] = $results->uker_induk;
            $row[] = $results->cluster;
            $row[] = $results->jam_operational;
            $row[] = $results->garansi;
            $row[] = $results->cctv_ada;
            $row[] = $results->cctv_tidak_ada;
            $row[] = $results->ups_ada;
            $row[] = $results->ups_tidak_ada;
            $row[] = $results->latitude;
            $row[] = $results->longitude;
            $row[] = $results->pagu;
            $row[] = $results->denom;
            $row[] = $results->keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_data_aset'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_data_aset'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
