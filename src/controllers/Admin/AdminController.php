<?php

namespace laililmahfud\starterkit\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use laililmahfud\starterkit\models\CmsUsers;
use laililmahfud\starterkit\helpers\Starterkit;

class AdminController extends Controller
{
    public function getLogin(Request $request)
    {
        if(auth_user()){
            return to_route('admin.index');
        }
        return view(config('starterkit.admin_login_view'),[
            'page_title' => 'Login'
        ]);
    }

    public function postLogin(Request $request){
        $user = CmsUsers::join('cms_privileges', 'cms_privileges.id', 'cms_users.cms_privileges_id')
            ->select('cms_users.*', 'cms_privileges.name as role','cms_privileges.is_superadmin')
            ->whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session()->put('admin_auth', $user);
            session()->put('admin_is_superuser', $user->is_superadmin);
            session()->put('admin_moduls', Starterkit::listModulePrivilege($user->cms_privileges_id,$user->is_superadmin));
            session()->put('admin_access', Starterkit::listPrivilegeRoles($user->cms_privileges_id,$user->is_superadmin));
            return to_route('admin.index');
        }
        return to_route('admin.login', ['auth_message' => 'Email atau password salah/tidak ditemukan']);
    }

    public function getIndex(Request $request){
        return sview('dashboard',[
            'page_title' => 'Dashboard'
        ]);
    }

    public function getLogout(Request $request){
        session()->flush();
        return to_route('admin.login');
    }
}
