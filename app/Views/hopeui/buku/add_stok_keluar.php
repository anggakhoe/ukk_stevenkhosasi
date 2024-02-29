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
                  <form action="<?= base_url('buku/aksi_add_stok_keluar')?>" method="post" enctype="multipart/form-data">

                     <input type="hidden" name="id" value="<?php echo $jojo->BukuID ?>">
                     
                     <div class="row">

                        <div class="form-group">
                           <label class="form-label" for="fname">Stok Buku Keluar <small class="text-danger text-sm">*</small></label></label>
                           <input type="text" class="form-control" id="stok_buku" name="stok_buku" placeholder="Masukkan Jumlah Buku Keluar" required>
                        </div>

                        <div class="form-group">
                           <label class="form-label" for="fname">Deskripsi <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" required>
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