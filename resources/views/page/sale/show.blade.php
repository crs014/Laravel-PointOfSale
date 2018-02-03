@extends('layouts.app')

@section('content')
    <!-- Modal -->
  <div class="modal fade" id="modalPaid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bayar</h4>
                </div>
                <div class="modal-body">
                     <form class="form-horizontal" data-toggle="validator" method="post" action="{{ route('sales.paid',['id' => $sale->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="nama" class="col-md-3 control-label">Jumlah Pembayaran</label>
                            <div class="col-md-6">
                                <input id="amountInput" type="number" class="form-control" name="amount" min="1000" max="{{ $need_paid}}" required>
                                <span class="help-block with-errors"></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info btn-save" value="Simpan">
                                    <i class="fa fa-floppy-o"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pembelian Detail</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-default" href="{{ route('sales.index') }}">Kembali</a>
                <button class="btn btn-warning" onclick='printExternal("/sales/nota/{{$sale->id}}")'>
                    <i class=" fa fa-sticky-note-o"></i> Cetak Nota
                </button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalPaid">
                    <i class="fa fa-credit-card"></i> Bayar
                </button>
            </div>
            <div class="box-body">
                <h4>Nomor Nota : {{ $sale->sale_number }}</h4>
                <h4>Waktu Transaksi : {{ $sale->created_at }}</h4>
                <h4>Total : Rp. {{ $total}}</h4>
                <h4>Terbayar : Rp. {{ $paid }}</h4>
                <h4>Sisa Pembayaran : Rp. {{ $need_paid }}</h4>
                <h4>Status : 
                    @if($status == true)
                    <b style="color:green;">Lunas</b>
                    @else
                    <b style="color:red;">Belum Lunas</b>
                    @endif
                </h4>
                <br/>
                <table class="table table-bordered table-responsive table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Product</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->sale_details as $value)
                        <tr>
                            <td>{{ $value->product->code_product}}</td>
                            <td>{{ $value->product->categorie->name}}</td>
                            <td>Rp. {{ $value->sale_price }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>Rp. {{ $value->quantity * $value->sale_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>    
    </section>
@endsection
@section('script')
<script type="text/javascript">
function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
</script>
@endsection