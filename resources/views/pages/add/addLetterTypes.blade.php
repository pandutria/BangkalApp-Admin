<div class="modal fade" id="modalTambahKategoriSurat" tabindex="-1" aria-labelledby="modalTambahKategoriSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahKategoriSuratLabel">Tambah Kategori Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="submit" form="formBerita">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    const submitBtn = document.getElementById('submit');

    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const gambar = document.getElementById('gambar').files[0];

        const formData = new FormData();
        formData.append('file', gambar);
        formData.append('upload_preset', 'bangkal-app');
        formData.append('folder', 'bangkal-app/letter-types');

        async function handleSubmit() {
            try {
                const uploadResponse = await axios.post(
                    'https://api.cloudinary.com/v1_1/dxbafxnb5/image/upload',
                    formData
                );

                const imageUrl = uploadResponse.data.secure_url;

                await axios.post('/api/letterType', {
                    name: nama,
                    description: deskripsi,
                    image_url: imageUrl,
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil ditambahkan'
                });

                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal ditambahkan'
                });
            }
        }

        handleSubmit();
    });
</script>