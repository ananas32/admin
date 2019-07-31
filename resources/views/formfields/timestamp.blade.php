@php
	$details = json_decode($row->details);
	$datetimepicker = isset($details->datetimepicker) ? json_encode($details->datetimepicker) : false;
@endphp

@if($datetimepicker)
	@if(isset($details->mask))
		<div class='input-group date' id='{{ $row->field }}'>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
			<input type='text' name="{{ $row->field }}" class="form-control" value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif" data-mask="{{ $details->mask }}" />
		</div>
@section('javascript')
	@parent

	<script type="text/javascript">
		$(function () {
			$('#{{ $row->field }}').datetimepicker({
				locale: '{{ $details->datetimepicker->locale }}',
				format: '{{ $details->datetimepicker->format }}'
			});
		});
	</script>
@stop
@else
	<input @if($row->required == 1) required @endif type="datetime" class="form-control datepicker" name="{{ $row->field }}"
				 value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif"
				 data-datetimepicker="{{ $datetimepicker }}">
@endif
@else
	<input @if($row->required == 1) required @endif type="datetime" class="form-control datepicker" name="{{ $row->field }}"
				 value="@if(isset($dataTypeContent->{$row->field})){{ gmdate('m/d/Y g:i A', strtotime(old($row->field, $dataTypeContent->{$row->field})))  }}@else{{old($row->field)}}@endif">
@endif
