<form action="<?= base_url('CHM/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="chm" id="chm">
                            <option value="">--Select Tabel--</option>
                            <option value="tbl_data_aset">Data Aset</option>
                            <option value="tbl_cm">CM</option>
                            <option value="tbl_pm">PM</option>
                            <option value="tbl_detailpart">Detail Part</option>
                            <option value="tbl_off_in_flm">Off In Flm</option>
                            <option value="tbl_opname">Opname</option>
                            <option value="tbl_opnamepart">Opname Part</option>
                            <option value="tbl_reability">Reability Perform</option>
                            <option value="tbl_problem_report_cc">Problem Report (CC)</option>
                            <option value="tbl_report_portal_BRI_MA_cc">Report Portal BRI MA (CC)</option>
                            <option value="tbl_report_ssb_hybrid_cc">Report SSB & Hybrid (CC)</option>
                            <option value="tbl_technical_report_cc">Technical Report (CC)</option>
                            <option value="tbl_pengadaan_dan_distribusi_PO">Pengadaan & Distribusi </option>
                            <option value="tbl_kendaraan_logistik">Kendaraan Logistik</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih File Excel</label>
                        <input type="file" name="fileExcel">
                    </div>
                    <div class="row text-center" style="margin-bottom: 20px;">
                    <button type="submit" id='addBarang' class="btn btn-info" >
                        Import <i class="fa fa-plus"></i>
                    </button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm" style="width: 100%;">
                            <div>
                                <a class="col-sm-" href="DataAset">Data Aset | </a>
                                <a class="col-sm-" href="CM">CM | </a>
                                <a class="col-sm-" href="PM">PM | </a>
                                <a class="col-sm-" href="Detailpart">Detail Part | </a>
                                <a class="col-sm-" href="Offinflm">Off In FLM | </a>
                                <!-- <a class="col-sm-" href="Offoutflm">Off Out FlM | </a> -->
                                <a class="col-sm-" href="Opname">Opname | </a>
                                <a class="col-sm-" href="Opnamepart">Opname Part | </a>
                                <a class="col-sm-" href="Reabilityperform">Reability Perform | </a>
                                <a class="col-sm-" href="ProblemReportCC">Problem Report (CC)| </a>
                                <a class="col-sm-" href="ReportPortalBRIMACC">Report Portal BRI MA (CC) | </a>
                                <a class="col-sm-" href="ReportSSBHybridCC">Report SSB & Hybrid (CC) | </a>
                                <br>
                                <hr>
                                <a class="col-sm-" href="TechnicalReportCC">Technical Report (CC) | </a>
                                <a class="col-sm-" href="PengadaanDanDistribusiPO">Pengadaan & Distribusi PO | </a>
                                <a class="col-sm-" href="KendaraanLogistik">Kendaraan Logistik |</a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Code Uker</th>
                                <th>Cabang</th>
                                <th>TNBK Kendaraan</th>
                                <th>Tahun Kendaraan</th>
                                <th>Type Kendaraan</th>
                                <th>Rangka Kendaraan</th>
                                <th>No Mesin Kendaraan</th>

                                <th>Status Kendaraan</th>
                                <th>Project</th>
                                <th>Unit Layanan</th>
                                <th>GSM GPS</th>
                                <th>IMEI GPS</th>
                                <th>Status GPS</th>

                                <th>Vendor Kendaraan</th>
                                <th>Awal Berlaku Kendaraan</th>
                                <th>Akhir Berlaku Kendaraan</th>
                                <th>Masa Berlaku STNK</th>
                                <th>Masa Berlaku TNBK</th>
                                <th>Masa Berlaku Kir</th>
                                <th>Safety Box</th>
                                <th>Jenis Kendaraan</th>
                                <th>Keterangan</th>
                                <th>Cek Data</th>

                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>

<script>
    const urlKendaraanLogistik = '<?= site_url("KendaraanLogistik/") ?>';
    let table;

    $(function() {
        $('.select2').select2();
    })

    $(function() {
        if (!$.fn.DataTable.isDataTable('#tableBarang')) {
            table = $('#tableBarang').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                order: [],
                scrollX: true,
                ajax: {
                    url: urlKendaraanLogistik + "listKendaraanLogistik",
                    type: "POST"
                },
                columnDefs: [{
                    targets: [0, -1],
                    orderable: false,
                }, ],
            });
        }
    });
</script>