<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim', 'nama', 'foto_diri', 'foto_ktp'];

    // protected $validationRules = [
    //     'nim' => 'required|min_length[3]',
    //     'nama' => 'required|min_length[3]',
    //     'foto_diri' => 'uploaded[foto_diri]|max_size[foto_diri,20000]|is_image[foto_diri]',
    //     'foto_ktp' => 'uploaded[foto_ktp]|max_size[foto_ktp,20000]|is_image[foto_ktp]'
    // ];

    // function cari($katakunci)
    // {
    //     $builder = $this->table("mahasiswa");
    //     $arr_katakunci = explode(" ", $katakunci);
    //     for ($x = 0; $x < count($arr_katakunci); $x++) {
    //         $builder->orLike('nama', $arr_katakunci[$x]);
    //         $builder->orLike('nim', $arr_katakunci[$x]);
    //     }
    //     return $builder;
    // }
}
