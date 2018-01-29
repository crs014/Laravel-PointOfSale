@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Laporan bulanan</h1>
        </section>
        <!-- Main content -->
        <section class="content"><!-- /.row -->
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive table-striped" id="table-report" width="100%">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Total Pembelian</th>
                                <th>Total Penjualan</th>
                                <th>Laba</th>
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
var table, saveMethod;
$(function(){
    table = $('#table-report').DataTable({
                processing: true,
                serverSide: true,
                paging : true,
                ajax: {
                    url : "{{ route('json.report_table') }}",
                    dataType : "JSON",
                    type : "POST",
                    data : { _token: "{{csrf_token()}}"}
                },
                columns : [
                    {
                        data : "year"
                    },
                    {
                        data : "month"
                    },
                    {
                        data : "total_purchase",
                        render : function(total, type, full, meta) {
                            if(total == null){
                                return 0;
                            }else{
                                return toRp(total);
                            }
                        }
                    },
                    {
                        data : "total_sale",
                        render : function(total, type, full, meta) {
                            if(total == null){
                                return 0;
                            }else{
                                return toRp(total);
                            }
                        }
                    },
                    {
                        data : "laba"
                    }
                ],
                columnDefs : [
                    {
                        render : function (data, type, row) {
                            if(row.total_purchase == null) { row.total_purchase = 0; }
                            if(row.total_sale == null) { row.total_sale = 0; }
                            var laba = row.total_sale - row.total_purchase;
                            if(laba == 0) {
                                return "<b>" + laba + "</b>";
                            }else if(laba > 0) {
                                return "<b style='color:green'>"+toRp(laba)+"</b>";
                            }else {
                                return "<b style='color:red'>"+toRp(laba)+"</b>";
                            }
                            
                        },
                        targets: 4
                    }
                ],
                order: [
                    [ 0, "desc" ],
                    [ 1, "desc" ]
                ]
            });
});
</script>
@endsection 
