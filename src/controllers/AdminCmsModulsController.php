<?php
namespace Laililmahfud\Starterkit\controllers;


use App\Helpers\PAR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Laililmahfud\Starterkit\Helpers\Starterkit;
use Laililmahfud\Starterkit\helpers\JsonResponse;
use Laililmahfud\Starterkit\Request\CmsModulsRequest;

class AdminCmsModulsController extends Controller
{
    public function index(Request $request)
    {
        return sview('cms-moduls.index', [
            'page_title' => 'Module Generator',
            'table' => DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema  = '".env('DB_DATABASE')."' and table_name not like 'cms_%' and table_name not in ('migrations','personal_access_tokens')")
        ]);
    }

    public function loadColumns(Request $request,$table_name){
        $describeTable = DB::select("DESCRIBE {$table_name}");
        $tableColumns = Starterkit::getAllColumName($describeTable,[]);
        return JsonResponse::Oke($tableColumns);
    }

    public function save(CmsModulsRequest $request)
    {
        $request->save();
        return to_route('admin.cms-menus.index',['success_message'=>'Module has been saved']);
    }
}
