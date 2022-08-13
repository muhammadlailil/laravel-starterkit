<?php

namespace laililmahfud\starterkit\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use laililmahfud\starterkit\traits\Uuid;

class CmsUsers extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_users';
    protected $fillable = ['name', 'email', 'profile', 'password', 'cms_privileges_id', 'status'];
}
