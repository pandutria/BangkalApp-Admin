<div class="modal fade" id="modalEditSurat" tabindex="-1" aria-labelledby="modalEditSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSuratLabel">Detail Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="namaEdit" class="form-label">Nama</label>
                                <input type="text" disabled class="form-control" id="namaEdit" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipeEdit" class="form-label">Tipe</label>
                                <input type="text" disabled class="form-control" id="tipeEdit" name="tipe" required>
                            </div>
                            <div class="mb-3">
                                <label for="nikEdit" class="form-label">NIK</label>
                                <input type="text" disabled class="form-control" id="nikEdit" name="nik" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamatEdit" class="form-label">Alamat</label>
                                <input type="text" disabled class="form-control" id="alamatEdit" name="alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="genderEdit" class="form-label">Jenis Kelamin</label>
                                <input type="text" disabled class="form-control" id="genderEdit" name="gender" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempatLahirEdit" class="form-label">Tempat Lahir</label>
                                <input type="text" disabled class="form-control" id="tempatLahirEdit" name="tempatLahir" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="wargaEdit" class="form-label">Kewarganegaraan</label>
                                <input type="text" disabled class="form-control" id="wargaEdit" name="warga" required>
                            </div>
                            <div class="mb-3">
                                <label for="agamaEdit" class="form-label">Agama</label>
                                <input type="text" disabled class="form-control" id="agamaEdit" name="agama" required>
                            </div>
                            <div class="mb-3">
                                <label for="ayahEdit" class="form-label">Nama Ayah</label>
                                <input type="text" disabled class="form-control" id="ayahEdit" name="ayah" required>
                            </div>
                            <div class="mb-3">
                                <label for="ibuEdit" class="form-label">Nama Ibu</label>
                                <input type="text" disabled class="form-control" id="ibuEdit" name="ibu" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="editId" name="editId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" id="reject" form="formBerita">Tolak</button>
                <button type="submit" class="btn btn-success" id="approve" form="formBerita">Terima</button>
            </div>
        </div>
    </div>
</div>


<script>
    const approve = document.getElementById('approve');
    const reject = document.getElementById('reject');
    
    approve.addEventListener('click', function(e) {
        e.preventDefault();

        const id = document.getElementById('editId').value;
        async function handleApprove() {
            try {
                await axios.put(`/api/letterRequest/approved/${id}`, {});

                Swal.fire({
                    icon: 'success',
                    title: 'Surat diterima'
                });

                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data Gagal Diubah'
                });
            }
        }

        handleApprove();
    });

    reject.addEventListener('click', function(e) {
        e.preventDefault();

        const id = document.getElementById('editId').value;
        async function handleReject() {
            try {
                await axios.put(`/api/letterRequest/rejected/${id}`, {});

                Swal.fire({
                    icon: 'success',
                    title: 'Surat ditolak'
                });

                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data Gagal Diubah'
                });
            }
        }

        handleReject();
    });
</script>