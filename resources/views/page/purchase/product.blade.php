<div id="productModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">List Barang</h4>
            </div>
            <div class="modal-body">
                <div id="modal-form">
                    <form class="form-horizontal" data-toggle="validator" method="post">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="nama" class="col-md-3 control-label">Kode Produk</label>
                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" required>
                                <span class="help-block with-errors"></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-3 control-label">Kategori Produk</label>
                            <div class="col-md-6">
                                <select id="categorie" type="text" class="form-control" name="categorie" required>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                                </select>
                                <span class="help-block with-errors"></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-3 control-label">Harga Jual</label>
                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control" name="price" min="1" max="100000000" required>
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
                <br>
                <br>
                <table class="table table-bordered table-responsive table-striped" id="table-product" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th>Stock Masuk</th>
                            <th>Stock Keluar</th>
                            <th>Sisa Stock</th>
                            <th>Tanggal Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>