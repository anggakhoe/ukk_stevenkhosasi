<?php

namespace App\Controllers;
use App\Models\M_user;

class User extends BaseController
{
    public function index()
    {
        if(session()->get('level')== 1) {
            $model=new M_user();
            $on='user.level=level.id_level';
            $data['jojo']=$model->join2('user', 'level', $on);

            $data['title']='Data User';
            $data['desc']='Anda dapat melihat Data User di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu', $data);
            echo view('hopeui/user/view', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');

        }
    }

    public function create()
    {
        if (session()->get('level') == 1) {
            $model=new M_user();

            $data['title']='Data User';
            $data['desc']='Anda dapat tambah Data User di Menu ini.'; 
            $data['subtitle'] = 'Tambah Data User';

            $data['level']=$model->tampil('level');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/user/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('username');
            $b = $this->request->getPost('password');
            $c = $this->request->getPost('email');
            $d = $this->request->getPost('nama_lengkap');
            $e = $this->request->getPost('alamat');
            $f = $this->request->getPost('level');

            $foto_profil = $this->request->getFile('foto_profil');

            if ($foto_profil->isValid() && !$foto_profil->hasMoved()) {
                $ext = $foto_profil->getClientExtension();

                $imageName = 'profile_' . session()->get('id') . '_' . time() . '.' . $ext;

                $foto_profil->move('profile', $imageName);
            } else {
                $imageName = 'default.png';
            }

            // Data yang akan disimpan
            $data1 = array(
                'Username' => $a,
                'Password' => md5($b),
                'Email' => $c,
                'NamaLengkap' => $d,
                'Alamat' => $e,
                'level' => $f,
                'foto' => $imageName
            );

            // Simpan data ke dalam database
            $model = new M_user();
            $model->simpan('user', $data1);

            return redirect()->to('user');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1) {
            $model=new M_user();
            $where=array('UserID'=>$id);
            $data['jojo']=$model->getWhere('user',$where);

            $data['title'] = 'Data User';
            $data['desc'] = 'Anda dapat mengedit Data User di Menu ini.';      
            $data['subtitle'] = 'Edit Data User';  

            $data['level'] = $model->tampil('level');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/user/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('username');
            $b = $this->request->getPost('password');
            $c = $this->request->getPost('email');
            $d = $this->request->getPost('nama_lengkap');
            $e = $this->request->getPost('alamat');
            $f = $this->request->getPost('level');
            $id = $this->request->getPost('id');

            $foto_profil = $this->request->getFile('foto_profil');

            if ($foto_profil->isValid() && !$foto_profil->hasMoved()) {
                $ext = $foto_profil->getClientExtension();

                $imageName = 'profile_' . $a . '_' . time() . '.' . $ext;

                $foto_profil->move('profile', $imageName);
            } else {
                $imageName = $this->request->getPost('old_foto');
            }

            // Data yang akan disimpan
            $data1 = array(
                'Username' => $a,
                'Password' => md5($b),
                'Email' => $c,
                'NamaLengkap' => $d,
                'Alamat' => $e,
                'level' => $f,
                'foto' => $imageName,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            // Simpan data ke dalam database
            $model = new M_user();
            $where=array('UserID'=>$id);
            $model->qedit('user', $data1, $where);

            return redirect()->to('user');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if(session()->get('level')== 1) {
            $model=new M_user();
            $model->deletee($id);
            return redirect()->to('user');
        }else {
            return redirect()->to('/');
        }
    }

}