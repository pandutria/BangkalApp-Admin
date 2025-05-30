import './bootstrap';
import axios from 'axios';
import Swal from 'sweetalert2';

$('#dataTable').DataTable({
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
