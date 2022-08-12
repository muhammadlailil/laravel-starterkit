<?php

namespace Laililmahfud\Starterkit\Models;

use Illuminate\Database\Eloquent\Model;
use Laililmahfud\Starterkit\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsPrivileges extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_privileges';
    protected $fillable = ['name', 'is_superadmin'];
}
