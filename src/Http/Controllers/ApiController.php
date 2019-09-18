<?php

namespace LaravelAdminPanel\Http\Controllers;

use Illuminate\Http\Request;
use LaravelAdminPanel\Facades\Admin;
use Validator;

class ApiController extends BaseController
{
	public function order(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'data' => 'required|json',
			'table_name' => 'required|string',
			'order_by' => 'required|string',
		]);

		if (!$validator->passes()) {
			return response()->json(['error' => $validator->errors()->all()], 400);
		}

		$data = json_decode($request->data);
		$table_name = $request->table_name;
		$order_by = $request->order_by;

		foreach ($data as $index => $item) {
			\DB::table($table_name)
				->where('id', $item->id)
				->update([$order_by => $index + 1]);
		}

		return response()->json(['success' => __('Sorted')]);
	}

	public function update(Request $request)
	{
		$table_name = $request->table_name;
		$where = $request->where;
		$data = $request->data;

		$validator = Validator::make($request->all(), [
			'table_name' => 'required|string',
			'data' => 'required|array',
			'where' => 'required|array',
		]);

		if (!$validator->passes()) {
			return response()->json(['error' => $validator->errors()->all()], 400);
		}

		$dataType = Admin::model('DataType')
			->where('name', '=', $table_name)
			->first();

		$dataTypeContent = app($dataType->model_name)
			->where([$where])->firstOrFail();

		foreach ($data as $column => $value) {
			$dataTypeContent->$column = $value;
		}

		$dataTypeContent->save();

		return response()->json(['success' => 'Updated']);
	}
}
