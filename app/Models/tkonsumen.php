<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tkonsumen extends Model
{
    protected $table = 'tkonsumens';
    protected $fillable = [
        'user_id',
        'nama_konsumen', // Keeping this for backward compatibility if needed, but primary is User name
        'email', // Keeping for backward compatibility
        'nomor_telepon',
        'alamat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
