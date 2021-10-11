<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Masterkas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Master Kas');
        $this->load->view('Layanan/list_masterkas', $data);
        $this->footer();
    }

    public function listMasterkas()
    {
        
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.tbl_masterkas',
            ['no', 'tanggal', 'codebranch', 'saldo_awal_bri', 'uang_layak', 'uang_meragukan', 'uang_tidak_layak', 'total_saldo_awal_penambahan', 'tambahan_kas', 'penukaran_uang_tidak_layak', 'kas_atm_return', 'sub_total'.'total_saldo_awal_pengurangan','shortage','atm_replenish','sub_total_pengurangan','saldo_akhir','cabang','user','tanggal_update'],
            ['tanggal', 'codebranch', 'saldo_awal_bri', 'uang_layak', 'uang_meragukan', 'uang_tidak_layak', 'total_saldo_awal_penambahan', 'tambahan_kas', 'penukaran_uang_tidak_layak', 'kas_atm_return', 'sub_total'.'total_saldo_awal_pengurangan','shortage','atm_replenish','sub_total_pengurangan','saldo_akhir','cabang','user','tanggal_update'],
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
            $row[] = $results->tanggal;
            $row[] = $results->codebranch;
            $row[] = rupiah($results->saldo_awal_bri);
            $row[] = rupiah($results->uang_layak);
            $row[] = rupiah($results->uang_meragukan);
            $row[] = rupiah($results->uang_tidak_layak);
            $row[] = rupiah($results->total_saldo_awal_penambahan);
            $row[] = rupiah($results->tambahan_kas);
            $row[] = $results->penukaran_uang_tidak_layak;
            $row[] = rupiah($results->kas_atm_return);
            $row[] = rupiah($results->sub_total);
            $row[] = rupiah($results->total_saldo_awal_pengurangan);
            $row[] = $results->shortage;
            $row[] = rupiah($results->atm_replenish);
            $row[] = rupiah($results->sub_total_pengurangan);
            $row[] = rupiah($results->saldo_akhir);
            $row[] = $results->cabang;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.tbl_masterkas'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.tbl_masterkas'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
