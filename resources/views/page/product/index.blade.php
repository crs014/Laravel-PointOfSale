@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Produk</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-success" onclick="addProduct()"><i class="fa fa-plus-circle"></i> Tambah</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-responsive table-striped" id="table-product" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div> 
        </div>    
    </section>
    @include('page.product.form')
@endsection
@section('script')
<script type="text/javascript">
var table, saveMethod;
$(function(){
    table = $('#table-product').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.product_table') }}",
                    dataType : "JSON",
                    type : "POST",
                    data : { _token: "{{csrf_token()}}"}
                },
                columns : [
                    {
                        data : "code_product"
                    },
                    {
                        data : "categorie"
                    },
                    {
                        data : "sale_price"
                    },
                    {
                        data : 'id',
                        searchable : false,
                        sortable : false,
                        render : function(id, type, full, meta) {
                            return "<a onclick='editForm(" + id + ")' class='btn btn-primary'><i class='fa fa-pencil'>"+
                                    "</i> Edit</a> "+
                                    "<a onclick='deleteData(" + id + ")' class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</a>";
                        }
                    }
                ]
            });
});


function addProduct(){
    saveMethod = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Produk');
}

function editForm(id) {
    saveMethod = "edit";
    $('input[name=_method]').val('PUT');
    $('#modal-form form')[0].reset();
    $.ajax({
        url : "/products/" + id + "/edit",  
        type : "GET",
        dataType : "JSON",
        success : function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Produk');
            $('#id').val(data.id);
            $('#code').val(data.code_product);
            $('#price').val(data.sale_price);
            $('#categorie').val(data.categorie_id);
        },
        error : function() {
            alert("Tidak Dapat Menampilkan Data");
        }
    });
}

function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
        $.ajax({
            url : "/products/" + id + "/delete",
            type : "POST",
            data : { '_method' : 'DELETE', '_token' : $('input[name=_token]').val() },
            success : function(data) {
                table.ajax.reload();
            },
            error : function() {
                alert("Tidak dapat menghapus data" + test);
            }
        });
    }
}

$(function(){
    $('#modal-form form').validator().on('submit', function(e){
        if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            if(saveMethod == "add"){
                url = "{{ route('products.store') }}";    
            }
            else {
                url = "/products/" + id + "/edit";
            }
            $.ajax({
                url : url,
                type : "POST",
                data : $('#modal-form form').serialize(),
                success : function(data) {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                },
                error : function() {
                    alert("tidak dapat menyimpan data!");
                }
            });
            return false;
        }
    });
});
</script>
@endsection 