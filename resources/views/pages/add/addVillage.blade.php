<div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-labelledby="modalTambahPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPenggunaLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="gambar" class="form-label">Foto</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Organisasi</label>
                        <select class="form-select" id="organisasi" required>
                            <option value="" disabled selected>Pilih Organisasi</option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Kontak</label>
                        <input type="tel" value="+62" class="form-control" id="contact" name="nama" required>
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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const submitBtn = document.getElementById('submit');

    async function organizationValue() {
        const select = document.getElementById('organisasi');
        const response = await axios.get('/api/organization');

        select.innerHTML = `<option value="" disabled selected>Pilih Organisasi</option>`;
        const data = response.data;
        
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.title;
            select.appendChild(option);
        });
    }

    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value;
        const kontak = document.getElementById('contact').value;
        const gambar = document.getElementById('gambar').files[0];
        const organisasi = document.getElementById('organisasi').value;

        const formData = new FormData();
        formData.append('file', gambar);
        formData.append('upload_preset', 'bangkal-app');
        formData.append('folder', 'bangkal-app/village');

        async function handleSubmit() {
            try {
                const uploadResponse = await axios.post(
                    'https://api.cloudinary.com/v1_1/dxbafxnb5/image/upload',
                    formData
                );

                const imageUrl = uploadResponse.data.secure_url;

                await axios.post('/api/village', {
                    name: nama,
                    contact: kontak,
                    image_url: imageUrl,
                    organization_id: organisasi
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

    organizationValue();
</script>