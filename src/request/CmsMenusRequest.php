<?php
namespace Laililmahfud\Starterkit\Request;

use Illuminate\Foundation\Http\FormRequest;
use Laililmahfud\Starterkit\Models\CmsModuls;

class CmsMenusRequest extends FormRequest
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

    public function save()
    {
        $this->validate([
            'module_name' => 'required',
            'module_path' => 'required',
            'module_icon' => 'required',
        ]);
        CmsModuls::create([
            'name' => $this->module_name,
            'path' => $this->module_path,
            'icon' => $this->module_icon,
            'sorting' => 1,
            'table' => $this->module_table,
            'controller' => $this->module_controller,
            'route_prefix' => strtolower(str_replace([" ", "_"], ["-", "-"], $this->module_table)),
        ]);
        
    }

    public function sortingMenus()
    {
        $listMenu = $this->menus;
        $listMenu = json_decode($listMenu);
        $sm = 1;
        foreach ($listMenu[0] as $menu) {
            CmsModuls::where('id', $menu->id)->update(['sorting' => $sm]);
            $ss = 1;
            foreach ($menu->children[0] as $child) {
                CmsModuls::where('id', $child->id)->update(['sorting' => $ss, 'parent_id' => $menu->id]);
                $ss++;
            }
            $sm++;
        }
        return response()->json(['message' => 'Menu successfully updated']);
    }
}
