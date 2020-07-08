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
        <?= form_open('mahasiswa/deletemultiple', ['class' => 'formhapus']) ?>
        <div class="card-body">
            <button type="button" class="btn btn-primary" id="tomboltambah">
                <i class="fa fa-plus-circle"></i> Tambah Mahasiswa
            </button>

            <button type="submit" class="btn btn-sm btn-danger tombolHapusBanyak">
                <i class="fa fa-trash-o"></i> Hapus Banyak
            </button>

            <p class="card-text">
                <table class="table table-bordered table-striped display nowrap" style="width:100%;" id="datamahasiswa">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="centangSemua">
                            </th>
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
        <?= form_close(); ?>
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

    $('#centangSemua').click(function(e) {
        if ($(this).is(":checked")) {
            $('.centangNobp').prop('checked', true);
        } else {
            $('.centangNobp').prop('checked', false);
        }
    });

    tampildatamahasiswa();

    $('#centangSemua').click(function(e) {
        if ($(this).is(':checked')) {
            $(".centangItem").prop("checked", true);
        } else {
            $(".centangItem").prop("checked", false);
        }
    });

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

    $('.formhapus').submit(function(e) {
        e.preventDefault();

        let jmldata = $('.centangNobp:checked');

        if (jmldata.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Maaf tidak ada yang bisa dihapus, silahkan dicentang !'
            })
        } else {
            Swal.fire({
                title: 'Hapus Data',
                text: `Ada ${jmldata.length} data mahasiswa yang akan dihapus, yakin ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses
                                })
                                tampildatamahasiswa();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                                thrownError);
                        }
                    });
                }
            })
        }
        return false;
    });
});

function edit(nobp) {
    $.ajax({
        type: 'post',
        url: "<?= site_url('mahasiswa/formedit') ?>",
        data: {
            nobp: nobp
        },
        dataType: "json",
        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').on('shown.bs.modal', function(e) {
                    $('#nama').focus();
                })
                $('#modaledit').modal('show');
            }
        }
    });
}

function hapus(nobp) {
    Swal.fire({
        title: 'Hapus',
        text: `Yakin menghapus mahasiswa dengan nobp =${nobp} ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "<?= site_url('mahasiswa/hapus') ?>",
                data: {
                    nobp: nobp,
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Konfirmasi',
                            text: response.sukses
                        });
                        tampildatamahasiswa();
                    }
                }
            });
        }
    })
}
</script>