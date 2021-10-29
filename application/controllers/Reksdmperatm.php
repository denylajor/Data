<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reksdmperatm extends MY_Controller
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
        $this->header('Rekap Pertumbuhan ATM');
        $this->load->view('PSD/list_reksdmperatm', $data);
        $this->footer();
    }

    public function listReksdmperatm()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.rekap_SDM_pertumbuhan_atm',
            ['no', 'Kantor_Layanan', 'ATM_BRI', 'ATM_Bukopin','ATM_Artagraha','ATM_BJB','Jumlah_ATM','Target','Kolaborasi','Jalin','Periode','user','tanggal_update'],
            ['Kantor_Layanan', 'ATM_BRI', 'ATM_Bukopin','ATM_Artagraha','ATM_BJB','Jumlah_ATM','Target','Kolaborasi','Jalin','Periode','user','tanggal_update'],
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
            $row[] = $results->Kantor_Layanan;
            $row[] = $results->ATM_BRI;
            $row[] = $results->ATM_Bukopin;
            $row[] = $results->ATM_Artagraha;
            $row[] = $results->ATM_BJB;
            $row[] = $results->Jumlah_ATM;
            $row[] = $results->Target;
            $row[] = $results->Kolaborasi;
            $row[] = $results->Jalin;
            $row[] = $results->Periode;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.rekap_SDM_pertumbuhan_atm'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.rekap_SDM_pertumbuhan_atm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
