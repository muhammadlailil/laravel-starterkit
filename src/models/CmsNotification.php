<?php

namespace Laililmahfud\Starterkit\Models;

use Illuminate\Database\Eloquent\Model;
use Laililmahfud\Starterkit\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsNotification extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'cms_notification';
    protected $fillable = ['description', 'is_read', 'detail','url','cms_users_id'];
}
