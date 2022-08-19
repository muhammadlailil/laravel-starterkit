<?php
namespace laililmahfud\starterkit\controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use laililmahfud\starterkit\models\CmsNotification;
use laililmahfud\starterkit\request\CmsNotificationRequest;

class AdminCmsNotificationController extends Controller
{
    private $page_title = 'Notification';
    
    public function index(CmsNotificationRequest $request)
    {
        return sview('cms-notification.index', [
            'page_title' => $this->page_title,
            'columns' => $request->columns(),
            'data' => $request->dataTable(),
        ]);
    }

    public function read(Request $request,$id){
        $notif = CmsNotification::findOrFail($id);
        $notif->is_read = 1;
        $notif->save();
        return redirect(urlNotif($notif->url));
    }

}
