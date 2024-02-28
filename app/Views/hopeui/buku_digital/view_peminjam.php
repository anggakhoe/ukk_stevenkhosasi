 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

<!--             <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?=base_url('buku/create')?>" class="btn btn-primary"><i class="faj-button fa-solid fa-plus"></i>Tambah</a>
               </div>
            </div> -->

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Judul Buku</th>
                           <th>Cover Buku</th>
                           <th>Kategori Buku</th>
                           <th>Action</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riz->judul_buku ?></td>
                            <td>
                             <a href="<?= base_url('cover/' . $riz->cover_buku) ?>" target="_blank">
                              <img src="<?= base_url('cover/' . $riz->cover_buku) ?>" class="img-fluid" style="object-fit: cover; width: 95px; height: 140px;" alt="Cover Buku">
                           </a>
                        </td>
                        <td><?= $riz->nama_kategori ?></td>
                        <td>
                           <a href="<?= base_url('file_buku/' . $riz->file_buku) ?>" target="_blank" class="btn btn-secondary my-1"><i class="fa-brands fa-readme"></i></a>

                           <a href="<?php echo base_url('ulasan_buku/'. $riz->id_buku)?>" class="btn btn-primary my-1"><i class="fa-regular fa-comment" style="color: #ffffff;"></i></a>

                           <?php if ($riz->isLiked): ?>
                              <a href="<?php echo base_url('buku_digital/aksi_tambah_koleksi/'. $riz->id_buku)?>" class="btn btn-danger my-1"><i class="fa-solid fa-heart"></i></a>
                           <?php else: ?>
                              <a href="<?php echo base_url('buku_digital/aksi_tambah_koleksi/'. $riz->id_buku)?>" class="btn btn-success my-1"><i class="fa-regular fa-heart"></i></a>
                           <?php endif; ?>

                        </td>
                     </tr>
                  <?php } ?>
               </tbody>
              <!--  <tfoot>
                  <tr>
                     <th>No.</th>
                     <th>Foto</th>
                     <th>Username</th>
                     <th>Level</th>
                     <th style="min-width: 100px">Action</th>
                  </tr>
               </tfoot> -->

            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->