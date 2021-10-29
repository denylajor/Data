<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UpdateKategoriKasusClosedCaseNominal extends MY_Controller
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
        $this->header('Update Kategori Kasus Closed Case Nominal');
        $this->load->view('Layanan/list_updateKategoriKasusClosedCaseNominal', $data);
        $this->footer();
    }

    public function listUpdateKategoriKasusClosedCaseNominal()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.Update_Kategori_kasus_Closed_Case_Nominal',
            ['no', 'Nominal_Periode', 'Kategori_Anomali_Cardless', 'Balancing_Tidak_Tertib_RPL', 'Cocok_Surplus_berdasarkan_Rekon_EJ_Trx', 'CPC_Tidak_Tertib', 'Indikasi_Fraud', 'Kesalahan_Rekon_Membaca_Billcounter', 'Vandalisme', 'Open', 'Grand_Total', 'user', 'tanggal_update'],
            ['Nominal_Periode', 'Kategori_Anomali_Cardless', 'Balancing_Tidak_Tertib_RPL', 'Cocok_Surplus_berdasarkan_Rekon_EJ_Trx', 'CPC_Tidak_Tertib', 'Indikasi_Fraud', 'Kesalahan_Rekon_Membaca_Billcounter', 'Vandalisme', 'Open', 'Grand_Total', 'user', 'tanggal_update'],
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
            $row[] = $results->Nominal_Periode;
            $row[] = rupiah($results->Kategori_Anomali_Cardless);
            $row[] = rupiah($results->Balancing_Tidak_Tertib_RPL);
            $row[] = rupiah($results->Cocok_Surplus_berdasarkan_Rekon_EJ_Trx);
            $row[] = rupiah($results->CPC_Tidak_Tertib);
            $row[] = rupiah($results->Indikasi_Fraud);
            $row[] = rupiah($results->Kesalahan_Rekon_Membaca_Billcounter);
            $row[] = rupiah($results->Vandalisme);
            $row[] = rupiah($results->Open);
            $row[] = rupiah($results->Grand_Total);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.Update_Kategori_kasus_Closed_Case_Nominal'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.Update_Kategori_kasus_Closed_Case_Nominal'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
