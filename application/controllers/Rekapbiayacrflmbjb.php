<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapbiayacrflmbjb extends MY_Controller
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
        $this->header('Rekap Biaya CR FLM Bank BJB');
        $this->load->view('Layanan/list_Rekapbiayacrflmbjb', $data);
        $this->footer();
    }

    public function listRekapbiayacrflmbjb()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_biaya_cr_flm_bank_bjb',
            ['no', 'ID', 'TANGGAL_PERDANA_PENGISIAN_ATM', 'HARI', 'CABANG', 'ATM', 'BG', 'BIAYA_CR_DAN_FLM', 'PPN', 'VERSI_BJB_CR', 'VERSI_BJB_FLM','VERSI_BJB_CR_DAN_FLM','VERSI_BJB_CR_DAN_FLM1','VERSI_BG_FLM','VERSI_BG_CR_DAN_FLM','BIAYA','KETERANGAN','TOTAL_BIAYA','TRUE_FALSE','user','tanggal_update' ],
           ['ID', 'TANGGAL_PERDANA_PENGISIAN_ATM', 'HARI', 'CABANG', 'ATM', 'BG', 'BIAYA_CR_DAN_FLM', 'PPN', 'VERSI_BJB_CR', 'VERSI_BJB_FLM','VERSI_BJB_CR_DAN_FLM','VERSI_BJB_CR_DAN_FLM1','VERSI_BG_FLM','VERSI_BG_CR_DAN_FLM','BIAYA','KETERANGAN','TOTAL_BIAYA','TRUE_FALSE','user','tanggal_update' ],
            ['NO' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->ID;
            $row[] = $results->TANGGAL_PERDANA_PENGISIAN_ATM;
            $row[] = $results->HARI;
            $row[] = $results->CABANG;
            $row[] = $results->ATM;
            $row[] = $results->BG;
            $row[] = rupiah($results->BIAYA_CR_DAN_FLM);
            $row[] = rupiah($results->PPN);
            $row[] = $results->VERSI_BJB_CR;
            $row[] = $results->VERSI_BJB_FLM;
            $row[] = $results->VERSI_BJB_CR_DAN_FLM;
            $row[] = $results->VERSI_BJB_CR_DAN_FLM1;
            $row[] = $results->VERSI_BG_FLM;
            $row[] = $results->VERSI_BG_CR_DAN_FLM;
            $row[] = rupiah($results->BIAYA);
            $row[] = $results->KETERANGAN;
            $row[] = rupiah($results->TOTAL_BIAYA);
            $row[] = $results->TRUE_FALSE;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_biaya_cr_flm_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_biaya_cr_flm_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
