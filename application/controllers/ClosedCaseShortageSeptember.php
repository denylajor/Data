<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ClosedCaseShortageSeptember extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layanan = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Closed Case Shortage September');
        $this->load->view('Layanan/list_ClosedCaseShortageSeptember', $data);
        $this->footer();
    }

    public function listClosedCaseShortageSeptember()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.Closed_Case_shortage_September_berdasarkan_kategori_kasus',
            ['no', 'Kategori_Kasus', 'Frekuensi', 'Nominal', 'Freq', 'Nom', 'user', 'tanggal_update'],
            ['Kategori_Kasus', 'Frekuensi', 'Nominal', 'Freq', 'Nom', 'user', 'tanggal_update'],
            ['user' => 'DESC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kategori_Kasus;
            $row[] = $results->Frekuensi;
            $row[] = rupiah($results->Nominal);
            $row[] = $results->Freq;
            $row[] = $results->Nom;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.Closed_Case_shortage_September_berdasarkan_kategori_kasus'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.Closed_Case_shortage_September_berdasarkan_kategori_kasus'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
