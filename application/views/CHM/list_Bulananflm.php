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
                            <option value="tbl_timeline_ho_atm_bri_kolaborasi">Timeline HO ATM BRI Kolaborasi</option>
                            <option value="tbl_ssb_pm_new">SSB PM New</option>
                            <option value="tbl_crm_pm_new">CRM PM New</option>
                            <option value="tbl_hybrid_pm_new">Hybrid PM New</option>
                            <option value="tbl_bulanan_flm_700_crm">Bulanan FLM CRM 700</option>
                            <option value="tbl_ssb_hybrid_new">SSB & Hybrid New</option>
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
                                <a class="col-sm-" href="Tlatmbrikolab">Timeline HO ATM BRI Kolaborasi |</a>
                                <a class="col-sm-" href="Ssbpm">SSB PM |</a>
                                <a class="col-sm-" href="Crmpm">CRM PM |</a>
                                <a class="col-sm-" href="Hybridpm">Hybrid PM |</a>
                                <a class="col-sm-" href="Bulananflm">Bulanan FLM CRM 700 |</a>
                                <br> <hr>
                                <a class="col-sm-" href="Ssbhybrid">SSB & Hybrid |</a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Bulan Periode PM</th>
                                <th>Kanwil</th>
                                <th>Target PM</th>
                                <th>Done PM</th>
                                <th>On Progress</th>
                                <th>Performance (%)</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>



<script>
    const urlBulananflm = '<?= site_url("Bulananflm/") ?>';
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
                    url: urlBulananflm + "listBulananflm",
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