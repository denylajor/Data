<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perrplbankbjb extends MY_Controller
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
        $this->header('Peformance RPL Bank BJB Harian');
        $this->load->view('CHM/list_Perrplbankbjb', $data);
        $this->footer();
    }

    public function listPerrplbankbjb()
    {
    	
        $list = $this->General->fetch_CoustomQuery("SELECT KANTOR_CABANG,Total_Kelolaan_ATM,RPL_In_SLA,RPL_Out_SLA,Total_RPL,Performance,user,tanggal_update, ROUND(Performance*100 ,2) as perform from Div_CHM.tbl_perfomance_rpl_atm_bank_bjb");

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANTOR_CABANG;
            $row[] = $results->Total_Kelolaan_ATM;
            $row[] = $results->RPL_In_SLA;
            $row[] = $results->RPL_Out_SLA;
            $row[] = $results->Total_RPL;
            $row[] = $results->perform;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_perfomance_rpl_atm_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_perfomance_rpl_atm_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
