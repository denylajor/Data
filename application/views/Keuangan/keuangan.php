<form action="<?= base_url('Keuangan/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel" style="background-color: #012a4a; color:#FFF;">
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
                                <a class="col-sm-" href="Sumrekon" style="color: white;">Summary Rekonsiliasi | </a>
                                <a class="col-sm-" href="Lapvaksin" style="color: white;">Laporan Vaksin | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>

                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    })
</script>