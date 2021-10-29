<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profriskmatres extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->audit = $this->load->database('db5', TRUE);
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
        $this->header('Profile Risk Matrisk Resiko');
        $this->load->view('Audit/list_profriskmatres', $data);
        $this->footer();
    }

    public function listProfriskmatres()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Audit_Internal.profile_risk_matrisk_resiko',
            ['no', 'TAHUN_AUDIT', 'KC', 'NO_TEMUAN', 'AKTIVITAS', 'AKTIVITAS1', 'SUB_AKTIVITAS', 'JUDUL','KODE_RISIKO','ISSUE_RISIKO','TIPE_TEMUAN','KATEGORI_TEMUAN','PENYEBAB_Level_1','PENYEBAB_Level_2','Tingkat_Penyelesaian','TOTAL_LOSS','user','tanggal_update'],
            ['TAHUN_AUDIT', 'KC', 'NO_TEMUAN', 'AKTIVITAS', 'AKTIVITAS1', 'SUB_AKTIVITAS', 'JUDUL','KODE_RISIKO','ISSUE_RISIKO','TIPE_TEMUAN','KATEGORI_TEMUAN','PENYEBAB_Level_1','PENYEBAB_Level_2','Tingkat_Penyelesaian','TOTAL_LOSS','user','tanggal_update'],
            ['No' => 'DESC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->TAHUN_AUDIT;
            $row[] = $results->KC;
            $row[] = $results->NO_TEMUAN;
            $row[] = $results->AKTIVITAS;
            $row[] = $results->AKTIVITAS1;
            $row[] = $results->SUB_AKTIVITAS;
            $row[] = $results->JUDUL;
            $row[] = $results->KODE_RISIKO;
            $row[] = $results->ISSUE_RISIKO;
            $row[] = $results->TIPE_TEMUAN;
            $row[] = $results->KATEGORI_TEMUAN;
            $row[] = $results->PENYEBAB_Level_1;
            $row[] = $results->PENYEBAB_Level_2;
            $row[] = $results->Tingkat_Penyelesaian;
            $row[] = $results->TOTAL_LOSS;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Audit_Internal.profile_risk_matrisk_resiko'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Audit_Internal.profile_risk_matrisk_resiko'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
