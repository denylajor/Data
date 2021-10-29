<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datapembina extends MY_Controller
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
        $this->header('Data Pembina');
        $this->load->view('PSD/list_Datapembina', $data);
        $this->footer();
    }

    public function listDatapembina()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.data_pembina',
            ['no', 'Unit_Kerja', 'Total_Pekerja', 'Belum_Boleh_Vaksin', 'Sudah_Vaksin', 'Belum_Terdaftar_Vaksin', 'Terdaftar_Vaksin','Persentase_Belum_Boleh_Vaksin','Persentase_Sudah_Vaksin','Persentase_Belum_Terdaftar_Vaksin','Pembina','Keterangan','user','tanggal_update'],
            ['Unit_Kerja', 'Total_Pekerja', 'Belum_Boleh_Vaksin', 'Sudah_Vaksin', 'Belum_Terdaftar_Vaksin', 'Terdaftar_Vaksin','Persentase_Belum_Boleh_Vaksin','Persentase_Sudah_Vaksin','Persentase_Belum_Terdaftar_Vaksin','Pembina','Keterangan','user','tanggal_update'],
            ['No' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Unit_Kerja;
            $row[] = $results->Total_Pekerja;
            $row[] = $results->Belum_Boleh_Vaksin;
            $row[] = $results->Sudah_Vaksin;
            $row[] = $results->Belum_Terdaftar_Vaksin;
            $row[] = $results->Terdaftar_Vaksin;
            $row[] = $results->Persentase_Belum_Boleh_Vaksin;
            $row[] = $results->Persentase_Sudah_Vaksin;
            $row[] = $results->Persentase_Belum_Terdaftar_Vaksin;
            $row[] = $results->Pembina;
            $row[] = $results->Keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.data_pembina'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.data_pembina'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
