<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'nama',
        'email',
        'phone',
        'hobby'
    ];

    public function hobby()
    {
        return $this->hasMany(Hobby::class);
    }
}
