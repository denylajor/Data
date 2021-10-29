<form action="<?= base_url('Marketing/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="marketing" id="marketing">
                            <option value="">--Select Tabel--</option>
                            <option value="inisiasi_proyek">Inisiasi Proyek</option>
                            <option value="laporan_vaksin">Laporan Vaksin</option>
                            <option value="surat_penawaran">Surat Penawaran</option>
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
                                <a class="col-sm-" href="Inisiasiproyek">Inisiasi Proyek | </a>
                                <a class="col-sm-" href="Laporanvaksin">Laporan Vaksin | </a>
                                <a class="col-sm-" href="Suratpenawaran">Surat Penawaran | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Unit Kerja</th>
                                <th>ID Personal</th>
                                <th>ID Pegawai</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Sudah Vaksin 1</th>
                                <th>Sudah Vaksin 2</th>
                                <th>Keterangan</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>

<script>
    const urlLaporanvaksin = '<?= site_url("Laporanvaksin/") ?>';
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
                    url: urlLaporanvaksin + "listLaporanvaksin",
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