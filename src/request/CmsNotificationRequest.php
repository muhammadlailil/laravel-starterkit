<?php
namespace laililmahfud\starterkit\request;

use Illuminate\Foundation\Http\FormRequest;

class CmsNotificationRequest extends FormRequest
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
            (object) ["label" => "Notification", "name" => "description"],
            (object) ["label" => "Is Read", "name" => "is_read"],
        ];
    }

    public function dataTable()
    {
        $sortby = $this->sortby ?? 'created_at';
        $sorting = $this->sorting ?? 'desc';
        $search = $this->search ?? '';
        $limit = $this->limit ?? 10;

        return cmsNotification()->where('description', 'like', '%' . $search . '%')
            ->orderBy($sortby, $sorting)
            ->paginate($limit);
    }
}
