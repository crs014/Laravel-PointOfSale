@extends('layouts.app')

@section('content')


 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Input Pembelian</h1>
    </section>
    <!-- Main content -->
    <section class="content"><!-- /.row -->
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <form action="/purchases/create" method="post">
                    <button type="button" data-toggle="modal" data-target="#productModal" class="btn btn-success">
                        <i class="fa fa-plus-circle"></i> Add item
                    </button>
                    <br/><br/>
                    <table class="table table-bordered table-responsive table-striped" id="table-cart">
                        <thead>
                            <tr>
                                <th>Kode Produk</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        <thead>
                        <tbody id="cart-list">
                        </tbody>
                    </table>
                    <p>Total : Rp <b id="allTotal">0</b></p>
                    <button type="submit" class="btn btn-info" style="float: right;">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        Simpan 
                    </button>
                    {{ csrf_field() }}
                </form>
            </div> 
        </div>    
    </section>
    @include('page.purchase.product')
@endsection
@section('script')
<script type="text/javascript">
var table;
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
                        data : "code_product",
                        render : function(code, type, full, meta) {
                            return "<p class='code'>"+code+"</p>";
                        }
                    },
                    {
                        data : "sale_price",
                        render : function(price, type, full, meta) {
                            return "<p class='price'>"+price+"</p>";
                        }
                    },
                    {
                        data : "categorie",
                        render : function(categorie, type, full, meta) {
                            return "<p class='categorie'>"+categorie+"</p>";
                        }
                    },
                    {
                        data : "stock_in",
                        render : function(stock, type, full, meta) {
                            if(stock == null){
                                return 0;
                            }else{
                                return stock;
                            }
                        }
                    },
                    {
                        data : "stock_out",
                        render : function(stock, type, full, meta) {
                            if(stock == null){
                                return 0;
                            }else{
                                return stock;
                            }
                        }
                    },
                    {
                        data : 'id',  
                    },
                    {
                        data : 'id',
                        searchable : false,
                        sortable : false,
                        render : function(id, type, full, meta) {
                            return "<button type='button' class='btn btn-primary addItem' data-dismiss='modal' onclick='addItem(this)'>Add item</button>"+
                            "<input type='hidden' class='item-id' value="+id+">";
                        }
                    }
                ],
                columnDefs : [
                    {
                        render : function (data, type, row) {
                            if(row.stock_in == null || row.stock_in < 0) {
                                row.stock_in = 0;
                            }
                            if(row.stock_out == null || row.stock_out < 0){
                                row.stock_out = 0;
                            }
                            return row.stock_in - row.stock_out;
                            
                        },
                        targets: 5
                    },
                    { visible: false,  targets: [ 3,4 ] }
                ]
            });

       
    });
    
    function addItem(param){
        var found = false;
        var tr = $(param).parent().parent();
        var code = tr.find(".code").text();
        var categorie = tr.find(".categorie").text();
        var price = tr.find(".price").text();
        var itemId = tr.find(".item-id").val();
        var col_code = "<tr><td>"+code+"</td>";
        var col_categorie = "<td>"+ categorie +"</td>";
        var col_price = "<td><input type='number' value='0' min='1000' class='price' name='price[]' onchange='findSubtotal(this)'></td>";
        var quantity = "<td><input type='number' class='quantity' name='quantity[]' value='1' min='1' onchange='findSubtotal(this)'></td>";
        var col_subtotal = "<td class='sub-total'>0</td>";
        var col_itemId = "<td><input name='product[]' class='product-id' type='hidden' value='"+itemId+"'/>";
        var action = "<button type='button' class='btn btn-danger remove-item' onclick='removeItem(this)'><i class='fa fa-trash'></i> Remove</button></td></tr>";
        $(".product-id").each(function(){
            var cartItem = $(this).val();
            if(cartItem == itemId){
                found = true;
            }
                  
        });

        if(found == false){
            $("#cart-list").append(col_code + col_categorie + col_price + quantity + col_subtotal + col_itemId + action);
        }
        else{
            found = false;   
        }
        allTotal();
        
    }    

    function removeItem(param){
        var tr = $(param).parent().parent();
        tr.remove();
        allTotal();
    }

    function findSubtotal(param) {
        var tr = $(param).parent().parent();
        var price = tr.find(".price").val();
        var quantity = tr.find(".quantity").val();
        var subtotal = parseFloat(price) * parseFloat(quantity);
        tr.find('.sub-total').text(subtotal);  
        allTotal();
    }

    function allTotal() {
        var total = 0;
        var amount;
        $(".sub-total").each(function(){
            amount = parseFloat($(this).text());
            if(isNaN(amount)){
                amount = 0;
            }
            total += amount;
        });
        $("#allTotal").text(total);
    }
 
</script>
@endsection 