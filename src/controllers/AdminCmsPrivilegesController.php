<?php
namespace Laililmahfud\Starterkit\controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laililmahfud\Starterkit\Helpers\Starterkit;
use Laililmahfud\Starterkit\Models\CmsPrivileges;
use Laililmahfud\Starterkit\Request\CmsPrivilegesRequest;

class AdminCmsPrivilegesController extends Controller
{
    private $page_title = 'Role Management';
    public function __construct()
    {
        onlySuperadmin();
    }
    public function index(CmsPrivilegesRequest $request)
    {
        return sview('cms-roles.index', [
            'page_title' => $this->page_title,
            'columns' => $request->columns(),
            'data' => $request->dataTable(),
        ]);
    }

    public function add(Request $request)
    {
        return sview('cms-roles.form', [
            'page_title' => $this->page_title,
            'moduls' => Starterkit::listAllModulsAndPrivilege(),
            'data' => new CmsPrivileges(),
        ]);
    }

    public function edit(Request $request, $id)
    {
        return sview('cms-roles.form', [
            'page_title' => $this->page_title,
            'moduls' => Starterkit::listAllModulsAndPrivilege($id),
            'data' => CmsPrivileges::findOrFail($id),
        ]);
    }

    public function save(CmsPrivilegesRequest $request)
    {
        $request->save();
        return to_route('admin.cms-roles.index', ['success_message' => 'Data has been saved']);
    }

    public function delete(CmsPrivilegesRequest $request, $id)
    {
        CmsPrivileges::where('id', $id)->delete();
        return to_route('admin.cms-roles.index', ['success_message' => 'Data has been deleted']);
    }

    public function bulkdelete(Request $request)
    {
        CmsPrivileges::destroy('id', $request->id_selected);
        return to_route('admin.cms-roles.index', ['success_message' => 'Data has been deleted']);
    }
}
