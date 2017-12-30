@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pembelian Detail</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-default" href="{{ route('purchases.index') }}">Kembali</a>
                <a class="btn btn-warning" href="#"><i class=" fa fa-sticky-note-o"></i> Cetak Nota</a>
            </div>
            <div class="box-body">
                <h4>Nomor Nota : {{ $purchase->purchase_number }}</h4>
                <h4>Waktu Transaksi : {{ $purchase->created_at }}</h4>
                <h4>Total : Rp. {{ $total}}
                </h4>
                <br/>
                <table class="table table-bordered table-responsive table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Product</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase->purchase_details as $value)
                        <tr>
                            <td>{{ $value->product->code_product}}</td>
                            <td>{{ $value->product->categorie->name}}</td>
                            <td>Rp. {{ $value->purchase_price }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>Rp. {{ $value->quantity * $value->purchase_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>    
    </section>
@endsection