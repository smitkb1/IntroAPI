<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $fillable = ['name', 'city', 'state', 'country',];

    protected $appends = ['students_count'];

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function getStudentsCountAttribute() {
        return $this->students()->count();
    }
}
