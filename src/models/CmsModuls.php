<?php

namespace Laililmahfud\Starterkit\Models;

use Illuminate\Database\Eloquent\Model;
use Laililmahfud\Starterkit\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsModuls extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_moduls';
    protected $fillable = ['name', 'icon','path','parent_id','sorting','table','controller','route_prefix','type','module_action'];
}
