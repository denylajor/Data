<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataVaksin extends MY_Controller
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

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        // cekPergroup();
        $this->header('Data Vaksin');
        $this->load->view('Layanan/list_vaksin', $data);
        $this->footer();
    }

    public function listDataVaksin()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.tb_vaksin',
            ['no', 'pn', 'nama', 'jabatan', 'divisi', 'bagian', 'vaksin_1', 'vaksin_2', 'lokasi', 'keterangan', 'status', 'cek_vaksin_1', 'cek_vaksin_2', 'cek_tidak_layak', 'cek_terjadwal', 'user', 'tanggal_update'],
            ['pn', 'nama', 'jabatan', 'divisi', 'bagian', 'vaksin_1', 'vaksin_2', 'lokasi', 'keterangan', 'status', 'cek_vaksin_1', 'cek_vaksin_2', 'cek_tidak_layak', 'cek_terjadwal', 'user', 'tanggal_update'],
            ['tanggal_update' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->pn;
            $row[] = $results->nama;
            $row[] = $results->jabatan;
            $row[] = $results->divisi;
            $row[] = $results->bagian;
            $row[] = $results->vaksin_1;
            $row[] = $results->vaksin_2;
            $row[] = $results->lokasi;
            $row[] = $results->keterangan;
            $row[] = $results->status;
            $row[] = $results->cek_vaksin_1;
            $row[] = $results->cek_vaksin_2;
            $row[] = $results->cek_tidak_layak;
            $row[] = $results->cek_terjadwal;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.tb_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.tb_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
