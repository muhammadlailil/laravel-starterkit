<?php

namespace laililmahfud\starterkit\models;

use Illuminate\Database\Eloquent\Model;
use laililmahfud\starterkit\traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsModuls extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = false;
    protected $table = 'cms_moduls';
    protected $fillable = ['name', 'icon','path','parent_id','sorting','table','controller','route_prefix','type'];
}
