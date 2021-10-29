<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReliabilityHarianBG extends MY_Controller
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
        $this->header('Reliability Harian BG');
        $this->load->view('Layanan/list_reliabilityHarianBG', $data);
        $this->footer();
    }

    public function listReliabilityHarianBG()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.reliability_harian_bg',
            ['no', 'Kantor_Layanan', 'Jam_Capture_0', 'Jam_Capture_3', 'Jam_Capture_6', 'Jam_Capture_9', 'Jam_Capture_12', 'Jam_Capture_15', 'Jam_Capture_18', 'Jam_Capture_21', 'Average', 'user', 'tanggal_update'],
            ['Kantor_Layanan', 'Jam_Capture_0', 'Jam_Capture_3', 'Jam_Capture_6', 'Jam_Capture_9', 'Jam_Capture_12', 'Jam_Capture_15', 'Jam_Capture_18', 'Jam_Capture_21', 'Average', 'user', 'tanggal_update'],
            ['user' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kantor_Layanan;
            $row[] = $results->Jam_Capture_0;
            $row[] = $results->Jam_Capture_3;
            $row[] = $results->Jam_Capture_6;
            $row[] = $results->Jam_Capture_9;
            $row[] = $results->Jam_Capture_12;
            $row[] = $results->Jam_Capture_15;
            $row[] = $results->Jam_Capture_18;
            $row[] = $results->Jam_Capture_21;
            $row[] = $results->Average;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.reliability_harian_bg'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.reliability_harian_bg'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
