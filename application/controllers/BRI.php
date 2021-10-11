<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BRI extends MY_Controller
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
        $db2 = $this->load->database('db3', TRUE);
        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_bri'"),
        );

        cekPergroup();
        $this->header('BRI');
        $this->load->view('BRI/bri', $data);
        $this->footer();
    }



    public function import_excel()
    {
        // $chm = input('chm');

        // if (isset($_FILES["fileExcel"]["name"])) {
        //     $path = $_FILES["fileExcel"]["tmp_name"];
        //     $object = PHPExcel_IOFactory::load($path);
        //     foreach ($object->getWorksheetIterator() as $worksheet) {
        //         $highestRow = $worksheet->getHighestRow();
        //         $highestColumn = $worksheet->getHighestColumn();
        //         for ($row = 2; $row <= $highestRow; $row++) {
        //             $term_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        //             $lokasi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        //             $alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        //             $kantor_layanan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
        //             $uker_induk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        //             $cluster = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        //             $jam_operational = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
        //             $garansi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
        //             $cctv_ada = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
        //             $cctv_tidak_ada = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
        //             $ups_ada = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
        //             $ups_tidak_ada = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
        //             $latitude = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
        //             $longitude = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
        //             $pagu = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
        //             $denom = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
        //             $keterangan = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

        //             $temp_data[] = array(
        //                 'term_id'    => $term_id,
        //                 'lokasi'    => $lokasi,
        //                 'alamat'    => $alamat,
        //                 'kantor_layanan'    => $kantor_layanan,
        //                 'uker_induk'    => $uker_induk,
        //                 'cluster'    => $cluster,
        //                 'jam_operational'    => $jam_operational,
        //                 'garansi'    => $garansi,
        //                 'cctv_ada'    => $cctv_ada,
        //                 'cctv_tidak_ada'    => $cctv_tidak_ada,
        //                 'ups_ada'    => $ups_ada,
        //                 'ups_tidak_ada'    => $ups_tidak_ada,
        //                 'latitude'    => $latitude,
        //                 'longitude'    => $longitude,
        //                 'pagu'    => $pagu,
        //                 'denom'    => $denom,
        //                 'keterangan'    => $keterangan,
        //                 'user' => $this->session->userdata("user_login")['username']

        //             );
        //         }
        //         // cetak_die($temp_data['user']);
        //     }
        //     $this->load->model('ImportModel');
        //     $insert = $this->ImportModel->insert($temp_data, $chm);
        //     if ($insert) {
        //         if ($chm) {
        //             $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
        //             redirect('CHM');
        //             // $data = array(
        //             //     // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT * FROM $chm"),
        //             //     'bre' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),

        //             // );
        //             // $this->header('Tabel Data Aset');
        //             // $this->load->view('Barang/list_barang');
        //             // $this->footer();
        //         }
        //     } else {
        //         $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
        //         redirect('Barang');
        //     }
        // } else {
        //     echo "Tidak ada file yang masuk";
        // }
    }
}
