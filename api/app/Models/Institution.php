<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $fillable = ['name', 'city', 'state', 'country'];

    public function students() {
        return $this->hasMany(Student::class);
    }
}
