<?php

namespace laililmahfud\starterkit\models;

use Illuminate\Database\Eloquent\Model;
use laililmahfud\starterkit\traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsPrivileges extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_privileges';
    protected $fillable = ['name', 'is_superadmin'];
}
