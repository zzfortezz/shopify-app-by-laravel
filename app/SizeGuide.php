<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeGuide extends Model
{
    protected $fillable = ['title', 'description', 'sizes', 'shop_domain'];
}
