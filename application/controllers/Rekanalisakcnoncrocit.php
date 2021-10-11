<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekanalisakcnoncrocit extends MY_Controller
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
            $BOPO = $this->General->fetch_CoustomQuery("SELECT ROUND(Total_Pencapaian_BOPO*100 ,2) as data2  from Div_Layanan.rekap_analisa_kc_non_cro_cit"),
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );
          // cetak_die($BOPO);
        // cekPergroup();
        $this->header('Rekap Analisa KC Non CRO CIT');
        $this->load->view('Layanan/list_Rekanalisakcnoncrocit', $data);
        $this->footer();
    }

    public function listRekanalisakcnoncrocit()
    {
        
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_analisa_kc_non_cro_cit',
            ['no', 'Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'RKA_Pendapatan', 'RKA_Biaya','RKA_Laba_Rugi','Pencapaian_VS_RKA_Pendapatan','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_Laba_Rugi','Total_Pencapaian_Pendapatan','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
            ['Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'RKA_Pendapatan', 'RKA_Biaya','RKA_Laba_Rugi','Pencapaian_VS_RKA_Pendapatan','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_Laba_Rugi','Total_Pencapaian_Pendapatan','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
            ['tanggal_update' => 'ASC '],
            null,
            'data'
        );

        // $BOPO = $this->General->fetch_CoustomQuery("SELECT ROUND(Total_Pencapaian_BOPO*100 ,2) as data2  from Div_Layanan.rekap_analisa_kc_non_cro_cit");

        $data = array();
        $no = $_POST['start'];
        

        foreach ($list as $results) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Laba_Rugi;
            $row[] = $results->Status_Pencapaian_VS_RKA_Pendapatan;
            $row[] = $results->Status_Pencapaian_VS_RKA_Biaya;
            $row[] = $results->Status_Pencapaian_VS_RKA_Laba_Rugi;
            $row[] = $results->Nama_Kanca;
            $row[] = $results->Nama_Pembina;
            $row[] = rupiah($results->RKA_Pendapatan);
            $row[] = rupiah($results->RKA_Biaya);
            $row[] = rupiah($results->RKA_Laba_Rugi);
            $row[] = $results->Pencapaian_VS_RKA_Pendapatan;
            $row[] = $results->Pencapaian_VS_RKA_Biaya;
            $row[] = $results->Pencapaian_VS_RKA_Laba_Rugi;
            $row[] = rupiah($results->Total_Pencapaian_Pendapatan);
            $row[] = rupiah($results->Total_Pencapaian_Biaya);
            $row[] = rupiah($results->Total_Pencapaian_Laba_Rugi);
            $row[] = $results->Total_Pencapaian_BOPO;
            // $row[] = $BOPO;
            $row[] = rupiah($results->Prognosa_sd_Desember_Pendapatan);
            $row[] = rupiah($results->Prognosa_sd_Desember_Biaya);
            $row[] = rupiah($results->Prognosa_sd_Desember_Laba_Rugi);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_analisa_kc_non_cro_cit'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_analisa_kc_non_cro_cit'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
