<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangkal App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    @include('pages.edit.editLetter')
    <div class="" id="wrapper">
        @include('components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.navbar')
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="h3 text-gray-800 mb-0">Surat</h1>
                    </div>
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori Surat</th>
                                            <th>NIK</th>
                                            <th>Gender</th>
                                            <th>Tempat Lahir</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="letterBody">
                                        <!-- <tr>  -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/assets/js/sb-admin-2.min.js"></script>

<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/demo/datatables-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let table;
    const deleteBtn = document.getElementById('deleteBtn');

    async function getLetter() {
        const response = await axios.get('/api/letterRequest');

        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().clear().destroy();
        }

        const tbody = document.getElementById('letterBody');
        const dataTableBody = [];

        response.data.forEach(data => {
             const row = `
                <tr>
                <td>${data.user.fullname}</td>
                <td>${data.letter_type.name}</td>
                <td>${data.nik}</td>
                <td>${data.gender}</td>
                <td>${data.place_of_birth}</td>
                <td class="h5">${data.status === 'pending'
                                    ? '<span class="badge border border-warning text-warning">Menunggu</span>'
                                    : data.status === 'approved'
                                        ? '<span class="badge border border-success text-success">Diterima</span>'
                                        : data.status === 'rejected'
                                            ? '<span class="badge border border-danger text-danger">Ditolak</span>'
                                            : ''
                                }</td>
                <td class="d-flex">
                <button class="btn btn-sm btn-success me-1 editBtn mx-1"
                    data-id="${data.uuid}"
                    data-user="${data.user.fullname}"
                    data-tipe="${data.letter_type.name}"
                    data-nik="${data.nik}"
                    data-rt="${data.rt}"
                    data-rw="${data.rw}"
                    data-ktp="${data.ktp}"
                    data-kk="${data.no_kk}"
                    data-address="${data.address}"
                    data-gender="${data.gender}"
                    data-place="${data.place_of_birth}"
                    data-marriage="${data.marriage}"
                    data-city="${data.city}"
                    data-work="${data.work}"
                    data-purpose="${data.purpose}"
                    data-citizenship="${data.citizenship}"
                    data-religion="${data.religion}"
                    data-father="${data.father_name}"
                    data-mother="${data.mother_name}"
                    data-file="${data.file}">
                    Lihat
                </button>
                <button class="btn btn-sm btn-danger mx-1" data-id="${data.uuid}">Hapus</button>
                </td>
                </tr>
                `;
            dataTableBody.push(row);
        });

        tbody.innerHTML = dataTableBody.join("");
        table = $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "Tidak ada data yang tersedia pada tabel",
                "info": "Tampil _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Memuat...",
                "processing": "Memproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                }
            }
        });
    }

    document.getElementById('letterBody').addEventListener('click', async function(e) {
        if (e.target && e.target.classList.contains('btn-danger')) {
            const id = e.target.getAttribute('data-id');

            const confirmDelete = await Swal.fire({
                title: 'Yakin ingin menghapus Surat ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            });

            if (confirmDelete.isConfirmed) {
                try {
                    await axios.delete(`/api/letterRequest/${id}`);
                    Swal.fire('Terhapus!', 'Surat berhasil dihapus.', 'success');
                    getLetter();
                } catch (error) {
                    Swal.fire('Gagal!', 'Surat gagal dihapus.', 'error');
                    console.error(error);
                }
            }
        }
    });

    function convertToISODate(dateStr) {
        const parts = dateStr.split('-');
        if (parts.length === 3) {
            return `${parts[2]}-${parts[1]}-${parts[0]}`;
        }
        return dateStr;
    }

    document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('editBtn')) {
            const b = e.target;
        
            document.getElementById('editId').value = b.dataset.id;
            document.getElementById('namaEdit').value = b.dataset.user;
            document.getElementById('tipeEdit').value = b.dataset.tipe;
            document.getElementById('nikEdit').value = b.dataset.nik;
            document.getElementById('rtEdit').value = b.dataset.rt;
            document.getElementById('rwEdit').value = b.dataset.rw;
            document.getElementById('ktpEdit').value = b.dataset.ktp;
            document.getElementById('kkEdit').value = b.dataset.kk;
            document.getElementById('alamatEdit').value = b.dataset.address;
            document.getElementById('genderEdit').value = b.dataset.gender;
            document.getElementById('tempatLahirEdit').value = b.dataset.place;
            document.getElementById('menikahEdit').value = b.dataset.marriage;
            document.getElementById('kotaEdit').value = b.dataset.city;
            document.getElementById('kerjaEdit').value = b.dataset.work;
            document.getElementById('keperluanEdit').value = b.dataset.purpose;
            document.getElementById('wargaEdit').value = b.dataset.citizenship;
            document.getElementById('agamaEdit').value = b.dataset.religion;
            document.getElementById('ayahEdit').value = b.dataset.father;
            document.getElementById('ibuEdit').value = b.dataset.mother;
            const pdfUrl = b.dataset.file;

            if (pdfUrl && pdfUrl !== "null" && pdfUrl !== "") {
                document.getElementById("pdfWrapper").style.display = "block";
                document.getElementById("pdfPreview").src = "/storage/" + pdfUrl;
            } else {
                document.getElementById("pdfWrapper").style.display = "none";
                document.getElementById("pdfPreview").src = "";
            }
        
            $('#modalEditSurat').modal('show');
        }
    });

    getLetter();
</script>

</html>