@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pembelian</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-success" href="{{ route('purchases.create') }}"><i class="fa fa-plus-circle"></i> Tambah</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-striped" id="table-purchase" width="100%">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Tanggal waktu</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>    
    </section>
@endsection
@section('script')
<script type="text/javascript">
var table, saveMethod;
$(function(){
    table = $('#table-purchase').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.purchase_table') }}",
                    dataType : "JSON",
                    type : "POST",
                    data : { _token: "{{csrf_token()}}"}
                },
                columns : [
                    {
                        data : "number"
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
                        data : 'id',
                        searchable : false,
                        sortable : false,
                        render : function(id, type, full, meta) {
                            return "<a href='/purchases/"+ id +"' class='btn btn-info'><i class='fa fa-info-circle'>"+
                                    "</i> Detail</a> "+
                                    "<a onclick='deleteData(" + id + ")' class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</a>";
                        }
                    }
                ]
            });
});


function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
        $.ajax({
            url : "/purchases/" + id + "/delete",
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