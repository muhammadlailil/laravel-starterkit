<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use laililmahfud\starterkit\models\CmsNotification;

if (!function_exists('sview')) {
    function sview($view, $data = [])
    {
        return view('starterkit::module.' . $view, $data);
    }
}

if (!function_exists('urlNotif')) {
    function urlNotif($url)
    {
        if(str_contains($url,'http') || str_contains($url,'https')){
            return $url;
        }else{
            return url($url);
        }
    }
}

if (!function_exists('cmsNotification')) {
    function cmsNotification()
    {
        return CmsNotification::where('cms_users_id', auth_user()->id);
    }
}

if (!function_exists('aview')) {
    function aview($view, $data = [])
    {
        return view('module.admin.' . $view, $data);
    }
}

if (!function_exists('to_route')) {
    function to_route($route, $data = [])
    {
        return redirect()->route($route)->with($data);
    }
}

if (!function_exists('inputParams')) {
    function inputParams($exclude = [])
    {
        @$get = $_GET;
        $inputhtml = '';
        if ($get) {
            if (is_array($exclude)) {
                foreach ($exclude as $e) {
                    unset($get[$e]);
                }
            }
            $string_parameters = http_build_query($get);
            $string_parameters_array = explode('&', $string_parameters);
            foreach ($string_parameters_array as $s) {
                $part = explode('=', $s);
                $name = urldecode($part[0]);
                if ($name) {
                    $value = urldecode($part[1]);
                    $inputhtml .= "<input type='hidden' name='$name' value='$value'/>\n";
                }
            }
        }
        return $inputhtml;
    }
}

if (!function_exists('url_parameter')) {
    function url_parameter($removeparam = null)
    {
        $allparam = Request::all();
        $stringparam = "";
        foreach ($allparam as $name => $row) {
            if ($removeparam != $name) {
                $stringparam .= $name . '=' . $row . '&';
            }
        }
        return $stringparam;
    }
}

if (!function_exists('delete_file')) {
    function delete_file($url)
    {
        $url = str_replace('storage/', 'public/', $url);
        Storage::disk('local')->delete($url);
    }
}

if (!function_exists('delete_files')) {
    function delete_files($urls = [])
    {
        foreach ($urls as $url) {
            delete_file($url);
        }
    }
}

if (!function_exists('auth_user')) {
    function auth_user($key = null)
    {
        $user = session('admin_auth');
        if($user){
            if ($key) {
                return $user->{$key};
            }
            return $user;
        }else{
            return null;
        }
    }
}

if (!function_exists('assetUrl')) {
    function assetUrl($url)
    {
        if (Str::contains($url, ['http://', 'https://'])) {
            return $url;
        }
        return asset($url);
    }
}

if (!function_exists('getArrayValue')) {
    function getArrayValue($arr, $key)
    {
        return (isset($arr[$key]) ? $arr[$key] : null);
    }
}


if (!function_exists('convertMinuteTime')) {
    function convertMinuteTime($minutes){
        $minutes = intval($minutes);
        if ($minutes>0){
            if ($minutes){
                $minutes = $minutes*60;
                $zero    = new DateTime('@0');
                $offset  = new DateTime('@' . $minutes);
                $diff    = $zero->diff($offset);
                $hasil = $diff->format('%a d,%h h,%i m,%s s');
                $hasil = explode(",",$hasil);
                $converter = "";
                foreach ($hasil as $waktu){
                    $waktu = explode(" ",$waktu);
                    if (count($waktu)>=2){
                        $jumlah = intval($waktu[0]);
                        $ejaan = $waktu[1];
                        if ($jumlah>0){
                            if ($jumlah<9){
                                $jumlah = "0".$jumlah;
                            }
                            if($converter!=""){
                                $converter .= " ".$jumlah.$ejaan;
                            }else{
                                $converter .= $jumlah.$ejaan;
                            }
                        }
                    }
                }
                return $converter;
            }else{
                return "-";
            }
        }else{
            return "0";
        }
    }
}

if (!function_exists('limit_str')) {
    function limit_str($value, $limit = 100, $end = '...')
    {
        if(strlen($value)<=($limit)){
			return $value;
		} else {
			return substr($value,0,$limit). $end;
		}
    }
}

if(!function_exists('isSuperadmin')) {
    function isSuperadmin()
    {
        if (session('admin_is_superuser')) {
            return true;
        }
        return false;
    }
}

if(!function_exists('onlySuperadmin')) {
    function onlySuperadmin(){
        if (!isSuperadmin()) {
            abort(401);
        }
    }
}

if(!function_exists('canAccess')) {
    function canAccess()
    {
        if (isSuperadmin()) {
            return true;
        }

        $session = session('admin_access');
        $path = getModulePath();
        foreach ($session as $v) {
            if ($v->path == $path) {
                if(!(bool) $v->can_view){
                    abort(401);
                }
            }
        }
        return true;
    }
}

if(!function_exists('canAdd')) {
    function canAdd()
    {
        if (isSuperadmin()) {
            return true;
        }

        $session = session('admin_access');
        $path = getModulePath();
        foreach ($session as $v) {
            if(str_contains($path,$v->path)){
                if(! (bool) $v->can_add){
                    return false;;
                }
            }
        }
        return true;
    }
}


if(!function_exists('canDelete')) {
    function canDelete()
    {
        if (isSuperadmin()) {
            return true;
        }

        $session = session('admin_access');
        $path = getModulePath();
        foreach ($session as $v) {
            if(str_contains($path,$v->path)){
                if(! (bool) $v->can_delete){
                    return false;;
                }
            }
        }
        return true;
    }
}


if(!function_exists('canEdit')) {
    function canEdit()
    {
        if (isSuperadmin()) {
            return true;
        }

        $session = session('admin_access');
        $path = getModulePath();
        foreach ($session as $v) {
            if(str_contains($path,$v->path)){
                if(! (bool) $v->can_edit){
                    return false;;
                }
            }
        }
        return true;
    }
}


if(!function_exists('getModulePath')) {
    function getModulePath()
    {
        return Request::path();
    }
}

if(!function_exists('strslug')) {
    function strslug($slug)
    {
        return  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
    }
}

if(!function_exists('strslug')) {
    function strslug($slug)
    {
        return  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
    }
}

if(!function_exists('s_config')) {
    function s_config($key)
    {
        return config('starterkit.'.$key);
    }
}

if(!function_exists('min_var_export')) {
	function min_var_export($input) {
	    if(is_array($input)) {
	        $buffer = [];
	        foreach($input as $key => $value){
                $buffer[] = var_export($key, true)."=>".min_var_export($value);
            }
            // dd(implode(",",$buffer));
	        return "[".implode(",",$buffer)."]";
	    } else
	        return var_export($input, true);
	}
}