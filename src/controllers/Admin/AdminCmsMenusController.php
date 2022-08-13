<?php
namespace laililmahfud\starterkit\controllers\Admin;


use App\Helpers\PAR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use laililmahfud\starterkit\helpers\Starterkit;
use laililmahfud\starterkit\request\CmsMenusRequest;

class AdminCmsMenusController extends Controller
{
    public function index(Request $request)
    {
        return sview('cms-menus.index', [
            'page_title' => 'Menu Management',
            'data' => Starterkit::cmsModuls(),
            'table' => DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema  = '".env('DB_DATABASE')."' and table_name not like 'cms_%' and table_name not in ('migrations','personal_access_tokens')")
        ]);
    }

    public function save(CmsMenusRequest $request)
    {
        $request->save();
        return to_route('admin.cms-moduls',['success_message'=>'Menus has been saved']);
    }

    public function sortingMenus(CmsMenusRequest $request){
        return $request->sortingMenus();
    }
}
