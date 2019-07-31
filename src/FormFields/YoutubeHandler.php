<?php

namespace LaravelAdminPanel\FormFields;

use Illuminate\Http\Request;

class YoutubeHandler extends AbstractHandler
{
	protected $codename = 'youtube';

	public function createContent($row, $dataType, $dataTypeContent, $options)
	{
		return view('admin::formfields.youtube', [
			'row' => $row,
			'options' => $options,
			'dataType' => $dataType,
			'dataTypeContent' => $dataTypeContent,
		]);
	}

	public function getContentBasedOnType(Request $request, $slug, $row)
	{
		$content = $request->input($row->field);

		if (strripos($content, 'youtu') === false) {
			return $content;
		} else {
			$pattern =
				'%^             # Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x';

			preg_match($pattern, $content, $matches);

			return $matches[1] ?? null;

		}
	}
}
