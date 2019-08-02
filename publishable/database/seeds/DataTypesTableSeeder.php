<?php

use Illuminate\Database\Seeder;
use LaravelAdminPanel\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'posts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'posts',
                'display_name_singular' => 'Запис',
                'display_name_plural'   => 'Записи',
                'icon'                  => 'admin-news',
                'model_name'            => 'LaravelAdminPanel\\Models\\Post',
                'policy_name'           => 'LaravelAdminPanel\\Policies\\PostPolicy',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Сторінка',
                'display_name_plural'   => 'Сторінки',
                'icon'                  => 'admin-file-text',
                'model_name'            => 'LaravelAdminPanel\\Models\\Page',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => 'Користувач',
                'display_name_plural'   => 'Користувачі',
                'icon'                  => 'admin-person',
                'model_name'            => 'LaravelAdminPanel\\Models\\User',
                'policy_name'           => 'LaravelAdminPanel\\Policies\\UserPolicy',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('name', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'categories',
                'display_name_singular' => 'Категорія',
                'display_name_plural'   => 'Категорії',
                'icon'                  => 'admin-categories',
                'model_name'            => 'LaravelAdminPanel\\Models\\Category',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => 'Меню',
                'display_name_plural'   => 'Меню',
                'icon'                  => 'admin-list',
                'model_name'            => 'LaravelAdminPanel\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => 'Роль',
                'display_name_plural'   => 'Ролі',
                'icon'                  => 'admin-lock',
                'model_name'            => 'LaravelAdminPanel\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'form-designer');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'form_designer',
                'display_name_singular' => 'Дизайнер форм',
                'display_name_plural'   => 'Дизайнер форм',
                'icon'                  => 'designer-list',
                'model_name'            => 'LaravelAdminPanel\\Models\\FormDesigner',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
