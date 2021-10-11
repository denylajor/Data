<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapshortage extends MY_Controller
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
        $this->header('Rekap Shortage');
        $this->load->view('Layanan/list_rekapshortage', $data);
        $this->footer();
    }

    public function listRekapshortage()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.tbl_rekap_shortage',
            ['no', 'Tgl_Selisih', 'Kantor_Cabang', 'TID', 'BC', 'Lokasi', 'Mesin', 'Denom', 'Supervisi', 'Shortage', 'Tgl_Instruksi', 'Surat_Investigasi', 'PIC_Investigasi', 'Keterangan_H3', 'Reminder_H3', 'Tindak_lanjut', 'Kesimpulan', 'New', 'Open', 'Close', 'Case_ID','user','tanggal_update'],
            ['Tgl_Selisih', 'Kantor_Cabang', 'TID', 'BC', 'Lokasi', 'Mesin', 'Denom', 'Supervisi', 'Shortage', 'Tgl_Instruksi', 'Surat_Investigasi', 'PIC_Investigasi', 'Keterangan_H3', 'Reminder_H3', 'Tindak_lanjut', 'Kesimpulan', 'New', 'Open', 'Close', 'Case_ID','user','tanggal_update'],
            ['No' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            // $row[] = $results->Periode;
            $row[] = $results->Tgl_Selisih;
            $row[] = $results->Kantor_Cabang;
            $row[] = $results->TID;
            $row[] = $results->BC;
            $row[] = $results->Lokasi;
            $row[] = $results->Mesin;
            $row[] = $results->Denom;
            $row[] = $results->Supervisi;
            $row[] = $results->Shortage;
            $row[] = $results->Tgl_Instruksi;
            $row[] = $results->Surat_Investigasi;
            $row[] = $results->PIC_Investigasi;
            $row[] = $results->Keterangan_H3;
            $row[] = $results->Reminder_H3;
            $row[] = $results->Tindak_lanjut;
            $row[] = $results->Kesimpulan;
            $row[] = $results->New;
            $row[] = $results->Open;
            $row[] = $results->Close;
            $row[] = $results->Case_ID;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.tbl_rekap_shortage'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.tbl_rekap_shortage'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
