<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditLichhen extends Request {

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
			'title'=>'required',
			'place' => 'required'
		];
	}

	public function messages(){
		return [
			'title.required'=>'Điền tên tiêu đề',
			'place.required'=>'Điền thời gian',
		];
	}

}
