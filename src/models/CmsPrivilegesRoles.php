<?php

namespace laililmahfud\starterkit\models;

use Illuminate\Database\Eloquent\Model;
use laililmahfud\starterkit\traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsPrivilegesRoles extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_privileges_roles';
    protected $fillable = ['cms_privileges_id', 'cms_moduls_id','can_view','can_edit','can_add','can_delete'];
}
