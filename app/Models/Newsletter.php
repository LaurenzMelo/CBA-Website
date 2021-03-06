<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function newsletter_images()
    {
        return $this->hasMany(NewsletterImage::class);
    }
}
