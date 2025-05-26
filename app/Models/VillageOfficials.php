<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageOfficials extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'image_url',
        'contact'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
