<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'level;'
    ];

    public function villageOfficials()
    {
        return $this->hasMany(VillageOfficials::class);
    }
}
