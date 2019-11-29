<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit kata_isyarat</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_kata</label>
              <div class="col-sm-10">
                <input type="text" name="id_kata" class="form-control" placeholder="" value="<?php echo $dataedit->id_kata?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">arti_kata</label>
              <div class="col-sm-10">
                <input type="text" name="arti_kata" class="form-control" value="<?php echo $dataedit->arti_kata?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">url_gambar</label>
              <div class="col-sm-10">
                <input type="text" name="url_gambar" class="form-control" value="<?php echo $dataedit->url_gambar?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">id_kategori</label>
              <div class="col-sm-10">
                <input type="text" name="id_kategori" class="form-control" value="<?php echo $dataedit->id_kategori?>">
              </div>
              </div>

        </div>
        <input type="hidden" id="deleteFiles" name="deleteFiles">
        <div class="col-12">
          <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right">Simpan</button>
        </div>
      </form>
      </div>
    </section>
