<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapflmbankbjb extends MY_Controller
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
        $this->header('Rekap FLM Bank BJB');
        $this->load->view('Layanan/list_rekapflmbankbjb', $data);
        $this->footer();
    }

    public function listRekapflmbankbjb()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_flm_bank_bjb',
            ['no', 'Tanggal', 'Kantor_Cabang', 'ID_ATM', 'Nama_ATM', 'Problem', 'No_Tiket_Catatan_BG', 'user', 'tanggal_update'],
            ['Tanggal', 'Kantor_Cabang', 'ID_ATM', 'Nama_ATM', 'Problem', 'No_Tiket_Catatan_BG', 'user', 'tanggal_update'],
            ['No' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Tanggal;
            $row[] = $results->Kantor_Cabang;
            $row[] = $results->ID_ATM;
            $row[] = $results->Nama_ATM;
            $row[] = $results->Problem;
            $row[] = $results->No_Tiket_Catatan_BG;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_flm_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_flm_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
