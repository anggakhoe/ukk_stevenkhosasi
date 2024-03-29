<?php

namespace App\Controllers;
use App\Models\M_buku;

class Buku extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2  || session()->get('level') == 3) {
            $model = new M_buku();

            $on = 'buku.BukuID = kategoribuku_relasi.BukuID';
            $on2 = 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID';
            $data['jojo'] = $model->join3('buku', 'kategoribuku_relasi', 'kategoribuku', $on, $on2);

            $data['title'] = 'Menu Buku';
            $data['desc'] = 'Anda dapat memfilter Data Buku di Menu ini.';
            $data['subtitle'] = 'Filter Buku';

            $data['kategori'] = $model->tampil('kategoribuku');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/menu_buku', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function processForm()
    {
        if ($this->request->getMethod() === 'post') {
        // Ambil kategori yang dipilih dari form
            $kategoriID = $this->request->getPost('kategori');

        // Periksa level pengguna
            $level = session()->get('level');
            if ($level == 1 || $level == 2) {
            // Jika level adalah 1 atau 2, redirect ke public function view
                return redirect()->to(base_url("buku/view/$kategoriID"));
            } elseif ($level == 3) {
            // Jika level adalah 3, redirect ke public function peminjam
                return redirect()->to(base_url("buku/peminjam/$kategoriID"));
            } else {
            // Jika level tidak valid, lakukan tindakan yang sesuai, misalnya, redirect ke halaman lain atau tampilkan pesan kesalahan
                return redirect()->to('/');
            }
        }
    }

    public function view($kategoriID = null)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            if ($kategoriID) {
                $model = new M_buku();
                $data['jojo'] = $model->getBooksByCategory($kategoriID);
            } else {
                // Jika kategori tidak dipilih, tampilkan semua data buku
                $model = new M_buku();
                $on = 'buku.BukuID = kategoribuku_relasi.BukuID';
                $on2 = 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID';
                $data['jojo'] = $model->join3('buku', 'kategoribuku_relasi', 'kategoribuku', $on, $on2);
            }

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat melihat Data Buku di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function detail_buku($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2  || session()->get('level') == 3) {
            $model = new M_buku();

            $on = 'buku.BukuID = kategoribuku_relasi.BukuID';
            $on2 = 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID';
            $data['jojo'] = $model->join3id('buku', 'kategoribuku_relasi', 'kategoribuku', $on, $on2, $id);

            $data['title'] = 'Detail Buku';
            $data['desc'] = 'Anda dapat melihat Detail Buku di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view_detail', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat menambah Data Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Buku';

            $data['kategori'] = $model->tampil('KategoriBuku');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('judul');
            $b = $this->request->getPost('penulis');
            $c = $this->request->getPost('penerbit');
            $d = $this->request->getPost('tahun_terbit');
            $e = $this->request->getPost('kategori');
            $f = $this->request->getPost('stok_buku');

            $cover_buku = $this->request->getFile('cover_buku');

            if ($cover_buku->isValid() && !$cover_buku->hasMoved()) {
                $ext = $cover_buku->getClientExtension();

                $imageName = 'cover_' . session()->get('id') . '_' . time() . '.' . $ext;

                $cover_buku->move('cover', $imageName);
            } else {
                $imageName = 'default.jpg';
            }

            // Data yang akan disimpan
            $data1 = array(
                'Judul' => $a,
                'Penulis' => $b,
                'Penerbit' => $c,
                'TahunTerbit' => $d,
                'stok_buku' => $f,
                'cover_buku' => $imageName
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku', $data1);

            // Ambil PenjualanID dari data yang baru saja disimpan
            $idbuku = $model->insertID();

            $data2 = array(
                'BukuID' => $idbuku,
                'KategoriID' => $e
            );
            $model->simpan('kategoribuku_relasi', $data2);

            return redirect()->to('buku/view/' . $e);
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_buku();
            $where = array('BukuID' => $id);
            $data['jojo'] = $model->getWhere('buku', $where);

        // Ambil data kategori buku yang terkait dengan buku yang diedit
            $kategori_buku = $model->getWhere('kategoribuku_relasi', $where);

        // Jika data kategori buku ditemukan, ambil KategoriID-nya
            if ($kategori_buku) {
                $data['kategori_buku_id'] = $kategori_buku->KategoriID;
            } else {
            // Jika tidak ditemukan, set default nilai KategoriID menjadi null
                $data['kategori_buku_id'] = null;
            }

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat mengedit Data Buku di Menu ini.';      
            $data['subtitle'] = 'Edit Data Buku';  

            $data['kategori'] = $model->tampil('KategoriBuku');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/edit', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('judul');
            $b = $this->request->getPost('penulis');
            $c = $this->request->getPost('penerbit');
            $d = $this->request->getPost('tahun_terbit');
            $e = $this->request->getPost('kategori');
            $f = $this->request->getPost('stok_buku');
            $id = $this->request->getPost('id');

            $cover_buku = $this->request->getFile('cover_buku');

            if ($cover_buku->isValid() && !$cover_buku->hasMoved()) {
                $ext = $cover_buku->getClientExtension();

                $imageName = 'cover_' . session()->get('id') . '_' . time() . '.' . $ext;

                $cover_buku->move('profile', $imageName);
            } else {
                $imageName = $this->request->getPost('old_cover');
            }

            // Data yang akan disimpan
            $data1 = array(
                'Judul' => $a,
                'Penulis' => $b,
                'Penerbit' => $c,
                'TahunTerbit' => $d,
                'stok_buku' => $f,
                'cover_buku' => $imageName,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            $where = array('BukuID' => $id);
            $model = new M_buku();
            $model->qedit('buku', $data1, $where);

            $data2 = array(
                'KategoriID' => $e,
                'updated_at'=>date('Y-m-d H:i:s')
            );
            $model->qedit('kategoribuku_relasi', $data2, $where);

            return redirect()->to('buku');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();
            $model->deletee($id);
            return redirect()->to('buku');
        }else {
            return redirect()->to('/');
        }
    }


    // --------------------------------- STOK BUKU MASUK -----------------------------------------

    public function menu_stok($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku';
            $data['desc'] = 'Anda dapat melihat Stok Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/menu_stok', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function info_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku Masuk';
            $data['desc'] = 'Anda dapat melihat Stok Buku Masuk di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $where=array('BukuID'=>$id);
            $data['jojo']=$model->getWhere('buku',$where);

            $data['title'] = 'Data Stok Buku Masuk';
            $data['desc'] = 'Anda dapat menambah Stok Buku Masuk di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku Masuk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/add_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_masuk()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_buku');
            $c = $this->request->getPost('deskripsi');

            // Data yang akan disimpan
            $data1 = array(
                'buku_id' => $a,
                'stok_buku_masuk' => $b,
                'deskripsi' => $c
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku_masuk', $data1);

            return redirect()->to('buku/info_stok_masuk/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_masuk($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_buku();

        // Mengambil ID buku terkait dari stok buku masuk yang akan dihapus
            $stok_masuk = $model->getBukuMasukByIdBukuMasuk($id);
            $id_buku = $stok_masuk->buku_id;

        // Membuat kondisi untuk menghapus stok buku masuk
            $where = array('id_buku_masuk' => $id);
            $model->hapus('buku_masuk', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID buku yang diperoleh sebelumnya
            // return redirect()->to('buku');
            return redirect()->to('buku/info_stok_masuk/' . $id_buku);
        } else {
            return redirect()->to('/');
        }
    }

    // ---------------------------------- STOK BUKU KELUAR ---------------------------------------

    public function info_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuKeluarById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku Keluar';
            $data['desc'] = 'Anda dapat melihat Stok Buku Keluar di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $where=array('BukuID'=>$id);
            $data['jojo']=$model->getWhere('buku',$where);

            $data['title'] = 'Data Stok Buku Keluar';
            $data['desc'] = 'Anda dapat menambah Stok Buku Keluar di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku Keluar';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/add_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_keluar()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_buku');
            $c = $this->request->getPost('deskripsi');

            // Data yang akan disimpan
            $data1 = array(
                'buku_id' => $a,
                'stok_buku_keluar' => $b,
                'deskripsi'=>$c
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku_keluar', $data1);

            return redirect()->to('buku/info_stok_keluar/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_keluar($id)
    { 
     if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_buku();

        // Mengambil ID buku terkait dari stok buku masuk yang akan dihapus
        $stok_keluar = $model->getBukuKeluarByIdBukuMasuk($id);
        $id_buku = $stok_keluar->buku_id;

        // Membuat kondisi untuk menghapus stok buku masuk
        $where = array('id_buku_keluar' => $id);
        $model->hapus('buku_keluar', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID buku yang diperoleh sebelumnya
            // return redirect()->to('buku');
        return redirect()->to('buku/info_stok_keluar/' . $id_buku);
    } else {
        return redirect()->to('/');
    }
}

    // -------------------------------------- PEMINJAM --------------------------------------------

public function peminjam($kategoriID = null)
{
    if (session()->get('level') == 3) {
        $model = new M_buku(); // Gunakan model M_buku

        $idUser = session()->get('id');

        if ($kategoriID) {
            // Jika kategori dipilih, ambil data buku sesuai dengan kategori tersebut
            $data['jojo'] = $model->getBooksByCategory($kategoriID);
        } else {
            // Jika kategori tidak dipilih, tampilkan semua data buku
            $on = 'buku.BukuID = kategoribuku_relasi.BukuID';
            $on2 = 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID';
            $data['jojo'] = $model->join3('buku', 'kategoribuku_relasi', 'kategoribuku', $on, $on2);
        }

        // Tambahkan informasi apakah buku disukai atau tidak ke dalam data yang akan dikirimkan ke view
        if (!empty($data['jojo'])) { // Periksa apakah data buku ditemukan atau tidak
            foreach ($data['jojo'] as $riz) {
                $riz->isLiked = $model->isLiked($riz->BukuID, $idUser);
            }
        }

        $data['title'] = 'Data Buku';
        $data['desc'] = 'Anda dapat melihat Data Buku di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/buku/view_peminjam', $data);
        echo view('hopeui/partial/footer');
    } else {
        return redirect()->to('/');
    }
}

public function aksi_tambah_koleksi($id)
{ 
    if(session()->get('level') == 3) {
        $model = new M_buku();
        $idUser = session()->get('id');

            // Periksa apakah buku sudah ada dalam koleksi pengguna atau belum
        if (!$model->isLiked($id, $idUser)) {
            // Jika belum, tambahkan buku ke dalam koleksi
            $data1 = array(
                'UserID' => $idUser,
                'BukuID' => $id
            );
            $model->simpan('koleksipribadi', $data1);
        } else {
            // Jika sudah, hapus buku dari koleksi
            $model->hapusLike($id, $idUser);
        }

        // Arahkan pengguna kembali ke halaman koleksi buku
        return redirect()->to('buku/peminjam');
    } else {
        return redirect()->to('/');
    }
}
}