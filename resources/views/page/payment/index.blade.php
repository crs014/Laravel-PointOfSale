@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>History Pembayaran</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <table class="table table-bordered table-responsive table-striped" id="table-payment" width="100%">
                    <thead>
                        <tr>
                            <th>Jumlah</th>
                            <th>Nomor Penjualan</th>
                            <th>tanggal waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div> 
        </div>    
    </section>
@endsection
@section('script')
<script type="text/javascript">
var table;
$(function(){
    table = $('#table-payment').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.payment_table') }}",
                    dataType : "JSON",
                    type : "POST",
                    data : { _token: "{{csrf_token()}}"}
                },
                columns : [
                    {
                        data : "amount",
                        render : function(amount, type, full, meta) {
                            return toRp(amount);
                        }
                    },
                    {
                        data : "number",
                        render : function(number, type, full, meta) {
                            return number;
                        }
                    },
                    {
                        data : "datetime"
                    }
                ],
                order: [[ 2, "desc" ]]
            });
});
</script>
@endsection 