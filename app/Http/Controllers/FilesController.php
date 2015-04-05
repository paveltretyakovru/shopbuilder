<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use File;			// подключаем фасад файловой системы
use HTML;
use App\SiteFiles; 	// модель таблицы с файлами

class FilesController extends Controller {

	public function getImageFile(Request $request){
		$data = $request->all();

		$image 	= $data['image'];
		$group 	= $data['group'];
		$id 	= $data['id'];
		$title	= $data['title'];

		$mime 		= $image->getMimeType();
		$relmimes 	= ['image/png' , 'image/jpeg' , 'image/gif'];
		$extension 	= $image->getClientOriginalExtension(); // getting image extension
		$fileName 	= "{$group}_{$id}_".rand(11111,99999).'.'.$extension; // renameing image
		$imagespath = 'public/upimages';

		// Формируем модель для записи в БД
		$File 			= new SiteFiles;
		$File->title 	= $title;
		$File->type 	= "image";
		$File->group 	= $group;
		$File->groupid 	= $id;
		$File->path 	= $imagespath.'/'.$fileName;
		//$File->publicurl= asset('upimages/'.$fileName);
		$File->publicurl= 'upimages/'.$fileName;
		
		// Переданный файл является ли изображением
		if(in_array($mime, $relmimes)){
			// Загружен ли файл
			if($image->isValid()){
				// Перемещаем изображение
				$image->move($imagespath, $fileName); // uploading file to given path
				// Добавляем новую запись БД в таблицу files
				$File->save();

				return response()->json(
					['imageurl' => $File->publicurl]
				);
			}
		}else{
			return response()->json(
				['error' => 'Ошибка во время проверки типа файла']
			);
		}

	}

}
