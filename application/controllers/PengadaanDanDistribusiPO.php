<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PengadaanDanDistribusiPO extends MY_Controller
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

            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        // cekPergroup();
        $this->header('Pengadaan & Distribusi PO');
        $this->load->view('CHM/list_pengadaanDanDistribusi', $data);
        $this->footer();
    }

    public function listPengadaanDanDistribusiPO()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_pengadaan_dan_distribusi_PO',
            ['no', 'Ijin_Prinsip_Direksi', 'NO_PO', 'TANGGAL_PO', 'VENDOR', 'NAMA_BARANG', 'JUMLAH_BARANG', 'HARGA', 'TOTAL_HARGA', 'PPN_atau_Non_PPN', 'Kebutuhan_Cabang_atau_Divisi', 'Keterangan', 'user', 'tanggal_update'],
            ['Ijin_Prinsip_Direksi', 'NO_PO', 'TANGGAL_PO', 'VENDOR', 'NAMA_BARANG', 'JUMLAH_BARANG', 'HARGA', 'TOTAL_HARGA', 'PPN_atau_Non_PPN', 'Kebutuhan_Cabang_atau_Divisi', 'Keterangan', 'user', 'tanggal_update'],
            ['tanggal_update' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Ijin_Prinsip_Direksi;
            $row[] = $results->NO_PO;
            $row[] = $results->TANGGAL_PO;
            $row[] = $results->VENDOR;
            $row[] = $results->NAMA_BARANG;
            $row[] = $results->JUMLAH_BARANG;
            $row[] = $results->HARGA;
            $row[] = $results->TOTAL_HARGA;
            $row[] = $results->PPN_atau_Non_PPN;
            $row[] = $results->Kebutuhan_Cabang_atau_Divisi;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pengadaan_dan_distribusi_PO'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pengadaan_dan_distribusi_PO'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
