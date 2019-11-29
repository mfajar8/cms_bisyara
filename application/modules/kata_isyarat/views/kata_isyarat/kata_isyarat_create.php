<section class="card">
      <div class="card-header">
        <h4 class="card-title">Tambah Data</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">arti_kata</label>
                <div class="col-sm-10">
                  <input type="text" name="arti_kata" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">url_gambar</label>
                <div class="col-sm-10">
                  <input type="text" name="url_gambar" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">id_kategori</label>
                <div class="col-sm-10">
                  <input type="text" name="id_kategori" class="form-control">
                </div>
              </div>
</div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right">Simpan</button>
        </div>
      </form>
      </div>
    </section>