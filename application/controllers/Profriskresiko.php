<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profriskresiko extends MY_Controller
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
        $this->load->view('Audit/list_profriskresiko', $data);
        $this->footer();
    }

    public function listProfriskresiko()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Audit_Internal.profile_risk_resiko',
            ['no', 'Aktivitas', 'No_SOP', 'Sub_Aktivitas', 'Kode_Resiko', 'Issue_Resiko', 'Tipe_Resiko', 'Jumlah','user','tanggal_update'],
            ['Aktivitas', 'No_SOP', 'Sub_Aktivitas', 'Kode_Resiko', 'Issue_Resiko', 'Tipe_Resiko', 'Jumlah','user','tanggal_update'],
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
            $row[] = $results->Aktivitas;
            $row[] = $results->No_SOP;
            $row[] = $results->Sub_Aktivitas;
            $row[] = $results->Kode_Resiko;
            $row[] = $results->Issue_Resiko;
            $row[] = $results->Tipe_Resiko;
            $row[] = $results->Jumlah;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Audit_Internal.profile_risk_resiko'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Audit_Internal.profile_risk_resiko'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
