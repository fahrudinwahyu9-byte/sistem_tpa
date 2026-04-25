<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_guru', 'jenis_kelamin', 'no_hp', 'alamat'])]
class Guru extends Model
{
    //
}
