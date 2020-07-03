<!-- DataTables -->
<link href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<div class="col-lg-12">
    <div class="card m-b-30">
        <h4 class="card-header mt-0">Seluruh Data Mahasiswa</h4>
        <div class="card-body">
            <p class="card-text">
                <table class="table table-bordered table-striped" style="width:100%;" id="datamahasiswa">
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
<script>
$(document).ready(function() {
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
});
</script>