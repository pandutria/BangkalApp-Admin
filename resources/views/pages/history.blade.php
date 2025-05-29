<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangkal App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    @include('pages.add.addHistory')
    @include('pages.edit.editHistory')
    <div class="" id="wrapper">
        @include('components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.navbar')
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="h3 text-gray-800 mb-0">Sejarah</h1>
                        <button class="btn text-white bg-success" data-toggle="modal" data-target="#modalTambahSejarah">
                            Tambah
                        </button>
                    </div>
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historyBody">
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

    async function getHistory() {
        const response = await axios.get('/api/history');

        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().clear().destroy();
        }

        const tbody = document.getElementById('historyBody');
        const dataTableBody = [];

        response.data.forEach(data => {
            const row = `
                <tr>
                    <td>${data.title}</td>
                    <td>${data.text}</td>
                    <td>
                        <img src="${data.image_url}" class="img-thumbnail" style="width: 150px;" />
                    </td>
                    <td>${data.date}</td>
                    <td class=" d-flex">
                        <button class="btn btn-sm btn-primary me-1 editBtn mx-1"
                            data-id="${data.id}"
                            data-title="${data.title}"
                            data-text="${data.text}"
                            data-image="${data.image_url}"
                            data-date="${data.date}"
                            data-target="#modalEditBerita">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger mx-1" data-id="${data.id}">Hapus</button>
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

    document.getElementById('historyBody').addEventListener('click', async function(e) {
        if (e.target && e.target.classList.contains('btn-danger')) {
            const id = e.target.getAttribute('data-id');

            const confirmDelete = await Swal.fire({
                title: 'Yakin ingin menghapus sejarah ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            });

            if (confirmDelete.isConfirmed) {
                try {
                    await axios.delete(`/api/history/${id}`);
                    Swal.fire('Terhapus!', 'Sejarah berhasil dihapus.', 'success');
                    getHistory();
                } catch (error) {
                    Swal.fire('Gagal!', 'Sejarah gagal dihapus.', 'error');
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
            const button = e.target;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const text = button.getAttribute('data-text');
            const url = button.getAttribute('data-url');
            const rawDate = button.getAttribute('data-date');
            const dateOnly = rawDate ? rawDate.split(' ')[0] : '';

            document.getElementById('namaEdit').value = title;
            document.getElementById('deskripsiEdit').value = text;
            document.getElementById('tanggalEdit').value = dateOnly;
            document.getElementById('editId').value = id;
            $('#modalEditSejarah').modal('show');
        }
    });

    getHistory();
</script>

</html>