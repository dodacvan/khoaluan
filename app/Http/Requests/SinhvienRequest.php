<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SinhvienRequest extends Request {

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
			'txtCode'=>'required|unique:sinhviens,masinhvien',
			'txtemail'=>'required|unique:sinhviens,email',
			'txtBirth'=>'required',
			'txtCellphone'=>'required|numeric',
			'txtAddress'=>'required'
		];
	}

	public function messages(){
		return [
			'txtName.required'=>'Điền tên sinh viên',
			'txtemail.txtemail'=>'Điền email',
			'txtemail.unique'=>'Email bị trùng',
			'txtCode.txtemail'=>'Điền mã sinh viên',
			'txtCode.unique'=>'Mã sinh viên bị trùng',
			'txtBirth.required'=>'Điền ngày sinh',
			'txtCellphone.required'=>'Điền số điện thoại',
			'txtCellphone.numeric'=>'Điền đúng định dạng số điện thoại',
			'txtAddress.required'=>'Điền địa chỉ thường trú',
			];
	}

}
