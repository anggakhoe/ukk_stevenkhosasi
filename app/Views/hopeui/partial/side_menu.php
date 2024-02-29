<?php 

$uri = service('uri');

$db = \Config\Database::connect();
$builder = $db->table('website');
$logo = $builder->select('logo_website')
->where('deleted_at', null)
->get()
->getRow();

?>

<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
  <div class="sidebar-header d-flex align-items-center justify-content-start">

      <!-- <h4 class="logo-title">GT Playground</h4> -->
    </div>



    <!-- ------------------------------- MENU ADMIN ------------------------------------- -->

    <?php if (session()->get('level')==1){ ?>
      <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
          <!-- Sidebar Menu Start -->
          <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Home</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "dashboard"){echo "active";}?>" href="<?=base_url('dashboard')?>"><span class="item-name">Dashboard</span>
              </a>
            </li>

            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Master</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "user"){echo "active";}?>" href="<?=base_url('user')?>"><span class="item-name">Data User</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "data_level"){echo "active";}?>" href="<?=base_url('data_level')?>"><span class="item-name">Data Level</span>
              </a>
            </li>
            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Perpustakaan</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "KategoriBuku"){echo "active";}?>" href="<?=base_url('KategoriBuku')?>"><span class="item-name">Kategori Buku</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "buku"){echo "active";}?>" href="<?=base_url('buku')?>"><span class="item-name">Data Buku</span>
              </a>
            </li>

          <!-- <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(1) == "buku_digital"){echo "active";}?>" href="<?=base_url('buku_digital')?>"><i class="fa-regular fa-book"></i><span class="item-name">Data Buku Digital</span>
            </a>
          </li> -->

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(1) == "peminjaman" && $uri->getSegment(2) !== "menu_laporan"){echo "active";}?>" href="<?=base_url('peminjaman')?>"><span class="item-name">Data Peminjaman</span>
            </a>
          </li>

          <li><hr class="hr-horizontal"></li>
          <li class="nav-item static-item">
            <a class="nav-link static-item disabled" tabindex="-1">
              <span class="default-icon">Data Laporan</span>
              <!-- <span class="mini-icon">-</span> -->
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan" && $uri->getSegment(1) !== "pengembalian"){echo "active";}?>" href="<?=base_url('peminjaman/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Peminjaman</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(1) == "pengembalian"){echo "active";}?>" href="<?=base_url('pengembalian/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Pengembalian</span>
            </a>
          </li>

          <li class="nav-item mb-5"></li>

        </ul>
      </li>

    </ul>
  </div>
</div>




<!-- ------------------------------- MENU PETUGAS ------------------------------------- -->

<?php }else if (session()->get('level')==2){ ?>
  <div class="sidebar-body pt-0 data-scrollbar">
    <div class="sidebar-list">
      <!-- Sidebar Menu Start -->
      <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Home</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "dashboard"){echo "active";}?>" href="<?=base_url('dashboard')?>"><i class="faj-button fa-duotone fa-grid-2"></i><span class="item-name">Dashboard</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Perpustakaan</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "buku"){echo "active";}?>" href="<?=base_url('buku')?>"><span class="item-name">Data Buku</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "peminjaman" && $uri->getSegment(2) !== "menu_laporan"){echo "active";}?>" href="<?=base_url('peminjaman')?>"><span class="item-name">Data Peminjaman</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Laporan</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan" && $uri->getSegment(1) !== "pengembalian"){echo "active";}?>" href="<?=base_url('peminjaman/menu_laporan')?>"><span class="item-name">Laporan Peminjaman</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan" && $uri->getSegment(1) !== "peminjaman"){echo "active";}?>" href="<?=base_url('pengembalian/menu_laporan')?>"><span class="item-name">Laporan Pengembalian</span>
          </a>
        </li>

        <li class="nav-item mb-5"></li>

      </ul>
    </li>

  </ul>
</div>
</div>

<!-- ------------------------------- MENU PEMINJAM ------------------------------------- -->

<?php }else if (session()->get('level')==3){ ?>
  <div class="sidebar-body pt-0 data-scrollbar">
    <div class="sidebar-list">
      <!-- Sidebar Menu Start -->
      <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Home</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "dashboard"){echo "active";}?>" href="<?=base_url('dashboard')?>"><span class="item-name">Dashboard</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Perpustakaan</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "peminjaman_peminjam"){echo "active";}?>" href="<?=base_url('peminjaman_peminjam')?>"><span class="item-name">Data Peminjaman</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "buku"){echo "active";}?>" href="<?=base_url('buku')?>"><span class="item-name">Data Buku</span>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "buku_digital" && $uri->getSegment(2) == "peminjam"){echo "active";}?>" href="<?=base_url('buku_digital/peminjam')?>"><i class="fa-regular fa-book"></i><span class="item-name">Data Buku Digital</span>
          </a>
        </li> -->

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "koleksi_buku"){echo "active";}?>" href="<?=base_url('koleksi_buku')?>"><span class="item-name">Koleksi Buku</span>
          </a>
        </li>

      </ul>
    </li>

  </ul>
</div>
</div>


<?php } ?>