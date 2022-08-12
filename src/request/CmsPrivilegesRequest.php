<?php
namespace Laililmahfud\Starterkit\Request;


use Illuminate\Foundation\Http\FormRequest;
use Laililmahfud\Starterkit\Models\CmsPrivileges;
use Laililmahfud\Starterkit\Models\CmsPrivilegesRoles;

class CmsPrivilegesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function columns()
    {
        return [
            (object) ["label" => "name", "name" => "name"],
            (object) ["label" => "superadmin", "name" => "is_superadmin"],
        ];
    }

    public function dataTable()
    {
        $sortby = $this->sortby ?? 'created_at';
        $sorting = $this->sorting ?? 'desc';
        $search = $this->search ?? '';
        $limit = $this->limit ?? 10;

        return CmsPrivileges::where('name', 'like', '%' . $search . '%')
            ->orderBy($sortby, $sorting)
            ->paginate($limit);
    }

    public function save()
    {
        // Dispatcher
        $this->validate([
            'name' => 'required',
            'is_superadmin' => 'required',
        ]);
        $privileges = $this->privileges;
        $role = CmsPrivileges::updateOrCreate(['id' => $this->id], [
            'name' => $this->name,
            'is_superadmin' => $this->is_superadmin,
        ]);
        CmsPrivilegesRoles::where('cms_privileges_id', $role->id)->delete();
        if (!$this->is_superadmin) {
            foreach ($privileges as $moduleId => $p) {
                $view = (isset($p['view'])) ? 1 : 0;
                $add = (isset($p['add'])) ? 1 : 0;
                $edit = (isset($p['edit'])) ? 1 : 0;
                $delete = (isset($p['delete'])) ? 1 : 0;

                CmsPrivilegesRoles::create([
                    'cms_privileges_id' => $role->id,
                    'cms_moduls_id' => $moduleId,
                    'can_view' => $view,
                    'can_edit' => $edit,
                    'can_add' => $add,
                    'can_delete' => $delete,
                ]);
            }
        }
    }
}
