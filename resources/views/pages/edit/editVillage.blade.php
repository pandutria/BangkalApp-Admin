<div class="modal fade" id="modalEditPengguna" tabindex="-1" aria-labelledby="modalTEditPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditOrganisasiLabel">Ubah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBerita">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="namaEdit" name="nama" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" id="gambarEdit" name="gambar" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Organisasi</label>
                        <select class="form-select" id="organisasiEdit" required>
                            <option value="" disabled selected>Pilih Organisasi</option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Kontak</label>
                        <input type="tel" value="+62" class="form-control" id="contactEdit" name="nama" required>
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

    async function organizationEditValue() {
        const select = document.getElementById('organisasiEdit');
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

    editBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const nama = document.getElementById('namaEdit').value;
        const kontak = document.getElementById('contactEdit').value;
        const gambar = document.getElementById('gambarEdit').files[0];
        const organization = document.getElementById('organisasiEdit').value
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

                await axios.put(`/api/village/${id}`, {
                    name: nama,
                    organization_id: organization,
                    contact: kontak,
                    image_url: imageUrl,
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
    
    organizationEditValue();
</script>