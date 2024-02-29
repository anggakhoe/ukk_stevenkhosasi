<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
                  <small class="text-danger text-sm">* Data yang Wajib Diisi</small>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('KategoriBuku/aksi_create')?>" method="post">
                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Nama Kategori <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="NamaKategori" name="NamaKategori" placeholder="Masukkan Nama Kategori" required>
                        </div>
                     </div>
                     <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
                     <button type="submit" class="btn btn-primary mt-4">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>