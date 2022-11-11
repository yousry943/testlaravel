<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipFile extends Model
{    
    use HasFactory;

    protected $table = 'zip_files';

    protected $fillable = [
        'user_id',
        'zip_name',
        'zip_path',
        'Sizes',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
