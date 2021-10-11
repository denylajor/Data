<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekpersedianlogkc extends MY_Controller
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
        $this->header('Rekap Persediaan Log KC');
        $this->load->view('Layanan/list_rekpersedianlogkc', $data);
        $this->footer();
    }

    public function listRekpersedianlogkc()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_persedian_log_kc',
            ['no', 'Nama_Barang', 'Spesifikasi_Terperinci', 'Jumlah', 'Satuan', 'Harga_per_pcs', 'Subtotal', 'Keperluan_KC_BG', 'Diterima','Bulan','Kanca','Barang', 'user', 'tanggal_update', ],
            ['Nama_Barang', 'Spesifikasi_Terperinci', 'Jumlah', 'Satuan', 'Harga_per_pcs', 'Subtotal', 'Keperluan_KC_BG', 'Diterima','Bulan','Kanca','Barang', 'user', 'tanggal_update', ],
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
            $row[] = $results->Nama_Barang;
            $row[] = $results->Spesifikasi_Terperinci;
            $row[] = $results->Jumlah;
            $row[] = $results->Satuan;
            $row[] = rupiah($results->Harga_per_pcs);
            $row[] = rupiah($results->Subtotal);
            $row[] = $results->Keperluan_KC_BG;
            $row[] = $results->Diterima;
            $row[] = $results->Bulan;
            $row[] = $results->Kanca;
            $row[] = $results->Barang;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_persedian_log_kc'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_persedian_log_kc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
