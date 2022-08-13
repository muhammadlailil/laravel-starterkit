<?php
namespace laililmahfud\starterkit\request;


use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use laililmahfud\starterkit\models\CmsUsers;
use laililmahfud\starterkit\helpers\Starterkit;

class CmsUsersRequest extends FormRequest
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
        return [
            //
        ];
    }

    public function columns()
    {
        return [
            (object) ["label" => "name", "name" => "cms_users.name"],
            (object) ["label" => "email", "name" => "cms_users.email"],
            (object) ["label" => "role", "name" => "r.role"],
            (object) ["label" => "status", "name" => "cms_users.status"],
        ];
    }

    public function dataTable()
    {
        $sortby = $this->sortby ?? 'cms_users.created_at';
        $sorting = $this->sorting ?? 'desc';
        $search = $this->search ?? '';
        $limit = $this->limit ?? 10;

        return CmsUsers::join('cms_privileges as r', 'cms_users.cms_privileges_id', 'r.id')
            ->where(function ($q) use ($search) {
                $q->where('cms_users.name', 'like', '%' . $search . '%')
                    ->orWhere('cms_users.email', 'like', '%' . $search . '%')
                    ->orWhere('r.name', 'like', '%' . $search . '%');
            })->select('cms_users.*','r.name as role')
            ->orderBy($sortby, $sorting)
            ->paginate($limit);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'role' => 'required',
            'status' => 'required',
            'email' => 'required|email',
        ]);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'cms_privileges_id' => $this->role,
        ];

        if ($this->file('foto')) {
            $data = array_merge($data, [
                'profile' => Starterkit::uploadFile($this->file('foto')),
            ]);
        }
        if ($this->password) {
            $data = array_merge($data, [
                'password' => Hash::make($this->password),
            ]);
        }
        CmsUsers::updateOrCreate(['id' => $this->id], $data);
    }
}
