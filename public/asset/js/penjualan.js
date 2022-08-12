$(document).ready( function () {
    $('.selectbarang').select2({
      placeholder: 'Pilih Barang'
    });
    var total = 0;
    $('.selectbarang').on('select2:select', function (e) {
        var data = e.params.data;
        $.ajax({
            type: "POST",
            url: "getdata",
            data: "kodebarang="+data.id,
            dataType: 'json',
            cache: false,
            success: function( response ) {
                if (response.success == true) {
                    $("#table_penjualan tbody").append("<tr><td>"+data.id+"<input type='hidden' name='kode_barang[]' value='"+data.id+"' /></td><td>"+response.nama_barang+"<input type='hidden' name='nama_barang[]' value='"+response.nama_barang+"' /></td><td>"+response.barcode+"<input type='hidden' name='barcode[]' value='"+response.barcode+"' /></td><td>"+response.harga_satuan+"<input type='hidden' name='harga_satuan[]' id='harga_satuan' value='"+response.harga_satuan+"' /></td><td><input type='number' max='"+response.stok+"' id='jumlah_beli' name='jumlah_beli[]' class='form-control' placeholder='Jumlah Beli'/></td><td><a href='' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a></td></tr>");
                }else{
                    Swal.fire({
                        title: 'Maaf',
                        text: "Data dengan kode barang "+data.id+" tidak ditemukan",
                        icon: 'warning'
                    });
                }
            }
        });
    });

    $('#kalkulasi').click(function () {
        var total = 0;
        var harga = document.getElementsByName('harga_satuan[]');
        var jumlah = document.getElementsByName('jumlah_beli[]');
        ini = 0;
        $('input[name^="kode_barang"]').each(function() {
            var a = harga[ini].value * jumlah[ini].value;
            total = total + a;
            ini++;
        });
        $('#total_harga').val(total);
        var totalbayar = $.trim($('#total_bayar').val());
        if (totalbayar === '') {
        }else{
            $('#kembalian').val(totalbayar - total);
        }
    });
});