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
                            <div class="mb-3"><label>Nama</label><input type="text" disabled class="form-control" id="namaEdit"></div>
                            <div class="mb-3"><label>Tipe</label><input type="text" disabled class="form-control" id="tipeEdit"></div>
                            <div class="mb-3"><label>NIK</label><input type="text" disabled class="form-control" id="nikEdit"></div>
                            <div class="mb-3"><label>RT</label><input type="text" disabled class="form-control" id="rtEdit"></div>
                            <div class="mb-3"><label>RW</label><input type="text" disabled class="form-control" id="rwEdit"></div>
                            <div class="mb-3"><label>Alamat</label><input type="text" disabled class="form-control" id="alamatEdit"></div>
                            <div class="mb-3"><label>Jenis Kelamin</label><input type="text" disabled class="form-control" id="genderEdit"></div>
                            <div class="mb-3"><label>Tempat Lahir</label><input type="text" disabled class="form-control" id="tempatLahirEdit"></div>
                            <div class="mb-3" id="pdfWrapper" style="display: none;">
                                <label>File PDF</label>
                                <iframe id="pdfPreview" src="" width="100%" height="300px"></iframe>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3"><label>Status Perkawinan</label><input type="text" disabled class="form-control" id="menikahEdit"></div>
                            <div class="mb-3"><label>Kota Domisili</label><input type="text" disabled class="form-control" id="kotaEdit"></div>
                            <div class="mb-3"><label>Pekerjaan</label><input type="text" disabled class="form-control" id="kerjaEdit"></div>
                            <div class="mb-3"><label>Keperluan</label><input type="text" disabled class="form-control" id="keperluanEdit"></div>
                            <div class="mb-3"><label>Kewarganegaraan</label><input type="text" disabled class="form-control" id="wargaEdit"></div>
                            <div class="mb-3"><label>Agama</label><input type="text" disabled class="form-control" id="agamaEdit"></div>
                            <div class="mb-3"><label>Nama Ayah</label><input type="text" disabled class="form-control" id="ayahEdit"></div>
                            <div class="mb-3"><label>Nama Ibu</label><input type="text" disabled class="form-control" id="ibuEdit"></div>
                            <div class="mb-3"><label>No. KTP</label><input type="text" disabled class="form-control" id="ktpEdit"></div>
                            <div class="mb-3"><label>No. KK</label><input type="text" disabled class="form-control" id="kkEdit"></div>
                        </div>
                    </div>

                    <input type="hidden" id="editId">
                </form>

                <div id="pdfContainer" style="display:none" class="mt-3">
                    <h6>File Surat</h6>
                    <a id="pdfLink" href="#" target="_blank" class="btn btn-primary btn-sm">Lihat PDF</a>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="reject">Tolak</button>
                <button type="button" class="btn btn-success" id="approve">Terima</button>
            </div>

        </div>
    </div>
</div>

<script>
    const approve = document.getElementById('approve');
    const reject = document.getElementById('reject');

    function showPdf(fileUrl) {
        const container = document.getElementById("pdfContainer");
        const link = document.getElementById("pdfLink");

        if (fileUrl && fileUrl !== "") {
            container.style.display = "block";
            link.href = fileUrl;
        } else {
            container.style.display = "none";
        }
    }

    approve.addEventListener('click', function () {
        const id = document.getElementById('editId').value;

        Swal.fire({
            title: 'Unggah File PDF',
            input: 'file',
            inputAttributes: { accept: 'application/pdf' },
            showCancelButton: true,
            confirmButtonText: 'Unggah'
        }).then(async (result) => {
            if (!result.value) return;

            const formData = new FormData();
            formData.append("_method", "PUT");
            formData.append('file', result.value);

            try {
                await axios.post(`/api/letterRequest/approved/${id}`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });

                Swal.fire({ icon: 'success', title: 'Surat diterima' });
                setTimeout(() => { window.location.reload(); }, 2000);

            } catch {
                Swal.fire({ icon: 'error', title: 'Gagal Upload' });
            }
        });
    });

    reject.addEventListener('click', async function () {
        const id = document.getElementById('editId').value;

        try {
            await axios.put(`/api/letterRequest/rejected/${id}`);
            Swal.fire({ icon: 'success', title: 'Surat ditolak' });
            setTimeout(() => { window.location.reload(); }, 2000);
        } catch {
            Swal.fire({ icon: 'error', title: 'Data Gagal Diubah' });
        }
    });
</script>
