<!-- DataTables -->
<link href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet"
    type="text/css" />

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<div class="col-lg-12">
    <div class="card m-b-30">
        <h4 class="card-header mt-0">Seluruh Data Mahasiswa</h4>
        <div class="card-body">
            <button type="button" class="btn btn-primary" id="tomboltambah">
                <i class="fa fa-plus-circle"></i> Tambah Mahasiswa
            </button>
            <p class="card-text">
                <table class="table table-bordered table-striped display nowrap" style="width:100%;" id="datamahasiswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NOBP</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl.Lahir</th>
                            <th>Jenkel</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function tampildatamahasiswa() {
    table = $('#datamahasiswa').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('mahasiswa/ambildata') ?>",
            "type": "POST"
        },


        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],

    });
}
$(document).ready(function() {
    tampildatamahasiswa();

    $('#tomboltambah').click(function(e) {
        $.ajax({
            url: "<?= site_url('mahasiswa/formtambah') ?>",
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaltambah').on('shown.bs.modal', function(e) {
                        $('#nobp').focus();
                    })
                    $('#modaltambah').modal('show');
                }
            }
        });
    });
});
</script>