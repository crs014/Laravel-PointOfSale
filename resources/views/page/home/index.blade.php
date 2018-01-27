@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Dashboard</h1>
        </section>
        <!-- Main content -->
        <section class="content"><!-- /.row -->
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Grafik Penghasilan Perbulan Bulan</h3>
                            <canvas id="myChart" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                            <h3>Lima Hari Terakhir Penjualan Dan Pembelian</h3>
                            <br>
                            <table class="table table-bordered table-responsive table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Total Penjualan</th>
                                        <th>Total Pembelian</th>
                                        <th>Laba</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>20 Januari 2018</td>
                                        <td>1922929</td>
                                        <td>151515</td>
                                        <td>11081094</td>
                                    </tr>
                                    <tr>
                                        <td>19 Januari 2018</td>
                                        <td>1922929</td>
                                        <td>151515</td>
                                        <td>11081094</td>
                                    </tr>
                                    <tr>
                                        <td>18 Januari 2018</td>
                                        <td>1922929</td>
                                        <td>151515</td>
                                        <td>11081094</td>
                                    </tr>
                                    <tr>
                                        <td>17 Januari 2018</td>
                                        <td>1922929</td>
                                        <td>151515</td>
                                        <td>11081094</td>
                                    </tr>
                                    <tr>
                                        <td>16 Januari 2018</td>
                                        <td>1922929</td>
                                        <td>151515</td>
                                        <td>11081094</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Total Penjualan Hari Ini : <b>12315616</b></p>
                            <p>Total Pembelian Hari Ini : <b>1220000</b></p>
                            <p>Laba Hari Ini : <b>129999</b></p>
                        </div>
                    </div>
                </div>  
            </div>    
        </section>
@endsection
@section('script')
<script type="text/javascript">
    function chartTest(){
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Penjualan",
                        backgroundColor: 'rgba(255, 99, 132,0)',
                        borderColor: '#333',
                        data: [10000, 100000, 50000, 20000, 200000, 300000, 450000],
                    },
                    {
                        label: "Pembelian",
                        backgroundColor: 'rgba(255, 99, 132,0)',
                        borderColor: 'blue',
                        data: [10000, 110000, 40000, 10000, 250000, 250000, 500000],
                    },
                ]
            },
            options: {}
        });
    }

    chartTest();
</script>
@endsection

