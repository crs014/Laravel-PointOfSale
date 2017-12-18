@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kategori</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
                <a class="btn btn-success" onclick="addCategorie()"><i class="fa fa-plus-circle"></i> Tambah</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-responsive table-striped" id="table-categorie" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div> 
        </div>    
    </section>
    @include('page.categorie.form')
@endsection
@section('script')
<script type="text/javascript">
var table, saveMethod;
$(document).ready(function(){
    table = $('#table-categorie').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.categorie_table') }}",
                    dataType : "JSON",
                    type : "GET"
                },
                columns : [
                    {
                        data : "name"
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


function addCategorie(){
    saveMethod = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Kategori');
}

function editForm(id) {
    saveMethod = "edit";
    $('input[name=_method]').val('PUT');
    $('#modal-form form')[0].reset();
    $.ajax({
        url : "/categories/" + id + "/edit",  
        type : "GET",
        dataType : "JSON",
        success : function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Kategori');
            $('#id').val(data.id);
            $('#name').val(data.name);
        },
        error : function() {
            alert("Tidak Dapat Menampilkan Data");
        }
    });
}

function deleteData(id) {
    if(confirm("Apakah yakin data akan dihapus?")) {
        $.ajax({
            url : "/categories/" + id + "/delete",
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
                url = "{{ route('categories.store') }}";    
            }
            else {
                url = "/categories/" + id + "/edit";
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