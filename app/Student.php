<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
        'name',
        'admission_date',
        'email',
        'faculty',
        'major',
        'country',
        'filename',
        'file_original_name',
        'selected_subjects'
    ];

}
