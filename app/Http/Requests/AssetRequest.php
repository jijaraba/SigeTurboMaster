<?php

namespace SigeTurbo\Http\Requests;

use Illuminate\Support\Facades\Auth;
use SigeTurbo\Http\Requests\Request;
use SigeTurbo\Asset;

class AssetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$asset = $this->route("assets");
        //return Asset::where('idasset','=',$asset)
            //->where('iduser', Auth::user()->iduser)->exists();
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
            'assetcategory' => 'required|integer',
            'provider' => 'required|integer',
            'code' => 'required|integer',
            'name' => 'required|max:255',
            'manufacturer' => 'required',
            'cost' => 'required|numeric',
            'acquired' => 'required|date',
        ];
    }
}
