<?php

namespace Laililmahfud\Starterkit\Models;

use Illuminate\Database\Eloquent\Model;
use Laililmahfud\Starterkit\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsUsers extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_users';
    protected $fillable = ['name', 'email','profile','password','cms_privileges_id','status'];
}
