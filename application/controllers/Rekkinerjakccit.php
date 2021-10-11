<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekkinerjakccit extends MY_Controller
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
        $this->header('Rekap Kinerja KC CIT');
        $this->load->view('Layanan/list_rekkinerjakccit', $data);
        $this->footer();
    }

    public function listRekkinerjakccit()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_kinerja_kc_cit',
            ['no', 'Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'Jumlah_CIT', 'RKA_Pendapatan','RKA_Biaya','RKA_LabaRugi','Pencapaian_VS_RKA_Pendapatan','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_LabaRugi','Laba_Rugi_Per_Bulan_Per_CIT','Laba_Rugi_Per_Bulan_Kontribusi_Pekerja','Rasio_SDM','Total_Pencapaian_Pendapatan','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
            ['Laba_Rugi', 'Status_Pencapaian_VS_RKA_Pendapatan', 'Status_Pencapaian_VS_RKA_Biaya', 'Status_Pencapaian_VS_RKA_Laba_Rugi', 'Nama_Kanca', 'Nama_Pembina', 'Jumlah_CIT', 'RKA_Pendapatan','RKA_Biaya','RKA_LabaRugi','Pencapaian_VS_RKA_Pendapatan','Pencapaian_VS_RKA_Biaya','Pencapaian_VS_RKA_LabaRugi','Laba_Rugi_Per_Bulan_Per_CIT','Laba_Rugi_Per_Bulan_Kontribusi_Pekerja','Rasio_SDM','Total_Pencapaian_Pendapatan','Total_Pencapaian_Biaya','Total_Pencapaian_Laba_Rugi','Total_Pencapaian_BOPO','Prognosa_sd_Desember_Pendapatan','Prognosa_sd_Desember_Biaya','Prognosa_sd_Desember_Laba_Rugi', 'user', 'tanggal_update', ],
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
            $row[] = $results->Jumlah_CIT;
            $row[] = rupiah($results->RKA_Pendapatan);
            $row[] = rupiah($results->RKA_Biaya);
            $row[] = rupiah($results->RKA_LabaRugi);
            $row[] = $results->Pencapaian_VS_RKA_Pendapatan;
            $row[] = $results->Pencapaian_VS_RKA_Biaya;
            $row[] = $results->Pencapaian_VS_RKA_LabaRugi;
            $row[] = rupiah($results->Laba_Rugi_Per_Bulan_Per_CIT);
            $row[] = rupiah($results->Laba_Rugi_Per_Bulan_Kontribusi_Pekerja);
            $row[] = $results->Rasio_SDM;
            $row[] = rupiah($results->Total_Pencapaian_Pendapatan);
            $row[] = rupiah($results->Total_Pencapaian_Biaya);
            $row[] = rupiah($results->Total_Pencapaian_Laba_Rugi);
            $row[] = $results->Total_Pencapaian_BOPO;
            $row[] = rupiah($results->Prognosa_sd_Desember_Pendapatan);
            $row[] = rupiah($results->Prognosa_sd_Desember_Biaya);
            $row[] = rupiah($results->Prognosa_sd_Desember_Laba_Rugi);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_kinerja_kc_cit'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_kinerja_kc_cit'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
