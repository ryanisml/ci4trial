$(document).ready( function () {
    $('#datatablesSimple').DataTable();
} );

$('.btnhapus').click(function () {
    var url = $(this).attr('href');
    var data = $(this).data("status");
    teks = 'Apakah anda yakin ingin menghapus data user dengan nik ' + data + '?';
    Swal.fire({
        title: 'Konfirmasi',
        text: teks,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Tidak!'
    }).then((result) => {
        if (result.value) {
            window.location.replace(url)
        }
    })
    return false
})