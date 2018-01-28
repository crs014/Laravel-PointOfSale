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
                            <h3>Grafik Penghasilan Laba Perbulan</h3>
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
                                    @foreach($data as $i => $item)
                                    <tr>
                                        <td>
                                            {{$item->day}} {{$months[$item->month]}} {{$item->year}}
                                        </td>
                                        <td>
                                            @if($item->total_sale == null)
                                                0
                                            @else
                                                {{$item->total_sale}}
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if($item->total_purchase == null)
                                                0
                                            @else
                                                {{$item->total_purchase}}
                                            @endif
                                        </td>
                                        <td>    
                                            @if($item->total_sale == null)
                                                <p style="color:red">
                                                    {{0 - $item->total_purchase}}
                                                <p>
                                            @elseif($item->total_purchase == null)
                                                <p style="color:green">
                                                    {{$item->total_sale - 0}}
                                                </p>
                                            @else
                                                @if($item->laba > 0)
                                                    <p style="color: green">
                                                        {{$item->laba}}
                                                    </p>
                                                @else
                                                    <p style="color: red">
                                                        {{$item->laba}}
                                                    </p>
                                                @endif
                                                
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>Total Penjualan Hari Ini : 
                                <b>{{$today_data['sale']}}</b>
                            </p>
                            <p>Total Pembelian Hari Ini : 
                               <b>{{$today_data['purchase']}}</b>
                            </p>
                            <p>Laba Hari Ini : <b>{{$today_data['sale'] - $today_data['purchase']}}</b></p>
                        </div>
                    </div>
                </div>  
            </div>    
        </section>
@endsection
@section('script')
<script type="text/javascript">
reportData();

function reportData() {
    $.ajax({
        url : "/home/chart",
        type : "POST",
        data : { '_method' : 'POST', '_token' : $('input[name=_token]').val() },
        success : function(data) {
            displayChart(data);
        },
        error : function() {
            alert("terjadi kesalahan pada pengambilan data");
        }
    });
}
    
function generateLabel(data) {
    var dataReturn = [];
    var months = ["","Jan","Feb","Mar","Apr","May","Jun","jul","Agu","Sep","Okt","Nov","Des"];
    for (var i = 0; i < data.length;i++) {
        dataReturn.unshift(months[data[i].month] + " " + data[i].year);
    }
    return dataReturn;
}

function generateData(data) {
    var dataReturn = [];
    for (var i = 0; i < data.length;i++) {
        dataReturn.unshift(data[i].laba);
    }
    return dataReturn;   
}

function displayChart(data) {
    var label = generateLabel(data);
    var dataBind = generateData(data);
    console.log(data);
    console.log(label);
    console.log(dataBind);
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: label,
            datasets: [
                {
                    label: "Laba",
                    backgroundColor: 'rgba(255, 99, 132,0)',
                    borderColor: 'blue',
                    data: dataBind,
                }
            ]
        },
        options: {}
    });
}
</script>
@endsection

