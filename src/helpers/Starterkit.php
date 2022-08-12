<?php
namespace Laililmahfud\Starterkit\Helpers;


use App\Helpers\excel\ExportExcel;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;
use Laililmahfud\Starterkit\Models\CmsModuls;
use Laililmahfud\Starterkit\Models\CmsPrivilegesRoles;

class Starterkit
{
    public static function randomString($n){
        $characters = 'A0B1C2D3E4F5G6H7I8J9K2L2M7N8O8P3Q8R6S3T5U1V4W7X0Y5Zasbqwertyuiopasdfghjklzxcvbnm,';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
    public static function dateRangeFromString($dates, $index = 0)
    {
        if ($dates) {
            $dates = explode(' - ', $dates);
            return $dates[$index];
        } else {
            return null;
        }
    }
    public static function distinctMinutesTwoDate($start, $end)
    {
        $timeFirst = strtotime($start);
        $timeSecond = strtotime($end);
        $differenceInSeconds = $timeSecond - $timeFirst;
        $differenceInMinutess = $differenceInSeconds / 60;
        return round($differenceInMinutess);
    }
    public static function uploadFile($file, $loc = null)
    {
        $loc = $loc ?? date('Y-m');
        $path = $file->store('public/' . $loc);
        return str_replace('public/', 'storage/', $path);
    }

    public static function cmsModuls()
    {
        $parent = CmsModuls::orderBy('sorting')->whereNull('parent_id')->get();
        $subMenu = CmsModuls::orderBy('sorting')->whereNotNull('parent_id')->get();
        foreach ($parent as $row) {
            $row->subMenu = self::findMySubMenu($subMenu, $row->id);
        }
        return $parent;
    }

    public static function findMySubMenu($listSub, $id_parent)
    {
        $listmenu = [];
        foreach ($listSub as $row) {
            if ($row->parent_id == $id_parent) {
                $listmenu[] = $row;
            }
        }
        return $listmenu;
    }

    public static function urlFilterColumn($key, $value = '', $singleSorting = true)
    {
        $params = Request::all();
        $mainpath = trim(request()->url(), '/');
        $sortby = (isset($params['sortby'])) ? $params['sortby'] : null;

        if ($sortby && $singleSorting) {
            foreach ($params as $t => $val) {
                if ($t == 'sorting' || $t == 'sortby') {
                    unset($params[$t]);
                }
            }
        }
        $params['sortby'] = $key;
        $params['sorting'] = $value;

        return $mainpath . '?' . http_build_query($params);
    }

    public static function listAllModulsAndPrivilege($privilegeId = null)
    {
        $listmenurole = CmsModuls::whereNull('parent_id')->orderBy('sorting')->get();
        $listallsubmenu = CmsModuls::whereNotNull('parent_id')->orderBy('sorting')->get();
        $listallpriv = CmsPrivilegesRoles::where('cms_privileges_id', $privilegeId)->get();
        foreach ($listallsubmenu as $sub) {
            if (!$privilegeId) {
                $sub->can_view = 0;
                $sub->can_add = 0;
                $sub->can_edit = 0;
                $sub->can_delete = 0;
            } else {
                $sub->can_view = self::findAccessModuls($listallpriv, $sub->id, 'can_view');
                $sub->can_add = self::findAccessModuls($listallpriv, $sub->id, 'can_add');
                $sub->can_edit = self::findAccessModuls($listallpriv, $sub->id, 'can_edit');
                $sub->can_delete = self::findAccessModuls($listallpriv, $sub->id, 'can_delete');
            }
            $sub->sub_menu = [];
        }
        foreach ($listmenurole as $row) {
            if (!$privilegeId) {
                $row->can_view = 0;
                $row->can_add = 0;
                $row->can_edit = 0;
                $row->can_delete = 0;
            } else {
                $row->can_view = self::findAccessModuls($listallpriv, $row->id, 'can_view');
                $row->can_add = self::findAccessModuls($listallpriv, $row->id, 'can_add');
                $row->can_edit = self::findAccessModuls($listallpriv, $row->id, 'can_edit');
                $row->can_delete = self::findAccessModuls($listallpriv, $row->id, 'can_delete');
            }
            $row->sub_menu = self::findMySubMenu($listallsubmenu, $row->id);
        }
        return $listmenurole;
    }

    public static function listModulePrivilege($privilegeId, $is_superadmin = false)
    {
        if (!$is_superadmin) {
            $listmenurole = CmsPrivilegesRoles::join('cms_moduls', 'cms_moduls.id', 'cms_privileges_roles.cms_moduls_id')
                ->select('cms_moduls.*')
                ->where('cms_privileges_roles.can_view', 1)
                ->where('cms_privileges_roles.cms_privileges_id', $privilegeId)
                ->whereNull('cms_moduls.parent_id')->orderBy('cms_moduls.sorting')->get();
            $listallsubmenu = CmsPrivilegesRoles::join('cms_moduls', 'cms_moduls.id', 'cms_privileges_roles.cms_moduls_id')
                ->select('cms_moduls.*')
                ->where('cms_privileges_roles.can_view', 1)
                ->where('cms_privileges_roles.cms_privileges_id', $privilegeId)
                ->whereNotNull('cms_moduls.parent_id')->orderBy('cms_moduls.sorting')->get();
        } else {
            $listmenurole = CmsModuls::whereNull('parent_id')->orderBy('sorting')->get();
            $listallsubmenu = CmsModuls::whereNotNull('parent_id')->orderBy('sorting')->get();
        }
        foreach ($listmenurole as $row) {
            $row->sub_menu = self::findMySubMenu($listallsubmenu, $row->id);
        }
        return $listmenurole;
    }

    public static function listPrivilegeRoles($privilegeId, $is_superadmin = false)
    {
        if (!$is_superadmin) {
            $listmenurole = CmsPrivilegesRoles::join('cms_moduls', 'cms_moduls.id', 'cms_privileges_roles.cms_moduls_id')
                ->where('cms_privileges_roles.can_view', 1)
                ->select('cms_moduls.*')
                ->orderBy('cms_moduls.sorting')->get();
        } else {
            $listmenurole = CmsModuls::whereNull('parent_id')->orderBy('sorting')->get();
        }

        $listallpriv = CmsPrivilegesRoles::where('cms_privileges_id', $privilegeId)->get();
        foreach ($listmenurole as $row) {
            $row->can_view = self::findAccessModuls($listallpriv, $row->id, 'can_view');
            $row->can_add = self::findAccessModuls($listallpriv, $row->id, 'can_add');
            $row->can_edit = self::findAccessModuls($listallpriv, $row->id, 'can_edit');
            $row->can_delete = self::findAccessModuls($listallpriv, $row->id, 'can_delete');
        }
        return $listmenurole;
    }

    private static function findAccessModuls($listpriv, $menu, $key)
    {
        foreach ($listpriv as $priv) {
            if ($priv->cms_moduls_id == $menu) {
                return $priv->{$key};
            }
        }
        return 0;
    }

    public static function exportData($data = [])
    {
        // ini_set('memory_limit', '10M');
        set_time_limit(180);


        $filetype = $data['fileformat'];
        $filename = $data['filename'];
        $papersize = (isset($data['papersize']) ? $data['papersize'] : 'Letter');
        $paperorientation = (isset($data['page_orientation']) ? $data['page_orientation'] : 'potrait');
        $view = $data['view'];
        $dataResponse = $data['data'];

        switch ($filetype) {
            case "pdf":
                $view = view($view, $dataResponse)->render();
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML($view);
                $pdf->setPaper($papersize, $paperorientation);

                return $pdf->stream($filename . '.pdf');
                break;
            case 'xls':
                $export = new ExportExcel();
                $export->setView($view);
                $export->setData($dataResponse);
                return Excel::download($export, $filename . '.xls');
                break;
            case 'xlsx':
                $export = new ExportExcel();
                $export->setView($view);
                $export->setData($dataResponse);
                return Excel::download($export, $filename . '.xlsx');
                break;
            case 'csv':
                $export = new ExportExcel();
                $export->setView($view);
                $export->setData($dataResponse);
                return Excel::download($export, $filename . '.csv');
                break;
            default:
                return null;

        }
    }

    public static function getAllColumName($describe,$exclude=['id','created_at','updated_at']){
        $columns = [];
        foreach ($describe as $key => $value) {
           if(!in_array($value->Field, $exclude)){
            $columns[] = $value->Field;
           }
        }
        return $columns;
    }

}