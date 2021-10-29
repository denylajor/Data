<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KendaraanLogistik extends MY_Controller
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
        $this->header('Kendaraan Logistik');
        $this->load->view('CHM/list_kendraanLogistik', $data);
        $this->footer();
    }

    public function listKendaraanLogistik()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_kendaraan_logistik',
            ['id', 'codeuker', 'cabang', 'tnbk_kend', 'tahun_kend', 'type_kend', 'rangka_kend', 'no_mesin_kend', 'status_kend', 'project', 'unit_layanan', 'gsm_gps', 'imei_gps', 'status_gps', 'vendor_kend', 'awal_berlaku_kend', 'akhir_berlaku_kend', 'masa_berlaku_stnk', 'masa_berlaku_tnbk', 'masa_berlaku_kir', 'safety_box', 'jenis_kend', 'keterangan', 'cek_data', 'user', 'tanggal_update'],
            ['id', 'codeuker', 'cabang', 'tnbk_kend', 'tahun_kend', 'type_kend', 'rangka_kend', 'no_mesin_kend', 'status_kend', 'project', 'unit_layanan', 'gsm_gps', 'imei_gps', 'status_gps', 'vendor_kend', 'awal_berlaku_kend', 'akhir_berlaku_kend', 'masa_berlaku_stnk', 'masa_berlaku_tnbk', 'masa_berlaku_kir', 'safety_box', 'jenis_kend', 'keterangan', 'cek_data', 'user', 'tanggal_update'],
            ['tanggal_update' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            // $row[] = $no;
            $row[] = $results->id;
            $row[] = $results->codeuker;
            $row[] = $results->cabang;
            $row[] = $results->tnbk_kend;
            $row[] = $results->tahun_kend;
            $row[] = $results->type_kend;
            $row[] = $results->rangka_kend;
            $row[] = $results->no_mesin_kend;

            $row[] = $results->status_kend;
            $row[] = $results->project;
            $row[] = $results->unit_layanan;
            $row[] = $results->gsm_gps;
            $row[] = $results->imei_gps;
            $row[] = $results->status_gps;


            $row[] = $results->vendor_kend;
            $row[] = $results->awal_berlaku_kend;
            $row[] = $results->akhir_berlaku_kend;
            $row[] = $results->masa_berlaku_stnk;
            $row[] = $results->masa_berlaku_tnbk;
            $row[] = $results->masa_berlaku_kir;

            $row[] = $results->safety_box;
            $row[] = $results->jenis_kend;
            $row[] = $results->keterangan;
            $row[] = $results->cek_data;

            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_kendaraan_logistik'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_kendaraan_logistik'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
