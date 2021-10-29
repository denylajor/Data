<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ssbhybrid extends MY_Controller
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

        );

        // cekPergroup();
        $this->header('SSB & Hybrid');
        $this->load->view('CHM/list_ssbhybrid', $data);
        $this->footer();
    }

    public function listSsbhybrid()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_ssb_hybrid_new',
            ['no', 'tid', 'WSID', 'NO_TIKET', 'SN', 'LOKASI', 'IP_Host', 'Port', 'IP_Address', 'SN_CARD_e_ktp_READER', 'JENIS_E_KTP_READER', 'KANWIL', 'KC_Supervisi', 'TITIK_KOORDINAT', 'SERVICE_POINT', 'JARAK', 'KETERANGAN','BULANPM1','TANGGALPM1','TEKNISIPM1','BULANPM2','TANGGALPM2','TEKNISIPM2','BULANPM3','TANGGALPM3','TEKNISIPM3','STATUS_25_JUL_21_sd_24_AGS_21','TEKNISI_25_JUL_21_sd_24_AGS_21','TANGGAL_25_JUL_21_sd_24_AGS_21','KETERANGAN_25_JUL_21_sd_24_AGS_21','Status_25_AGS_21_sd_24_SEP_21','Teknisi_25_AGS_21_sd_24_SEP_21','Tanggal_25_AGS_21_sd_24_SEP_21','Keterangan_25_AGS_21_sd_24_SEP_21','Status_25_SEP_21_sd_24_OKT_21','Teknisi_25_SEP_21_sd_24_OKT_21','Tanggal_25_SEP_21_sd_24_OKT_21','Keterangan_25_SEP_21_sd_24_OKT_21', 'user', 'tanggal_update'],
            ['tid', 'WSID', 'NO_TIKET', 'SN', 'LOKASI', 'IP_Host', 'Port', 'IP_Address', 'SN_CARD_e_ktp_READER', 'JENIS_E_KTP_READER', 'KANWIL', 'KC_Supervisi', 'TITIK_KOORDINAT', 'SERVICE_POINT', 'JARAK', 'KETERANGAN','BULANPM1','TANGGALPM1','TEKNISIPM1','BULANPM2','TANGGALPM2','TEKNISIPM2','BULANPM3','TANGGALPM3','TEKNISIPM3','STATUS_25_JUL_21_sd_24_AGS_21','TEKNISI_25_JUL_21_sd_24_AGS_21','TANGGAL_25_JUL_21_sd_24_AGS_21','KETERANGAN_25_JUL_21_sd_24_AGS_21','Status_25_AGS_21_sd_24_SEP_21','Teknisi_25_AGS_21_sd_24_SEP_21','Tanggal_25_AGS_21_sd_24_SEP_21','Keterangan_25_AGS_21_sd_24_SEP_21','Status_25_SEP_21_sd_24_OKT_21','Teknisi_25_SEP_21_sd_24_OKT_21','Tanggal_25_SEP_21_sd_24_OKT_21','Keterangan_25_SEP_21_sd_24_OKT_21','user', 'tanggal_update'],
            ['No' => 'asc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->tid;
            $row[] = $results->WSID;
            $row[] = $results->NO_TIKET;
            $row[] = $results->SN;
            $row[] = $results->LOKASI;
            $row[] = $results->IP_Host;
            $row[] = $results->Port;
            $row[] = $results->IP_Address;
            $row[] = $results->SN_CARD_e_ktp_READER;
            $row[] = $results->JENIS_E_KTP_READER;
            $row[] = $results->KANWIL;
            $row[] = $results->KC_Supervisi;
            $row[] = $results->TITIK_KOORDINAT;
            $row[] = $results->SERVICE_POINT;
            $row[] = $results->JARAK;
            $row[] = $results->KETERANGAN;
            $row[] = $results->BULANPM1;
            $row[] = $results->TANGGALPM1;
            $row[] = $results->TEKNISIPM1;
            $row[] = $results->BULANPM2;
            $row[] = $results->TANGGALPM2;
            $row[] = $results->TEKNISIPM2;
            $row[] = $results->BULANPM3;
            $row[] = $results->TANGGALPM3;
            $row[] = $results->TEKNISIPM3;
            $row[] = $results->STATUS_25_JUL_21_sd_24_AGS_21;
            $row[] = $results->TEKNISI_25_JUL_21_sd_24_AGS_21;
            $row[] = $results->TANGGAL_25_JUL_21_sd_24_AGS_21;
            $row[] = $results->KETERANGAN_25_JUL_21_sd_24_AGS_21;
            $row[] = $results->Status_25_AGS_21_sd_24_SEP_21;
            $row[] = $results->Teknisi_25_AGS_21_sd_24_SEP_21;
            $row[] = $results->Tanggal_25_AGS_21_sd_24_SEP_21;
            $row[] = $results->Keterangan_25_AGS_21_sd_24_SEP_21;
            $row[] = $results->Status_25_SEP_21_sd_24_OKT_21;
            $row[] = $results->Teknisi_25_SEP_21_sd_24_OKT_21;
            $row[] = $results->Tanggal_25_SEP_21_sd_24_OKT_21;
            $row[] = $results->Keterangan_25_SEP_21_sd_24_OKT_21;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_ssb_hybrid_new'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_ssb_hybrid_new'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
