$(document).ready( function () {
        $('#penjualan404').hide();
        $('#chartPenjualan').hide();
        $('#pembelian404').hide();
        $('#chartPembelian').hide();
        $('#pembelianbanyak404').hide();
        $('#chartPembelianbanyak').hide();
        $('#penjualanbanyak404').hide();
        $('#chartPenjualanbanyak').hide();
        $('#chartData').hide();
        $('#data404').hide();

        $.ajax({
                type: "POST",
                url: "home/tampil_data_barang",
                data: "",
                dataType: 'json',
                cache: false,
                success: function( response ) {
                        if (response.success == true) {
                                $('#chartData').show();
                                // chart_data('chartPenjualan', response.hasil, 'Pendapatan')
                                chart_bar_hor(response.hasil)
                        }else{
                                $('#data404').show();
                        }
                }
        });

        $("#kategori_penjualan").change(function () {
                var end = this.value;
                var datava = $('#kategori_penjualan').val();
                if (datava == 'tahunan') {
                        $("#tahunjualan").show();
                        $("#bulanjualan").hide();
                }else{
                        $("#bulanjualan").show();
                        $("#tahunjualan").show();
                }
        });

        $("#kategori_pembelian").change(function () {
                var end = this.value;
                var datava = $('#kategori_pembelian').val();
                if (datava == 'tahunan') {
                        $("#tahunbeli").show();
                        $("#bulanbeli").hide();
                }else{
                        $("#bulanbeli").show();
                        $("#tahunbeli").show();
                }
        });

        $("#kategori_penjualan_terbanyak").change(function () {
                var end = this.value;
                var datava = $('#kategori_penjualan_terbanyak').val();
                if (datava == 'tahunan') {
                        $("#tahunjualbanyak").show();
                        $("#bulanjualbanyak").hide();
                }else{
                        $("#bulanjualbanyak").show();
                        $("#tahunjualbanyak").show();
                }
        });

        $("#kategori_pembelian_terbanyak").change(function () {
                var end = this.value;
                var datava = $('#kategori_pembelian_terbanyak').val();
                if (datava == 'tahunan') {
                        $("#tahunbelibanyak").show();
                        $("#bulanbelibanyak").hide();
                }else{
                        $("#bulanbelibanyak").show();
                        $("#tahunbelibanyak").show();
                }
        });

        $('#cari_penjualan').click(function () {
                $('#penjualan404').hide();
                $('#chartPenjualan').hide();
                var kategori = $('#kategori_penjualan').val();
                var tahun = $('#tahun_penjualan').val();
                var bulan = $('#bulan_penjualan').val();
                $.ajax({
                        type: "POST",
                        url: "home/cari_penjualan",
                        data: "kategori="+kategori+"&tahun="+tahun+"&bulan="+bulan,
                        dataType: 'json',
                        cache: false,
                        success: function( response ) {
                                if (response.success == true) {
                                        $('#chartPenjualan').show();
                                        chart_data('chartPenjualan', response.hasil, 'Pendapatan')

                                }else{
                                        $('#penjualan404').show();
                                }
                        }
                });
        });

        $('#cari_pembelian').click(function () {
                $('#pembelian404').hide();
                $('#chartPembelian').hide();
                var kategori = $('#kategori_pembelian').val();
                var tahun = $('#tahun_pembelian').val();
                var bulan = $('#bulan_pembelian').val();
                $.ajax({
                        type: "POST",
                        url: "home/cari_pembelian",
                        data: "kategori="+kategori+"&tahun="+tahun+"&bulan="+bulan,
                        dataType: 'json',
                        cache: false,
                        success: function( response ) {
                                if (response.success == true) {
                                        $('#chartPembelian').show();
                                        chart_data('chartPembelian', response.hasil, 'Grafik Data Pengeluaran')

                                }else{
                                        $('#pembelian404').show();
                                }
                        }
                });
        });

        $('#cari_penjualan_terbanyak').click(function () {
                $('#penjualanbanyak404').hide();
                $('#chartPenjualanbanyak').hide();
                var kategori = $('#kategori_penjualan_terbanyak').val();
                var tahun = $('#tahun_penjualan_terbanyak').val();
                var bulan = $('#bulan_penjualan_terbanyak').val();
                $.ajax({
                        type: "POST",
                        url: "home/cari_penjualan_terbanyak",
                        data: "kategori="+kategori+"&tahun="+tahun+"&bulan="+bulan,
                        dataType: 'json',
                        cache: false,
                        success: function( response ) {
                                if (response.success == true) {
                                        $('#chartPenjualanbanyak').show();
                                        chart_pie('chartPenjualanbanyak', response.hasil, 'Penjualan Berdasarkan Stok')

                                }else{
                                        $('#penjualanbanyak404').show();
                                }
                        }
                });
        });

        $('#cari_pembelian_terbanyak').click(function () {
                $('#pembelianbanyak404').hide();
                $('#chartPembelianbanyak').hide();
                var kategori = $('#kategori_pembelian_terbanyak').val();
                var tahun = $('#tahun_pembelian_terbanyak').val();
                var bulan = $('#bulan_pembelian_terbanyak').val();
                $.ajax({
                        type: "POST",
                        url: "home/cari_pembelian_terbanyak",
                        data: "kategori="+kategori+"&tahun="+tahun+"&bulan="+bulan,
                        dataType: 'json',
                        cache: false,
                        success: function( response ) {
                                if (response.success == true) {
                                        $('#chartPembelianbanyak').show();
                                        chart_pie('chartPembelianbanyak', response.hasil, 'Pembelian Berdasarkan Stok')

                                }else{
                                        $('#pembelianbanyak404').show();
                                }
                        }
                });
        });
});

function chart_bar_hor(hasil){
        am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_material);
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("chartData", am4charts.PieChart);

                // Add data
                chart.data = hasil;

                // Add and configure Series
                var topContainer = chart.chartContainer.createChild(am4core.Container);
                topContainer.layout = "absolute";
                topContainer.toBack();
                topContainer.paddingBottom = 15;
                topContainer.width = am4core.percent(100);
                var axisTitle = topContainer.createChild(am4core.Label);
                axisTitle.text = 'TOTAL STOK BARANG';
                axisTitle.fontWeight = 600;
                axisTitle.align = "center";
                axisTitle.wrap = true;

                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "jumlah";
                pieSeries.dataFields.category = "barang";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeOpacity = 1;

                pieSeries.ticks.template.disabled = true;
                pieSeries.alignLabels = false;
                pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
                pieSeries.labels.template.radius = am4core.percent(-30);
                pieSeries.labels.template.fill = am4core.color("white");
                pieSeries.labels.template.relativeRotation = 80;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chart.hiddenState.properties.radius = am4core.percent(0);

                // Add legend
                chart.legend = new am4charts.Legend();
                chart.legend.labels.template.text = "[bold {color}]{name} = {value}[/]";
        });
}

function chart_pie(namachart, hasil, namalbl){
        am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_kelly);
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create(namachart, am4charts.PieChart);

                // Add data
                chart.data = hasil;

                // Add and configure Series
                var topContainer = chart.chartContainer.createChild(am4core.Container);
                topContainer.layout = "absolute";
                topContainer.toBack();
                topContainer.paddingBottom = 15;
                topContainer.width = am4core.percent(100);
                var axisTitle = topContainer.createChild(am4core.Label);
                axisTitle.text = 'Grafik '+namalbl;
                axisTitle.fontWeight = 600;
                axisTitle.align = "center";
                axisTitle.wrap = true;

                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "jumlah";
                pieSeries.dataFields.category = "barang";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chart.hiddenState.properties.radius = am4core.percent(0);
        });
}

function chart_data(namachart, hasil, namalbl){
        am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_dataviz);
                am4core.useTheme(am4themes_animated);
                // Themes end
                // Create chart instance
                var chart = am4core.create(namachart, am4charts.XYChart);
                // Add data
                chart.data = hasil;
                // Create axes
                var topContainer = chart.chartContainer.createChild(am4core.Container);
                topContainer.layout = "absolute";
                topContainer.toBack();
                topContainer.paddingBottom = 15;
                topContainer.width = am4core.percent(100);
                var axisTitle = topContainer.createChild(am4core.Label);
                axisTitle.text = 'Grafik Data '+namalbl;
                axisTitle.fontWeight = 600;
                axisTitle.align = "center";
                axisTitle.wrap = true;

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "tanggal";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.minGridDistance = 30;
                categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
                  if (target.dataItem && target.dataItem.index & 2 == 2) {
                    return dy + 25;
                  }
                  return dy;
                });
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                // Create series
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = "jumlah";
                series.dataFields.categoryX = "tanggal";
                series.name = "Jumlah";
                series.columns.template.tooltipText = namalbl+" {categoryX}: [bold]{valueY}[/]";
                series.columns.template.fillOpacity = .8;
                var columnTemplate = series.columns.template;
                columnTemplate.strokeWidth = 2;
                columnTemplate.strokeOpacity = 1;
        });
}
