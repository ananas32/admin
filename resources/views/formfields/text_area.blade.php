<textarea @if($row->required == 1) required @endif
					class="form-control"
					data-name="{{ $row->display_name }}"
					data-details="{{ json_encode($options) }}"
					name="{{ $row->field }}">@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif</textarea>