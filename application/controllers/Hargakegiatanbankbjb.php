<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hargakegiatanbankbjb extends MY_Controller
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
        $this->header('Harga Kegiatan Bank BJB');
        $this->load->view('Layanan/list_hargakegiatanbankbjb', $data);
        $this->footer();
    }

    public function listHargakegiatanbankbjb()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.harga_kegiatan_bank_bjb',
            ['no', 'wilayah', 'kantor_cabang', 'total_atm', 'kegiatan_cr', 'kegiatan_flm', 'total_biaya', 'user', 'tanggal_update', ],
            ['wilayah', 'kantor_cabang', 'total_atm', 'kegiatan_cr', 'kegiatan_flm', 'total_biaya', 'user', 'tanggal_update', ],
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
            $row[] = $results->wilayah;
            $row[] = $results->kantor_cabang;
            $row[] = $results->total_atm;
            $row[] = $results->kegiatan_cr;
            $row[] = $results->kegiatan_flm;
            $row[] = rupiah($results->total_biaya);
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.harga_kegiatan_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.harga_kegiatan_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
