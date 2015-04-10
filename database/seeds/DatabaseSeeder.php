<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Product;
use App\SiteFiles;
use App\Parameter;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

		// Заполняем случайными данными таблицу с товарами
		//$this->call('ProductsTableSeeder');

		// Заполняем случайными изображениями таблицу с файлами для телефонов
		$this->call('FilesTableSeeder');

		// Заполняем таблицу с параметрами
		//$this->call('ParametersTableSeeder');
	}

}


/**
* Parameters table seeder
*/
class ParametersTableSeeder extends Seeder{

	public function run(){
		$faker 		= Faker\Factory::create();

		$parameters = ['вес' , 'ширина' , 'ос' , 'количество ядер' , 'частота процессора' , 'оперативная память' , 'диагональ экрана'];
		$os 		= ['Android' , 'iOS' , 'bada' , 'Linux' , 'Symbian' , 'Firefox OS' , 'Ubuntu'];
		$mhz 		= [500 , 600 , 700 , 1000 , 1500 , 2000];
		$category 	= 1;

		$this->command->info('Inserting records using Faker ...');

		for ($i=1; $i <= 78; $i++) {

			$params_value = [
				$faker->randomNumber(3) 			,	// ves
				$faker->randomNumber(2) 			,	// shirina
				$os[array_rand($os , 1)]			,	// os
				$faker->randomNumber(1)				,	// cores count
				$mhz[array_rand($mhz , 1)]."MHz"	,	// mhz
				$mhz[array_rand($mhz , 1)]."Мб"		,	// ozu
				$faker->numberBetween(3 , 17).'"'		// ``
			];

			foreach ($parameters as $key => $parameter) {
				Parameter::create([
					'title' 	=> $parameter ,
					'value' 	=> $params_value[$key] ,
					'product'	=> $i ,
					'category'	=> $category
				]);
			}

		}

		$this->command->info('Parameters table seeded using Faker ...');

	}

}


/**
* Files table seeder
*/
class FilesTableSeeder extends Seeder{

	public function run(){
		$faker 		= Faker\Factory::create();
		$count		= 26;

		$products = Product::all();

		$this->command->info('Inserting records using Faker ...');

		foreach ($products as $product) {
			$type 		= 'image';
			$group 		= 'products';
			$groupid	= $product->id;
			$title 		= $product->title;
			$rpltitle 	= str_replace(' ' , '-' , $product->title);
			$path		= 'http://lorempixel.com/200/290/technics/'.$rpltitle;
			$publicurl	= 'http://lorempixel.com/200/290/technics/'.$rpltitle;

			SiteFiles::create([
				'type'		=> $type 	,
				'group'		=> $group 	,
				'groupid'	=> $groupid	,
				'title'		=> $title 	,
				'path'		=> $path 	,
				'publicurl'	=> $publicurl
			]);
		}

		$this->command->info('Files table seeded using Faker ...');
	}

}

/**
* Products seeder
*/
class ProductsTableSeeder extends Seeder{
	
	public function run(){
		set_time_limit(15);

		$count 		= 121;
		$faker 		= Faker\Factory::create();
		$companies 	= ['Samsung' , 'Apple' , 'Nokia' , 'Motorolla' , 'LG' , 'Fly' , 'Philips' , 'Panasonic'];
		$parameters = ['вес' , 'ширина' , 'ос' , 'количество ядер' , 'частота процессора' , 'оперативная память' , 'диагональ экрана'];

		// Список названий тлефонов 
		$inserted 		= array();
		$inserted_count = 0;

		$this->command->info('Inserting '.$count.' sample records using Faker ...');

		for ($i=0; $i < $count; $i++) {
			$random_title1 	= $faker->sentence(5);
			$random_text1	= $faker->paragraph(4);
			$random_title2 	= $faker->sentence(4);

			// Генерируем уникальное название телефона
			$title 		= "";
			$control 	= true;
			while ($control) {				
				$title 	= $companies[array_rand($companies , 1)]." ".$faker->bothify('?##');
				if(!in_array($title, $inserted)){
					$control 	= false;
					$inserted[] = $title;
				}
			}

			$price 		= $faker->randomNumber(5);
			$count 		= $faker->randomNumber(2);
			$category 	= 1;	// на время запуска это категория телефонов, сверять с базой данных!!!
			$view 		= '<div class="gridster ready"><ul style="width: 725px; position: relative; height: 957px;"><li data-widget-type="title" class="title-widget gs-w" data-col="1" data-row="1" data-sizex="25" data-sizey="2" style="display: list-item;">@include("products.title")</li><li data-widget-type="parameters" class="parameters-widget gs-w" data-col="11" data-row="3" data-sizex="15" data-sizey="5" style="display: list-item;">@include("parameters.list")</li><li data-widget-type="text" class="text-widget gs-w" data-col="11" data-row="8" data-sizex="15" data-sizey="9" style="display: list-item;"><div><b><span style="font-size: 18px;">'.$random_title1.'</span></b></div><div style="text-align: justify;">'.$random_text1.'</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div></li><li data-widget-type="image" class="image-widget gs-w" data-col="1" data-row="3" data-sizex="10" data-sizey="14" style="display: list-item;"><div class="image-widget-backdiv" style="background-image: url(http://lorempixel.com/290/400/technics/);"></div></li><li data-widget-type="text" class="text-widget gs-w" data-col="1" data-row="17" data-sizex="25" data-sizey="2" style="display: list-item;"><div style="text-align: center;"><span style="font-size: 32px;"><b>'.$random_title2.'</b></span></div></li><li data-widget-type="image" class="image-widget gs-w" data-col="1" data-row="19" data-sizex="25" data-sizey="15" style="display: list-item;"><div class="image-widget-backdiv" style="background-image: url(http://lorempixel.com/720/430/technics/);"></div></li></ul></div>';
			$editview 	= '[{"id":"","col":1,"row":1,"size_x":25,"size_y":2,"type":"title","htmlContent":"<div class=\"product-title\"><%= title %></div>\n\t"},{"id":"","col":11,"row":3,"size_x":15,"size_y":5,"type":"parameters","htmlContent":"<%= parameters %>"},{"id":"","col":11,"row":8,"size_x":15,"size_y":9,"type":"text","htmlContent":"<div><b><span style=\"font-size: 18px;\">'.$random_title1.'</span></b></div><div style=\"text-align: justify;\">'.$random_text1.'</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>"},{"id":"","col":1,"row":3,"size_x":10,"size_y":14,"type":"image","htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://lorempixel.com/290/400/technics/);\"></div>"},{"id":"","col":1,"row":17,"size_x":25,"size_y":2,"type":"text","htmlContent":"<div style=\"text-align: center;\"><span style=\"font-size: 32px;\"><b>'.$random_title2.'</b></span></div>"},{"id":"","col":1,"row":19,"size_x":25,"size_y":15,"type":"image","htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://lorempixel.com/720/430/technics/);\"></div>"}]';
			$visible 	= 1;
			
			Product::create([
				'title' 	=> $title ,
				'price' 	=> $price ,
				'count' 	=> $count ,
				'category' 	=> $category ,
				'view'		=> $view ,
				'editview'	=> $editview ,
				'visible'	=> $visible
			]);

			$inserted_count++;
		}

		$this->command->info('Products table seeded using Faker ... Inserted count: '.$inserted_count);
		
	}

}
