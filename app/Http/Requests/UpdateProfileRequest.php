<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'required|max:20',
          //  'password' => 'min:3|max:32',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages(){
        return [
            'required'=>':attribute khong duoc de trong',
            'max'=>':attribute toi da khong duoc lon hon :max ky tu',
            'image'=>':attribute phai la kieu anh'
        ];
    }
}
