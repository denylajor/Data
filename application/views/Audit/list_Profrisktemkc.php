<form action="<?= base_url('Auditinternal/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="audit" id="audit">
                            <option value="">--Select Tabel--</option>
                            <option value="profile_risk_matrisk_resiko">Profile Risk Matrisk Resiko</option>
                            <option value="monitoring_rpm">Monitor RPM</option>
                            <option value="profile_risk_resiko">Profile Risk Resiko</option>
                            <option value="profile_risk_temuan_kc">Profile Risk Temuan KC</option>
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
                                <a class="col-sm-" href="Profriskmatres">Profile Risk Matrisk Resiko | </a>
                                <a class="col-sm-" href="Monitorrpm">Monitor RPM | </a>
                                <a class="col-sm-" href="Profriskresiko">Profile Risk Resiko | </a>
                                <a class="col-sm-" href="Profrisktemkc">Profile Risk Temuan KC | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered table-striped" style="width: 100%;">
                        <thead style="background-color: #282828; color: white;">
                            <tr role="row">
                                <th>No</th>
                                <th>Aktivitas</th>
                                <th>Sub Aktivitas</th>
                                <th>Judul</th>
                                <th>Kode Resiko</th>
                                <th>Issue Resiko</th>
                                <th>Tipe Temuan</th>
                                <th>Kategori Temuan</th>
                                <th>Aspek Penyebab LVL 1</th>
                                <th>Aspek Penyebab LVL 2</th>
                                <th>BG KC</th>
                                <th>Periode</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                         <tbody role="alert" aria-live="polite" aria-relevant="all" style="background-color: #aaaba9;"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>

<script>
    const urlProfrisktemkc = '<?= site_url("Profrisktemkc/") ?>';
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
                    url: urlProfrisktemkc + "listProfrisktemkc",
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