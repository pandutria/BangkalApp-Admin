<div class="modal fade" id="modalEditSejarah" tabindex="-1" aria-labelledby="modalTEditSejarahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSejarahLabel">Ubah Sejarah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Sejarah</label>
                        <input type="text" class="form-control" id="namaEdit" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiEdit" name="deskripsiEdit" rows="3" required></textarea>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" id="gambarEdit" name="gambar" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalEdit" name="tanggal" required>
                    </div>
                    <input type="hidden" id="editId" name="editId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="submitEdit" form="formBerita">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    const editBtn = document.getElementById('submitEdit');
    editBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const nama = document.getElementById('namaEdit').value;
        const deskripsi = document.getElementById('deskripsiEdit').value;
        const gambar = document.getElementById('gambarEdit').files[0];
        const tanggal = document.getElementById('tanggalEdit').value;
        const id = document.getElementById('editId').value;

        const formData = new FormData();
        formData.append('file', gambar);
        formData.append('upload_preset', 'Bangkal-app');

        async function handleEdit() {
            try {
                const uploadResponse = await axios.post(
                    'https://api.cloudinary.com/v1_1/dlnhrdqkh/image/upload',
                    formData
                );

                const imageUrl = uploadResponse.data.secure_url;

                await axios.put(`/api/history/${id}`, {
                    title: nama,
                    text: deskripsi,
                    image_url: imageUrl,
                    date: tanggal,
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil Diubah'
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

        handleEdit();
    });
    
</script>