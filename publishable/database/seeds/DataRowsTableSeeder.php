<?php

use Illuminate\Database\Seeder;
use LaravelAdminPanel\Models\DataRow;
use LaravelAdminPanel\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 */
	public function run()
	{
		$postDataType = DataType::where('slug', 'posts')->firstOrFail();
		$pageDataType = DataType::where('slug', 'pages')->firstOrFail();
		$userDataType = DataType::where('slug', 'users')->firstOrFail();
		$categoryDataType = DataType::where('slug', 'categories')->firstOrFail();
		$menuDataType = DataType::where('slug', 'menus')->firstOrFail();
		$roleDataType = DataType::where('slug', 'roles')->firstOrFail();
		$formDesignerDataType = DataType::where('slug', 'form-designer')->firstOrFail();

		$dataRow = $this->dataRow($postDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'author_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Автор',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 1,
				'details' => '',
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'slug');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Псевдонім',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'slugify' => [
						'origin' => 'title',
						'forceUpdate' => true,
					],
				]),
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'status');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'checkbox',
				'display_name' => 'Активність',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'on' => 'Так',
					'off' => 'Ні',
				]),
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'category_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => 'Категорія',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'details' => json_encode([
					'relationship' => [
						'key' => 'id',
						'label' => 'name',
					]
				]),
				'order' => 5,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'title');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Заголовок',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 6,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'excerpt');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'Короткий вріз',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 7,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'body');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'rich_text_box',
				'display_name' => 'Контент',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'validation' => [
						'rule' => 'required',
					]
				]),
				'order' => 8,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'image');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => 'Зображення',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'cropper' => [
						[
							'name' => 'avatar',
							'size' => [
								'name' => 'max',
								'width' => '300',
								'height' => '200',
							],
							'resize' => [
								[
									'name' => 'norm',
									'width' => '200',
									'height' => 'null',
								],
								[
									'name' => 'min',
									'width' => '100',
									'height' => 'null',
								],
							],
						],
					],
				]),
				'order' => 9,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'meta_description');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'Мета опис',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 10,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'meta_keywords');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'Мета (ключові слова)',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 11,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 12,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 13,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'author_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => 'Автор',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => json_encode([
					'relationship' => [
						'key' => 'id',
						'label' => 'name',
					]
				]),
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'title');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Заголовок',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'excerpt');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'Короткий вріз',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'body');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'rich_text_box',
				'display_name' => 'Контент',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 5,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'slug');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Псевдонім',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'slugify' => [
						'origin' => 'title',
					],
				]),
				'order' => 6,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'meta_description');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Мета опис',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 7,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'meta_keywords');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Мета (ключові слова)',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 8,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'status');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'checkbox',
				'display_name' => 'status',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'on' => 'Так',
					'off' => 'Ні'
				]),
				'order' => 9,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 10,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 11,
			])->save();
		}

		$dataRow = $this->dataRow($pageDataType, 'image');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => 'Зображення',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 12,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'name');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Ім\'я',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'email');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Email',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'password');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'password',
				'display_name' => 'Пароль',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'details' => '',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'user_belongsto_role_relationship');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'relationship',
				'display_name' => 'Роль',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'details' => '{"model":"LaravelAdminPanel\\\Models\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"name","pivot_table":"roles","pivot":"0"}',
				'order' => 10,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'remember_token');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'remember_token',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 5,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 6,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 7,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'avatar');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => 'Зображення',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 8,
			])->save();
		}

		$dataRow = $this->dataRow($menuDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($menuDataType, 'name');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Назва',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($menuDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($menuDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'parent_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => 'Батьківська категорія',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'default' => '',
					'null' => '',
					'options' => [
						'' => '-- None --',
					],
					'relationship' => [
						'key' => 'id',
						'label' => 'name',
					],
				]),
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'order');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Порядок',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'default' => 1,
				]),
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'name');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Назва',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'slug');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Псевдонім',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'slugify' => [
						'origin' => 'name',
					],
				]),
				'order' => 5,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 6,
			])->save();
		}

		$dataRow = $this->dataRow($categoryDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 7,
			])->save();
		}

		$dataRow = $this->dataRow($roleDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($roleDataType, 'name');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Назва',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($roleDataType, 'created_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'created_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 3,
			])->save();
		}

		$dataRow = $this->dataRow($roleDataType, 'updated_at');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => 'updated_at',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($roleDataType, 'display_name');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Назва відображення',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 5,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'seo_title');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Сео заголовок',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 14,
			])->save();
		}

		$dataRow = $this->dataRow($postDataType, 'featured');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'checkbox',
				'display_name' => 'featured',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 15,
			])->save();
		}

		$dataRow = $this->dataRow($userDataType, 'role_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'Роль',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
				'order' => 9,
			])->save();
		}

		$dataRow = $this->dataRow($formDesignerDataType, 'id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'number',
				'display_name' => 'id',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
				'order' => 1,
			])->save();
		}

		$dataRow = $this->dataRow($formDesignerDataType, 'data_type_id');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => 'Модель (crud)',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'relationship' => [
						'key' => 'id',
						'label' => 'display_name_singular',
					],
				]),
				'order' => 2,
			])->save();
		}

		$dataRow = $this->dataRow($formDesignerDataType, 'form_designer_belongsto_data_type_relationship');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'relationship',
				'display_name' => 'Модель (crud)',
				'required' => 1,
				'browse' => 1,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '{"model":"LaravelAdminPanel\\\Models\\\DataType","table":"data_types","type":"belongsTo","column":"data_type_id","key":"id","label":"display_name_singular","pivot_table":"categories","pivot":"0","details":null}',
				'order' => 4,
			])->save();
		}

		$dataRow = $this->dataRow($formDesignerDataType, 'options');
		if (!$dataRow->exists) {
			$dataRow->fill([
				'type' => 'code_editor',
				'display_name' => 'Деталі',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => json_encode([
					'formfields_custom' => 'json_editor',
				]),
				'order' => 3,
			])->save();
		}
	}

	/**
	 * [dataRow description].
	 *
	 * @param [type] $type  [description]
	 * @param [type] $field [description]
	 *
	 * @return [type] [description]
	 */
	protected function dataRow($type, $field)
	{
		return DataRow::firstOrNew([
			'data_type_id' => $type->id,
			'field' => $field,
		]);
	}
}
