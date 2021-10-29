<form action="<?= base_url('Keuangan/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="keuangan" id="keuangan" required>
                            <option value="">--Select Tabel--</option>
                            <option value="tbl_summary_rekonsiliasi">Summary Rekonsiliasi</option>
                            <option value="tbl_laporan_vaksin">Laporan Vaksin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih File Excel</label>
                        <input type="file" name="fileExcel" required>
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
                                <a class="col-sm-" href="Sumrekon">Summary Rekonsiliasi | </a>
                                <a class="col-sm-" href="Lapvaksin">Laporan Vaksin | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                     <table id="tableBarang" class="table table-bordered table-striped" style="width: 100%;">
                        <thead style="background-color: #282828; color: white;">
                        	<tr role="row">
                                <th>No</th>
                                <th>ID Personal</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Tanggal Vaksin 1</th>
                                <th>Tanggal Vaksin 2</th>
                                <th>Keterangan</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                                <!-- <th>denom</th>
                                <th>keterangan</th> -->
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all" style="background-color: #aaaba9;"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>
<script type="text/javascript">
	const urlLapvaksin = '<?= site_url("Lapvaksin/") ?>';
    let table;

    $(function() {
        if (!$.fn.DataTable.isDataTable('#tableBarang')) {
            table = $('#tableBarang').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                order: [],
                scrollX: true,
                ajax: {
                    url: urlLapvaksin + "listLapvaksin",
                    type: "POST"
                },
                columnDefs: [{
                    targets: [0, -1],
                    orderable: false,
                }, ],
            });
        }
    });


    $(function() {
        $('.select2').select2();
    })   
</script>