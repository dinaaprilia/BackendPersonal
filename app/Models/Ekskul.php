<?php

// app/Models/Ekskul.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $fillable = ['name', 'mentor', 'image', 'description'];
        // 👇 Tambahkan relasi ini
    public function achievements()
    {
        return $this->hasMany(\App\Models\Achievement::class);
    }
    public function informasiEkskul()
{
    return $this->hasMany(\App\Models\InformasiEkskul::class);
}

}
