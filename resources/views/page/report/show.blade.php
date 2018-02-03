@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Laporan {{ $year }} {{ $month_indo }}</h1>
        </section>
        <!-- Main content -->
        <section class="content"><!-- /.row -->
            <div class="box box-primary">
                <div class="box-header">
                    <a class="btn btn-default" href="{{ route('report.index') }}">Kembali</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive table-striped" id="table-report" width="100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Total Pembelian</th>
                                <th>Total Penjualan</th>
                                <th>Laba</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $i => $item)
                            <tr>
                                <td>{{ $item->day }}</td>
                                <td>{{ to_rp($item->total_purchase) }}</td>
                                <td>{{ to_rp($item->total_sale) }}</td>
                                <td>
                                    @if($item->total_sale - $item->total_purchase >= 0)
                                        <b style="color:green"> 
                                            {{to_rp($item->total_sale - $item->total_purchase)}}
                                        </b>
                                    @else
                                        <b style="color:red"> 
                                            {{to_rp($item->total_sale - $item->total_purchase)}}
                                        </b>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>    
        </section>
@endsection


