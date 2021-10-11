<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekkinerjakccro extends MY_Controller
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
        $this->header('Rekap Kinerja KC CRO');
        $this->load->view('Layanan/list_rekkinerjakccro', $data);
        $this->footer();
    }

    public function listRekkinerjakccro()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_kinerja_kc_cro',
            ['no', 'Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'Jumlah_ATM', 'RKA_Pendapatan_Invoice','RKA_Biaya','RKA_Laba_Rugi','Pencapaian_VS_RKA_Pendapatan_Invoice','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_Laba_Rugi','Laba_Rugi_Per_Bulan_Per_ATM','Laba_Rugi_Per_Bulan_Kontribusi_Pekerja','Rasio_SDM','Total_Pencapaian_Pendapatan_Invoice','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan_Invoice','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
            ['Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'Jumlah_ATM', 'RKA_Pendapatan_Invoice','RKA_Biaya','RKA_Laba_Rugi','Pencapaian_VS_RKA_Pendapatan_Invoice','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_Laba_Rugi','Laba_Rugi_Per_Bulan_Per_ATM','Laba_Rugi_Per_Bulan_Kontribusi_Pekerja','Rasio_SDM','Total_Pencapaian_Pendapatan_Invoice','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan_Invoice','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
            ['tanggal_update' => 'ASC '],
            null,
            'data'
        );
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
            $row[] = $results->Jumlah_ATM;
            $row[] = rupiah($results->RKA_Pendapatan_Invoice);
            $row[] = rupiah($results->RKA_Biaya);
            $row[] = rupiah($results->RKA_Laba_Rugi);
            $row[] = $results->Pencapaian_VS_RKA_Pendapatan_Invoice;
            $row[] = $results->Pencapaian_VS_RKA_Biaya;
            $row[] = $results->Pencapaian_VS_RKA_Laba_Rugi;
            $row[] = $results->Laba_Rugi_Per_Bulan_Per_ATM;
            $row[] = $results->Laba_Rugi_Per_Bulan_Kontribusi_Pekerja;
            $row[] = $results->Rasio_SDM;
            $row[] = $results->Total_Pencapaian_Pendapatan_Invoice;
            $row[] = $results->Total_Pencapaian_Biaya;
            $row[] = $results->Total_Pencapaian_Laba_Rugi;
            $row[] = $results->Total_Pencapaian_BOPO;
            $row[] = $results->Prognosa_sd_Desember_Pendapatan_Invoice;
            $row[] = $results->Prognosa_sd_Desember_Biaya;
            $row[] = $results->Prognosa_sd_Desember_Laba_Rugi;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_kinerja_kc_cro'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_kinerja_kc_cro'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
