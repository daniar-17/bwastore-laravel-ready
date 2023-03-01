<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['nama','photo','slug'];
    protected $hidden = [];
    use HasFactory;
}
