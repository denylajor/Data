<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reabilityperform extends MY_Controller
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

        cekPergroup();
        $this->header('Tabel Reability Perform');
        $this->load->view('CHM/list_reability', $data);
        $this->footer();
    }

    public function listReabilityperform()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_reability',
            ['no', 'TID', 'SN_Mesin', 'Tiket_MA', 'Tiket_ECH', 'Jenis', 'Vendor', 'Kanwil', 'Kanca', 'Lokasi', 'Tgl', 'Downtime', 'In_Out_SLA', 'Problem', 'Engineer', 'Status', 'Part', 'Action', 'Kondisi_Part', 'Keterangan', 'KOMITMEN_PENYELESAIAN', 'Tgl_Close', 'SLA', 'Penyelesaian', 'Tgl_req', 'Tgl_Kirim', 'Tgl_Terima','user','tanggal_update'],
            ['TID', 'SN_Mesin', 'Tiket_MA', 'Tiket_ECH', 'Jenis', 'Vendor', 'Kanwil', 'Kanca', 'Lokasi', 'Tgl', 'Downtime', 'In_Out_SLA', 'Problem', 'Engineer', 'Status', 'Part', 'Action', 'Kondisi_Part', 'Keterangan', 'KOMITMEN_PENYELESAIAN', 'Tgl_Close', 'SLA', 'Penyelesaian', 'Tgl_req', 'Tgl_Kirim', 'Tgl_Terima','user','tanggal_update'],
            ['NO' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->TID;
            $row[] = $results->SN_Mesin;
            $row[] = $results->Tiket_MA;
            $row[] = $results->Tiket_ECH;
            $row[] = $results->Jenis;
            $row[] = $results->Vendor;
            $row[] = $results->Kanwil;
            $row[] = $results->Kanca;
            $row[] = $results->Lokasi;
            $row[] = $results->Tgl;
            $row[] = $results->Downtime;
            $row[] = $results->In_Out_SLA;
            $row[] = $results->Problem;
            $row[] = $results->Engineer;
            $row[] = $results->Status;
            $row[] = $results->Part;
            $row[] = $results->Action;
            $row[] = $results->Kondisi_Part;
            $row[] = $results->Keterangan;
            $row[] = $results->KOMITMEN_PENYELESAIAN;
            $row[] = $results->Tgl_Close;
            $row[] = $results->SLA;
            $row[] = $results->Penyelesaian;
            $row[] = $results->Tgl_req;
            $row[] = $results->Tgl_Kirim;
            $row[] = $results->Tgl_Terima;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_reability'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_reability'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
