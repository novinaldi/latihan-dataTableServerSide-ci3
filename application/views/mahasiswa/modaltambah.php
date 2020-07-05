<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('mahasiswa/simpandata', ['class' => 'formsimpan']) ?>
            <div class="pesan" style="display: none;"></div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nobp" class="col-sm-2 col-form-label">No.BP</label>
                    <div class="col-sm-4">
                        <input type="text" name="nobp" id="nobp" class="form-control" maxlength="7">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nobp" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nobp" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-6">
                        <input type="text" name="tempat" id="tempat" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nobp" class="col-sm-2 col-form-label">Tgl.Lahir</label>
                    <div class="col-sm-4">
                        <input type="date" name="tgl" id="tgl" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nobp" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-6">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option value="">-Pilih-</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.formsimpan').submit(function(e) {
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('.pesan').html(response.error).show();
                }

                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses
                    });
                    tampildatamahasiswa();
                    $('#modaltambah').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });
});
</script>