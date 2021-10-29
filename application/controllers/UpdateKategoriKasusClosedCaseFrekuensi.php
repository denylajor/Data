<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UpdateKategoriKasusClosedCaseFrekuensi extends MY_Controller
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
        $this->header('Update Kategori Kasus Closed Case Frekuensi');
        $this->load->view('Layanan/list_updateKategoriKasusClosedCaseFrekuensi', $data);
        $this->footer();
    }

    public function listUpdateKategoriKasusClosedCaseFrekuensi()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.Update_Kategori_kasus_Closed_Case_Frekuensi',
            ['no', 'Frekuensi_Periode', 'Kategori_Anomali_Cardless', 'Balancing_Tidak_Tertib_RPL', 'Cocok_Surplus_berdasarkan_Rekon_EJ_Trx', 'CPC_Tidak_Tertib', 'Indikasi_Fraud', 'Kesalahan_Rekon_Membaca_Billcounter', 'Vandalisme', 'Open', 'Grand_Total', 'user', 'tanggal_update'],
            ['Frekuensi_Periode', 'Kategori_Anomali_Cardless', 'Balancing_Tidak_Tertib_RPL', 'Cocok_Surplus_berdasarkan_Rekon_EJ_Trx', 'CPC_Tidak_Tertib', 'Indikasi_Fraud', 'Kesalahan_Rekon_Membaca_Billcounter', 'Vandalisme', 'Open', 'Grand_Total', 'user', 'tanggal_update'],
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
            $row[] = $results->Frekuensi_Periode;
            $row[] = $results->Kategori_Anomali_Cardless;
            $row[] = $results->Balancing_Tidak_Tertib_RPL;
            $row[] = $results->Cocok_Surplus_berdasarkan_Rekon_EJ_Trx;
            $row[] = $results->CPC_Tidak_Tertib;
            $row[] = $results->Indikasi_Fraud;
            $row[] = $results->Kesalahan_Rekon_Membaca_Billcounter;
            $row[] = $results->Vandalisme;
            $row[] = $results->Open;
            $row[] = $results->Grand_Total;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.Update_Kategori_kasus_Closed_Case_Frekuensi'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.Update_Kategori_kasus_Closed_Case_Frekuensi'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
