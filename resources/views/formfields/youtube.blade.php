@include('admin::formfields.text')

@if(isset($dataTypeContent->{$row->field}))
	@php $code = old($row->field, $dataTypeContent->{$row->field}) @endphp
@elseif(isset($options->default))
	@php $code = old($row->field, $options->default) @endphp
@else
	@php $code = old($row->field) @endphp
@endif
@if(!empty($code))
	<br>
	<iframe  src="https://www.youtube.com/embed/{{ $code }}" frameborder="0"
					allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
@endif