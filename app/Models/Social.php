<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Social extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name', 'icon', 'url'];

    // Function to upload the icon image
    public static function uploadIcon($file)
    {
        $path = $file->store('social_icons', 'public');
        return $path;
    }
}
