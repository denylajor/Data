<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Opname extends MY_Controller
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
        $this->header('Tabel Opname');
        $this->load->view('CHM/list_opname', $data);
        $this->footer();
    }

    public function listOpname()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_opname',
            ['no', 'jenis_barang', 'day_warehouse', 'harga_beli', 'jumlah_item', 'total_harga', 'doi', 'usulan_jumlah_dijual', 'total_harga_usulan','user','tanggal_update'],
            ['jenis_barang', 'day_warehouse', 'harga_beli', 'jumlah_item', 'total_harga', 'doi', 'usulan_jumlah_dijual', 'total_harga_usulan','user','tanggal_update'],
            ['tanggal_update' => 'asc'],
            null,
            'data'
        );

           


        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {
            //harga beli
            if($results->harga_beli == 0){
                $hargabeli = "-";
            }else{
                $hargabeli = rupiah($results->harga_beli);
            }
            //total harga
            if($results->total_harga == 0){
                $total = "-";
            }else{
                $total = rupiah($results->total_harga);
            }
            //total harga usulan
            if($results->total_harga_usulan == 0){
                $totalusulan = "-";
            }else{
                $totalusulan = rupiah($results->total_harga_usulan);
            }

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->jenis_barang;
            $row[] = $results->day_warehouse;
            $row[] = $hargabeli;
            $row[] = $results->jumlah_item;
            $row[] = $total;
            $row[] = $results->doi;
            $row[] = $results->usulan_jumlah_dijual;
            $row[] = $totalusulan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_opname'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_opname'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
