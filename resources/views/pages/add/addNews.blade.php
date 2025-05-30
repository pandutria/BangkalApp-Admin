<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Berita Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Berita</label>
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
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Berita</label>
                        <input type="url" class="form-control" id="link" name="link">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
        const link = document.getElementById('link').value;
        const tanggal = document.getElementById('tanggal').value;

        const formData = new FormData();
        formData.append('file', gambar);
        formData.append('upload_preset', 'bangkal-app');
        formData.append('folder', 'bangkal-app/news');

        async function handleSubmit() {
            try {
                const uploadResponse = await axios.post(
                    'https://api.cloudinary.com/v1_1/dxbafxnb5/image/upload',
                    formData
                );

                const imageUrl = uploadResponse.data.secure_url;

                await axios.post('/api/news', {
                    title: nama,
                    text: deskripsi,
                    url: link,
                    image_url: imageUrl,
                    date: tanggal,
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