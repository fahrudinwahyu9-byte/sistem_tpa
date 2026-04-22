<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_santri', 'umur', 'nama_wali', 'jilid_bacaan', 'user_id'])]
class Santri extends Model
{
    protected $table = 'santri';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
