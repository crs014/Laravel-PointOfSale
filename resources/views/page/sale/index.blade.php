@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Penjualan</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-success" href="{{ route('sales.create') }}"><i class="fa fa-plus-circle"></i> Tambah</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-striped" id="table-sale" width="100%">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Telepon</th>
                                <th>Nama Customer</th>
                                <th>Tanggal Waktu</th>
                                <th>Total</th>
                                <th>Terbayar</th>
                                <th>Sisa Pembayaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                <div class="table-responsive">
            </div> 
        </div>    
    </section>
@endsection
@section('script')
<script type="text/javascript">
var table, saveMethod;
$(function(){
    table = $('#table-sale').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.sale_table') }}",
                    dataType : "JSON",
                    type : "POST",
                    data : { _token: "{{csrf_token()}}"}
                },
                columns : [
                    {
                        data : "number"
                    },
                    {
                        data : "phone"
                    },
                    {
                        data : "name"
                    },
                    {
                        data : "datetime"
                    },
                    {
                        data : "total",
                        render : function(total, type, full, meta){
                            return toRp(total);
                        }
                    },
                    {
                        data : "paid",
                        render : function(paid, type, full, meta){
                            if(paid == null) {
                                paid = 0;
                            }
                            return toRp(paid);
                        }
                    },
                    {
                        data : "id"
                    },
                    {
                        data : "id"
                    },
                    {
                        data : 'id',
                        searchable : false,
                        sortable : false,
                        render : function(id, type, full, meta) {
                            @if(Auth::user()->role == 1)
                                 return "<a href='/sales/"+ id +"' class='btn btn-info'><i class='fa fa-info-circle'>"+
                                    "</i> Detail</a> "+
                                    "<a onclick='deleteData(" + id + ")' class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</a>";
                            @else
                                return  "<a href='/sales/"+ id +"' class='btn btn-info'><i class='fa fa-info-circle'>"+
                                    "</i> Detail</a> ";
                            @endif
                        }
                    }
                ],
                columnDefs : [
                    {
                        render : function (data, type, row) {
                            var data = row.total - row.paid 
                            return toRp(data);
                            
                        },
                        targets: 6
                    },
                    {
                        render : function (data, type, row) {
                            var data = "<b style='color:red'>belum lunas</b>";
                            if(row.total == row.paid) {
                                data = "<b style='color:green'>lunas</b>";
                            }

                            return data;                            
                        },
                        targets: 7
                    },
                    { visible: false,  targets: [5] }
                  
                ],
                order: [[ 3, "desc" ]]
            });
});


function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
        $.ajax({
            url : "/sales/" + id + "/delete",
            type : "POST",
            data : { '_method' : 'DELETE', '_token' : $('input[name=_token]').val() },
            success : function(data) {
                table.ajax.reload();
            },
            error : function() {
                alert("Tidak dapat menghapus data");
            }
        });
    }
}

</script>
@endsection 