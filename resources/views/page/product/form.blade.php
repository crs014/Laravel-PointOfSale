<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" data-toggle="validator" method="post ">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times;</span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save" value="Simpan">
                        <i class="fa fa-floppy-o"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-arrow-circle-left"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
