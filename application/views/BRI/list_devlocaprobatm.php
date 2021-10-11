<form action="<?= base_url('CHM/import_excel_dataaset'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label>Pilih Table excel</label>
                        <select class="form-control select2" style="width: 50%;" name="chm" id="chm">
                            <option value="">--Select Tabel--</option>
                            <?php foreach ($inserttable as $tb) : ?>
                                <option value="<?= $tb->TABLE_NAME ?>"><?= $tb->TABLE_NAME ?></option>
                            <?php endforeach; ?>
                            <!-- <option value="">Layanan</option> -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih File</label>
                        <input type="file" name="fileExcel">
                    </div>

                    <button type="submit" id='addBarang' class='btn btn-info'>
                        Import <i class="fa fa-plus"></i>
                    </button>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm">
                            <div>
                                <a class="col-sm-" href="Devlocaprobatm">Tabel Dev Loc Problem Atm | </a>
                                <a class="col-sm-" href="Echmatrixbranch">Tabel Ech Matrix Branch | </a>
                                <a class="col-sm-" href="Echmatrixregion">Tabel Ech Matrix Region | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>term_id</th>
                                <th>lokasi</th>
                                <th>alamat</th>
                                <th>kantor_layanan</th>
                                <th>uker_induk</th>
                                <th>cluster</th>
                                <th>jam_operational</th>
                                <th>garansi</th>
                                <th>cctv_ada</th>
                                <th>cctv_tidak_ada</th>
                                <th>ups_ada</th>
                                <th>ups_tidak_ada</th>
                                <th>latitude</th>
                                <th>longitude</th>
                                <th>pagu</th>
                                <th>denom</th>
                                <th>keterangan</th>
                                <th>user</th>
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
    const urlDevlocaprobatm = '<?= site_url("Devlocaprobatm/") ?>';
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
                    url: urlDevlocaprobatm + "listDevlocaprobatm",
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