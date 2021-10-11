<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dictionaries extends MY_Controller
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

        cekPergroup();
        $this->header('Dictionaries');
        $this->load->view('CHM/list_dictionaries', $data);
        $this->footer();
    }

    public function listDictionaries()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_opnamepart',
            ['no', 'nama_barang', 'kode_barang', 'stok_awal', 'part_masuk', 'part_keluar', 'stok_akhir', 'total'],
            ['nama_barang', 'kode_barang', 'stok_awal', 'part_masuk', 'part_keluar', 'stok_akhir', 'total'],
            ['nama_barang' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->nama_barang;
            $row[] = $results->kode_barang;
            $row[] = $results->stok_awal;
            $row[] = $results->part_masuk;
            $row[] = $results->part_keluar;
            $row[] = $results->stok_akhir;
            $row[] = $results->total;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_opnamepart'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_opnamepart'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
