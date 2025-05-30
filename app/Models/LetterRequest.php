<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter_type_id',
        'nik',
        'address',
        'gender',
        'place_of_birth',
        'citizenship',
        'religion',
        'father_name',
        'mother_name',
        'status',
    ];

    public function letter_type() {
        return $this->belongsTo(LetterType::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
