<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class GiaovienRequest extends Request {

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
			'txtName'=>'required',
			'txtemail'=>'required|unique:giaoviens,email',
			'txtBirth'=>'required',
			'txtCellphone'=>'required|numeric',
			'txtProvince'=>'required',
			'txtAddress'=>'required'

		];
	}

	public function messages(){
		return [
			'txtName.required'=>'Điền tên giáo viên',
			'txtemail.required'=>'Điền email',
			'txtemail.unique'=>'Email bị trùng',
			'txtBirth.required'=>'Điền ngày sinh',
			'txtCellphone.required'=>'Điền số điện thoại',
			'txtCellphone.numeric'=>'Điền đúng định dạng số điện thoại',
			'txtProvince.required'=>'Điền Quê quán- tỉnh thành phố',
			'txtAddress.required'=>'Điền địa chỉ thường trú',
			];
	}
}
