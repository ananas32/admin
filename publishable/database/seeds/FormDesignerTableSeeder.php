<?php

use Illuminate\Database\Seeder;
use LaravelAdminPanel\Models\DataType;
use LaravelAdminPanel\Models\FormDesigner;

class FormDesignerTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$dataType = DataType::where('slug', 'posts')->firstOrFail();

		if (!$dataType->exists) {
			return false;
		}

		FormDesigner::firstOrCreate([
			'data_type_id' => $dataType->id,
			'options' => json_encode([
				[
					'class' => 'col-md-8',
					'panels' => [
						[
							'class' => 'panel panel-default',
							'title' => '<i class="admin-character"></i> Назва допису Назва для вашої публікації',
							'fields' => [
								'title',
								'slug',
							],
						],
						[
							'class' => 'panel panel-danger',
							'title' => 'Post Content',
							'fields' => [
								'body',
							],
						],
						[
							'class' => 'panel panel-success',
							'title' => 'Уривок <small>Невеликий опис цієї публікації</small>',
							'fields' => [
								'excerpt',
							],
						],
					],
				],
				[
					'class' => 'col-md-4',
					'panels' => [
						[
							'class' => 'panel panel-warning',
							'title' => 'Деталі запису',
							'fields' => [
								'status',
								'category_id',
								'featured',
							],
						],
						[
							'class' => 'panel panel-primary',
							'title' => 'Зображення запису',
							'fields' => [
								'image',
							],
						],
						[
							'class' => 'panel panel-info',
							'title' => 'СЕО контент',
							'fields' => [
								'meta_keywords',
								'meta_description',
								'seo_title',
							],
						],
					],
				],
			]),
		]);
	}
}
