<?php

namespace laililmahfud\starterkit\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use laililmahfud\starterkit\models\CmsUsers;
use laililmahfud\starterkit\models\CmsPrivileges;
use laililmahfud\starterkit\request\CmsUsersRequest;

class AdminCmsUsersController extends Controller
{
    private $page_title = 'Users Management';
    
    public function index(CmsUsersRequest $request)
    {
        return sview('cms-users.index', [
            'page_title' => $this->page_title,
            'columns' => $request->columns(),
            'data' => $request->dataTable(),
        ]);
    }

    public function add(Request $request)
    {
        return sview('cms-users.form', [
            'page_title' => $this->page_title,
            'privileges' => CmsPrivileges::all(),
            'data' => new CmsUsers(),
        ]);
    }

    public function edit(Request $request, $id)
    {
        return sview('cms-users.form', [
            'page_title' => $this->page_title,
            'privileges' => CmsPrivileges::all(),
            'data' => CmsUsers::findOrFail($id),
        ]);
    }

    public function save(CmsUsersRequest $request)
    {
        $request->save();
        return to_route('admin.cms-users.index', ['success_message' => 'Data has been saved']);
    }

    public function delete(CmsUsersRequest $request, $id)
    {
        $user = CmsUsers::findOrFail($id);
        delete_file($user->profile);

        $user->delete();
        return to_route('admin.cms-users.index', ['success_message' => 'Data has been deleted']);
    }

    public function bulkdelete(Request $request)
    {
        $listFile = CmsUsers::whereIn('id', $request->id_selected)->pluck('profile')->toArray();
        delete_files($listFile);

        CmsUsers::destroy($request->id_selected);
        return to_route('admin.cms-users.index', ['success_message' => 'Data has been deleted']);
    }
}
