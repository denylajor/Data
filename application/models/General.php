<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Model
{
    public function insertBatch($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function updateBatch($table, $data, $where)
    {
        return $this->db->update_batch($table, $data, $where);
    }

    public function count_all($tbl)
    {
        return $this->db->count_all($tbl);
    }

    public function getRow($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }

    public function getRows($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }

    //check child menu count
    public function checkchildMenuCount($pmenuid)
    {
        $whr = array(
            "parent_id" => $pmenuid
        );

        $this->db->where($whr);
        $this->db->from('tbl_user_menu');

        return $this->db->count_all_results();
    }

    // fetching records by single column
    public function fetch_bysinglecol($col, $tbl, $id)
    {
        $where = array(
            $col => $id
        );

        $this->db->select()->from($tbl)->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    //Custom Query function
    public function fetch_CoustomQuery($sql)
    {
        $query = $this->db->query($sql);

        return $query->result();
    }

    //Layanan
    public function fetch_CoustomQuerylayanan($sql)
    {
        $query = $this->db2->query($sql);

        return $query->result();
    }

    //BRI
    public function fetch_CoustomQueryBRI($sql)
    {
        $query = $this->db3->query($sql);

        return $query->result();
    }

    //find max id
    public function find_maxid($col, $tbl)
    {
        $query = $this->db->query("SELECT ifnull(max($col),'0') as $col FROM `$tbl`");

        return $query->row();
    }

    // add record
    function insertRecord($table, $array_data)
    {
        $query = $this->db->insert($table, $array_data);

        if ($query == 1)
            return $query;
        else
            return false;
    }

    //Fetch New Entry with Increment......
    public function fetch_maxid($tbl)
    {
        $this->db->select()->from($tbl);
        $query = $this->db->get();

        return $query->result();
    }

    // Fetch List for records...
    // public function fetch_records($tbl, $where = null, $like = null)
    // {
    //     $this->db->select()->from($tbl);
    //     is_null($where) ?: $this->db->where($where);
    //     is_null($like) ?: $this->db->like($like);
    //     $query = $this->db->get();

    //     return $query->result();
    // }

    public function fetch_records($tbl, $where = null, $like = null, $or_where = null)
    {
        $this->db->select()->from($tbl);
        is_null($where) ?: $this->db->where($where);
        is_null($like) ?: $this->db->like($like);
        is_null($or_where) ?: $this->db->or_where($or_where);
        $query = $this->db->get();

        return $query->result();
    }

    //fetch num rows of menus for a group
    public function fetch_per_groupmenu($id_sgroup, $id_menu)
    {
        $where = array(
            "id_sgroup" => $id_sgroup,
            "id_menu" => $id_menu
        );
        $query = $this->db->get_where('tbl_user_permission', $where);

        return $query->num_rows();
    }

    //fetch menus by a group
    public function fetch_groupid_menu($id_sgroup, $id_menu)
    {
        $where = array(
            "id_sgroup" => $id_sgroup,
            "id_menu" => $id_menu
        );
        $query = $this->db->get_where('tbl_user_permission', $where);

        return $query->result();
    }

    //updating permission records
    public function update_permissionrecord($data, $tbl, $where)
    {
        $this->db->where('id_per', $where);
        $this->db->update($tbl, $data);

        return true;
    }

    //get single record by id
    public function getbyId($select, $tbl, $where = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        is_null($where) ?: $this->db->where($where);
        $i = $this->db->get();

        return $i->row();
    }

    // dynamic query for updating
    function update_record($update, $where, $tbl)
    {
        $this->db->where($where);

        return $this->db->update($tbl, $update);
    }

    //delete records
    public function delete_record($tbl, $whr)
    {
        $this->db->where($whr);
        $this->db->delete($tbl);
    }

    //delete records
    public function deleteData($tbl, $whr)
    {
        return $this->db->delete($tbl, $whr);
    }

    //selecting and where clause dynamic query
    public function select_where($table, $where, $flag = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        if ($flag == 's')
            return $query->row();
        else
            return $query->result_array();
    }

    function check_url_permission($id_menu)
    {
        $id_sgroup = $this->session->userdata('id_sgroup');
        $query = $this->db->query("SELECT * FROM tbl_user_menu AS um, tbl_user_permission AS up WHERE um.id_menu = '$id_menu' AND um.`id_menu` = up.`id_menu` AND up.`per_select` = 1 AND up.id_sgroup = $id_sgroup")->result();

        if ($query) {
            return $query;
        } else {
            redirect(base_url());
        }
    }

    function check_url_permission_single()
    {
        $c = $this->router->fetch_class();
        $url = $c;
        $id_sgroup = $this->session->userdata('user_login')['id_sgroup'];
        $query = $this->db->query("SELECT * FROM tbl_user_menu AS um, tbl_user_permission AS up WHERE um.url_menu = '$url' AND um.`id_menu` = up.`id_menu` AND up.`per_select` = 1 AND up.id_sgroup = $id_sgroup")->num_rows();

        if ($query > 0) {
            return $query;
        } else {
            redirect(base_url());
        }
    }

    public function getJumlahData($tbl, $where)
    {
        $query = $this->db->get_where($tbl, $where);

        return $query->num_rows();
    }

    public function getJumlahDatas($tbl, $where)
    {
        $this->db->where('id_jtran ',  1);
        $query = $this->db->get_where($tbl, $where);


        return $query->num_rows();
    }

    public function generateSnM($kodeBrg,  $no_urut)
    {
        $kode_nama = $this->getRow('tbl_unit_kerja', ['id_uker' => $this->session->userdata('user_login')['id_uker']]);

        $this->db->select('id_tran, no_sn');
        $this->db->order_by('id_tran', 'DESC');
        // $this->db->like('no_sn', $kodeBrg . '-' . $kode_nama->kode_nama);
        $this->db->where('no_urut', $no_urut);
        $this->db->where('id_uker', $this->session->userdata('user_login')['id_uker']);
        $this->db->limit(1);
        $query = $this->db->get('tbl_transaksi');

        if ($query->num_rows() <> 0) {
            // $this->db->select('RIGHT(tbl_transaksi.no_sn,6) as noSn', FALSE);
            $this->db->select('(tbl_transaksi.id_tran) as noSn', FALSE);
            $this->db->order_by('id_tran', 'DESC');
            // $this->db->like('no_sn', $kodeBrg . '-' . $kode_nama->kode_nama);
            $this->db->where('no_urut', $no_urut);
            $this->db->where('id_uker', $this->session->userdata('user_login')['id_uker']);
            $this->db->limit(1);
            $lastNo = $this->db->get('tbl_transaksi');
            $data = $lastNo->row();
            $no = intval($data->noSn) + 1;
            $kodemax = str_pad($no, 6, "0", STR_PAD_LEFT);

            return $kodeBrg . "-" . $kode_nama->kode_nama . "-" . $kodemax;
        } else {
            return $kodeBrg . "-" . $kode_nama->kode_nama . "-" . str_pad(1, 6, "0", STR_PAD_LEFT);
        }
    }


    public function generateSn($kodeBrg)
    {
        $kode_nama = $this->getRow('tbl_unit_kerja', ['id_uker' => $this->session->userdata('user_login')['id_uker']]);

        $this->db->select('no_sn');
        $this->db->order_by('id_tran', 'DESC');
        $this->db->like('no_sn', $kodeBrg . '-' . $kode_nama->kode_nama);
        $this->db->limit(1);
        $query = $this->db->get('tbl_transaksi');

        if ($query->num_rows() <> 0) {
            $this->db->select('RIGHT(tbl_transaksi.no_sn,6) as noSn', FALSE);
            $this->db->order_by('id_tran', 'DESC');
            $this->db->like('no_sn', $kodeBrg . '-' . $kode_nama->kode_nama);
            $this->db->limit(1);
            $lastNo = $this->db->get('tbl_transaksi');
            $data = $lastNo->row();
            $no = intval($data->noSn) + 1;
            $kodemax = str_pad($no, 6, "0", STR_PAD_LEFT);

            return $kodeBrg . "-" . $kode_nama->kode_nama . "-" . $kodemax;
        } else {
            return $kodeBrg . "-" . $kode_nama->kode_nama . "-" . str_pad(1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function autoNoPerminBrg()
    {
        $this->db->select('LEFT(nomor_permintaan, 4) as noBar', FALSE);
        $this->db->order_by('id_permintaan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_permintaan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $tiket = intval($data->noBar) + 1;
        } else {
            $tiket = 1;
        }

        $kodemax = str_pad($tiket, 4, "0", STR_PAD_LEFT);
        $kodeJadi =  $kodemax . "/PRMB/" . date('m') . "/" . date('Y');
        // $kodeJadi = $kodemax . "/PRMT/" . date('Y');

        return $kodeJadi;
    }
}
