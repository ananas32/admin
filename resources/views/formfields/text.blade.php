@php $canEdit = true; @endphp
@if($dataTypeContent->id)
	@if(isset($options->info_field->edit))
		@php $canEdit = $options->info_field->edit; @endphp
	@endif
@else
	@if(isset($options->info_field->create))
		@php $canEdit = $options->info_field->create; @endphp
	@endif
@endif

@if($canEdit)
<input @if($row->required == 1) required @endif
  	   type="text"
			 data-name="{{ $row->display_name }}"
			 class="form-control" name="{{ $row->field }}"
			 placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
			 {!! isCrudSlugAutoGenerator($options) !!}
			 value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif"
			 data-details="{{ json_encode($options) }}"
>
@else
	<div class="form-control" disabled="">
		@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif
	</div>
@endif
