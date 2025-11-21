<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LetterRequest extends Model
{
    use HasFactory, HasUlids, Notifiable;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'letter_type_id',
        'nik',
        'rt',
        'ktp',
        'no_kk',
        'rw',
        'address',
        'gender',
        'marriage',
        'city',
        'work',
        'place_of_birth',
        'citizenship',
        'religion',
        'father_name',
        'mother_name',
        'status',
        'purpose',
        'file'
    ];

    public function letter_type() {
        return $this->belongsTo(LetterType::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
