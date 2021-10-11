<?php
$tglNow = date('Y-m-d');
$monthNow = date('m');
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>Persediaan ATM</h3>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>

                    </tr>
                    <?php
                    $atm = $this->General->fetch_records('tbl_merek', ['id_sgbarang' => 1]);
                    foreach ($atm as $at) {
                        if ($this->session->userdata('user_login')['id_uker'] == 1) {
                            $totalMerek = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $at->id_merek AND id_vendor != 1 AND is_have = 1 AND is_out != 1");
                        } else {
                            $totalMerek = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $at->id_merek AND is_have = 1 AND status_pakai != 1 AND is_out != 1");
                            // lastq();
                        }
                    ?>
                        <tr>
                            <td><?= $at->nama_merek ?></td>
                            <td><?= $totalMerek[0]->Jumlah ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Persediaan CRM</h3>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php
                    $crm = $this->General->fetch_records('tbl_merek', ['id_sgbarang' => 2]);
                    foreach ($crm as $cr) {
                        if ($this->session->userdata('user_login')['id_uker'] == 1) {
                            $totalCrm = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $cr->id_merek AND id_vendor != 1 AND is_have = 1 AND is_out != 1");
                        } else {
                            $totalCrm = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $cr->id_merek AND is_have = 1 AND status_pakai != 1 AND is_out != 1");
                        }
                    ?>
                        <tr>
                            <td><?= $cr->nama_merek ?></td>
                            <td><?= $totalCrm[0]->Jumlah ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>Persediaan SSB</h3>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php
                    $ssb = $this->General->fetch_records('tbl_merek', ['id_sgbarang' => 6]);
                    foreach ($ssb as $sb) {
                        if ($this->session->userdata('user_login')['id_uker'] == 1) {
                            $totalSsb = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $sb->id_merek AND id_vendor != 1 AND is_have = 1 AND is_out != 1");
                        } else {
                            $totalSsb = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $sb->id_merek AND is_have = 1 AND status_pakai != 1 AND is_out != 1");
                        }
                    ?>
                        <tr>
                            <td><?= $sb->nama_merek ?></td>
                            <td><?= $totalSsb[0]->Jumlah ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>Persediaan Hybrid</h3>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php
                    $hybird = $this->General->fetch_records('tbl_merek', ['id_sgbarang' => 7]);
                    foreach ($hybird as $hyb) {
                        if ($this->session->userdata('user_login')['id_uker'] == 1) {
                            $totalHybird = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $hyb->id_merek AND is_have = 1 AND is_out != 1");
                            // lastq();
                        } else {
                            $totalHybird = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_merek = $hyb->id_merek AND is_have = 1 AND status_pakai != 1 AND is_out != 1");
                        }
                    ?>
                        <tr>
                            <td><?= $hyb->nama_merek ?></td>
                            <td><?= $totalHybird[0]->Jumlah ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Masuk Hari Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_vendor = 1 AND id_sgbarang = $sg->id_sgbarang AND is_have = 1 AND status_pakai != 1 AND DATE(tgl_terima_barang) = '$tglNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_vendor = 1 AND id_sgbarang = $sg->id_sgbarang AND is_have = 1 AND status_pakai != 1 AND DATE(tgl_terima_barang) = '$tglNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Masuk Bulan Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_have = 1 AND status_pakai != 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_have = 1 AND status_pakai != 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div> -->
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Keluar/Perjalanan Hari Ini / </span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        //perbaikan brangkirim diganti is_out = 0
                        // $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE dari_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_jtran = 1 AND is_have = 1 AND DATE(tgl_terima_barang) = '$tglNow'");
                        //perbaikannya barang keluar saja jns transaksi 1 status blom diterima 
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE dari_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_jtran = 1 AND is_out = 0 AND is_have = 0 ");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE dari_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_jtran = 1 AND is_out = 0 AND is_have = 0");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3 col-sm-6 col-xs-11">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Keluar Bulan Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE dari_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_jtran = 1 AND is_have = 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE dari_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_jtran = 1 AND is_have = 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div> -->
    <?php if ($this->session->userdata('user_login')['id_uker'] == 1 || $this->session->userdata('user_login')['id_uker'] == 13 || $this->session->userdata('user_login')['id_uker'] == 68) { ?>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-cube"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Barang Masuk Hari Ini Dari Vendor</span>
                    <table style="width: 100%;">
                        <tr>
                            <th>Spare Part</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                        <?php
                        $sgbar = $this->General->fetch_records('tbl_sgbarang');
                        foreach ($sgbar as $sg) {
                            $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_out = 0 AND id_vendor != 1 AND DATE(tgl_terima_barang) = '$tglNow'");

                            $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_out = 0 AND id_vendor != 1 AND DATE(tgl_terima_barang) = '$tglNow'");

                        ?>
                            <tr>
                                <td><?= $sg->nama_sgbarang ?></td>
                                <td><?= $total[0]->Jumlah ?></td>
                                <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3 col-sm-6 col-xs-11">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cube"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Barang Masuk Bulan Ini Dari Vendor</span>
                    <table style="width: 100%;">
                        <tr>
                            <th>Spare Part</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                        <?php
                        $sgbar = $this->General->fetch_records('tbl_sgbarang');
                        foreach ($sgbar as $sg) {
                            $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_vendor != 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                            $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND id_vendor != 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                        ?>
                            <tr>
                                <td><?= $sg->nama_sgbarang ?></td>
                                <td><?= $total[0]->Jumlah ?></td>
                                <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                            </tr>
                        <?php } ?>
                        </span>
                    </table>
                </div>
            </div>
        </div> -->
    <?php } ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Pemakaian Hari Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        // Kondisi Balikan : SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = 2 AND id_sgbarang = 1 AND status_pakai = 1 AND is_balikan = 1 AND DATE(tgl_terima_barang) = '2021-03-25' 
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND status_pakai = 1 AND DATE(tgl_terima_barang) = '$tglNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND status_pakai = 1 AND DATE(tgl_terima_barang) = '$tglNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3 col-sm-6 col-xs-11">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Pemakaian Bulan Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND status_pakai = 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND status_pakai = 1 AND MONTH(tgl_terima_barang) = '$monthNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div> -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Balikan Hari Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_balikan = 1 AND id_jtran = 3 AND DATE(tgl_terima_barang) = '$tglNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_balikan = 1 AND id_jtran = 3 AND DATE(tgl_terima_barang) = '$tglNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3 col-sm-6 col-xs-11">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-cube"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Balikan Bulan Ini</span>
                <table style="width: 100%;">
                    <tr>
                        <th>Spare Part</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    <?php
                    $sgbar = $this->General->fetch_records('tbl_sgbarang');
                    foreach ($sgbar as $sg) {
                        $total = $this->General->fetch_CoustomQuery("SELECT count(*) as Jumlah FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_balikan = 1 AND id_jtran = 3 AND MONTH(tgl_terima_barang) = '$monthNow'");
                        $totalHarga = $this->General->fetch_CoustomQuery("SELECT sum(harga_barang) as totalHarga FROM v_dashboard WHERE id_uker = " . $this->session->userdata('user_login')['id_uker'] . " AND id_sgbarang = $sg->id_sgbarang AND is_balikan = 1 AND id_jtran = 3 AND MONTH(tgl_terima_barang) = '$monthNow'");
                    ?>
                        <tr>
                            <td><?= $sg->nama_sgbarang ?></td>
                            <td><?= $total[0]->Jumlah ?></td>
                            <td><?= rupiah($totalHarga[0]->totalHarga) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div> -->
</div>