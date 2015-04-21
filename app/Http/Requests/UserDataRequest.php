<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserDataRequest extends Request {

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
			'fullname' 	=> 'required|min:5|max:70' ,
			'country'	=> 'required|min:3|max:40' ,
			'city'		=> 'required|min:5|max:40' ,
			'address'	=> 'required|min:5' ,
			'postcode'	=> 'required|min:5' ,
			'phone'		=> 'required|min:3'
		];
	}

}
