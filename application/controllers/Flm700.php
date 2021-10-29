<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Flm700 extends MY_Controller
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
        $this->header('FLM 700');
        $this->load->view('CHM/list_Flm700', $data);
        $this->footer();
    }

    public function listFlm700()
    {
    	$list = $this->General->fetch_CoustomQuery("SELECT KANCA,tgl_1,tgl_2,tgl_3,tgl_4,tgl_5,tgl_6,tgl_7,tgl_8,tgl_9,tgl_10,tgl_11,tgl_12,tgl_13,tgl_14,tgl_15,tgl_16,tgl_17,tgl_18,tgl_19,tgl_20,tgl_21,tgl_22,tgl_23,tgl_24,tgl_25,tgl_26,tgl_27,tgl_28,tgl_29,tgl_30,tgl_31,AVG_FLM,user,tanggal_update, ROUND(tgl_1*100 ,2) as tgl1, ROUND(tgl_2*100 ,2) as tgl2, ROUND(tgl_3*100 ,2) as tgl3, ROUND(tgl_4*100 ,2) as tgl4, ROUND(tgl_5*100 ,2) as tgl5,  ROUND(tgl_6*100 ,2) as tgl6,  ROUND(tgl_7*100 ,2) as tgl7, ROUND(tgl_8*100 ,2) as tgl8, ROUND(tgl_9*100 ,2) as tgl9, ROUND(tgl_10*100 ,2) as tgl10, ROUND(tgl_11*100 ,2) as tgl11, ROUND(tgl_12*100 ,2) as tgl12, ROUND(tgl_13*100 ,2) as tgl13, ROUND(tgl_14*100 ,2) as tgl14, ROUND(tgl_15*100 ,2) as tgl15, ROUND(tgl_16*100 ,2) as tgl16, ROUND(tgl_17*100 ,2) as tgl17, ROUND(tgl_18*100 ,2) as tgl18, ROUND(tgl_19*100 ,2) as tgl19, ROUND(tgl_20*100 ,2) as tgl20, ROUND(tgl_21*100 ,2) as tgl21, ROUND(tgl_22*100 ,2) as tgl22, ROUND(tgl_23*100 ,2) as tgl23, ROUND(tgl_24*100 ,2) as tgl24, ROUND(tgl_25*100 ,2) as tgl25, ROUND(tgl_26*100 ,2) as tgl26, ROUND(tgl_27*100 ,2) as tgl27, ROUND(tgl_28*100 ,2) as tgl28, ROUND(tgl_29*100 ,2) as tgl29, ROUND(tgl_30*100 ,2) as tgl30, ROUND(tgl_31*100 ,2) as tgl31, ROUND(AVG_FLM*100 ,2) as average from Div_CHM.tbl_bulanan_flm_700_crm");
        // $list = $this->Serverside->_serverSide(
        //     'tbl_pengiriman_logistik',
        //     ['no', 'Tanggal', 'Tujuan', 'Qty', 'Sparepart','Status','user','tanggal_update'],
        //     ['Tanggal', 'Tujuan', 'Qty', 'Sparepart','Status','user','tanggal_update'],
        //     ['No' => 'ASC'],
        //     null,
        //     'data'
        // );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANCA;
            $row[] = $results->tgl1;
            $row[] = $results->tgl2;
            $row[] = $results->tgl3;
            $row[] = $results->tgl4;
            $row[] = $results->tgl5;
            $row[] = $results->tgl6;
            $row[] = $results->tgl7;
            $row[] = $results->tgl8;
            $row[] = $results->tgl9;
            $row[] = $results->tgl10;
            $row[] = $results->tgl11;
            $row[] = $results->tgl12;
            $row[] = $results->tgl13;
            $row[] = $results->tgl14;
            $row[] = $results->tgl15;
            $row[] = $results->tgl16;
            $row[] = $results->tgl17;
            $row[] = $results->tgl18;
            $row[] = $results->tgl19;
            $row[] = $results->tgl20;
            $row[] = $results->tgl21;
            $row[] = $results->tgl22;
            $row[] = $results->tgl23;
            $row[] = $results->tgl24;
            $row[] = $results->tgl25;
            $row[] = $results->tgl26;
            $row[] = $results->tgl27;
            $row[] = $results->tgl28;
            $row[] = $results->tgl29;
            $row[] = $results->tgl30;
            $row[] = $results->tgl31;
            $row[] = $results->average;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_bulanan_flm_700_crm'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_bulanan_flm_700_crm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
