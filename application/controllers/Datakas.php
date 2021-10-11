<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datakas extends MY_Controller
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
        $this->header('Data Kas');
        $this->load->view('Layanan/list_datakas', $data);
        $this->footer();
    }

    public function listDatakas()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.tbl_data_kas',
            ['no', 'kantor_cabang', 'tk_replenish', '__return', 'atm_replenish', 'average_tk', 'average_return', 'average_rpl','user','tanggal_update'],
            ['kantor_cabang', 'tk_replenish', '__return', 'atm_replenish', 'average_tk', 'average_return', 'average_rpl','user','tanggal_update'],
            ['no' => 'DESC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->kantor_cabang;
            $row[] = rupiah($results->tk_replenish);
            $row[] = rupiah($results->__return);
            $row[] = rupiah($results->atm_replenish);
            $row[] = rupiah($results->average_tk);
            $row[] = rupiah($results->average_return);
            $row[] = rupiah($results->average_rpl);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.tbl_data_kas'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.tbl_data_kas'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
