<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profrisktemkc extends MY_Controller
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
        $this->load->view('Audit/list_Profrisktemkc', $data);
        $this->footer();
    }

    public function listProfrisktemkc()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Audit_Internal.profile_risk_temuan_kc',
            ['no', 'AKTIVITAS', 'SUB_AKTIVITAS', 'JUDUL', 'KODE_RISIKO', 'ISU_RISIKO', 'TIPE_TEMUAN', 'KATEGORI_TEMUAN','ASPEK_PENYEBAB_Level_I','ASPEK_PENYEBAB_Level_2','BG_KC','Periode','user','tanggal_update'],
            ['AKTIVITAS', 'SUB_AKTIVITAS', 'JUDUL', 'KODE_RISIKO', 'ISU_RISIKO', 'TIPE_TEMUAN', 'KATEGORI_TEMUAN','ASPEK_PENYEBAB_Level_I','ASPEK_PENYEBAB_Level_2','BG_KC','Periode','user','tanggal_update'],
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
            $row[] = $results->AKTIVITAS;
            $row[] = $results->SUB_AKTIVITAS;
            $row[] = $results->JUDUL;
            $row[] = $results->KODE_RISIKO;
            $row[] = $results->ISU_RISIKO;
            $row[] = $results->TIPE_TEMUAN;
            $row[] = $results->KATEGORI_TEMUAN;
            $row[] = $results->ASPEK_PENYEBAB_Level_I;
            $row[] = $results->ASPEK_PENYEBAB_Level_2;
            $row[] = $results->BG_KC;
            $row[] = $results->Periode;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Audit_Internal.profile_risk_temuan_kc'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Audit_Internal.profile_risk_temuan_kc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
