@php
    $checked = $dataTypeContent->{$dataType->field} ? true : false;
		$id = $dataTypeContent->id;
		$columnName = $dataType->field;
@endphp

@if($options && property_exists($options, 'list_checkbox') && $options->list_checkbox)
    @if(isset($options->on) && isset($options->off))
        <input type="checkbox" data-id="{{ $id }}" name="{{ $columnName }}" class="toggleswitch"
               data-on="{{ $options->on }}" @if($checked) checked="checked" @endif
               data-off="{{ $options->off }}">
    @else
        <input type="checkbox" data-id="{{ $id }}" name="{{ $columnName }}" class="toggleswitch"
               @if($checked) checked="checked" @endif
        >
    @endif
@elseif($options && property_exists($options, 'on') && property_exists($options, 'off'))
    @if($checked)
        <span class="label label-info">{{ $options->on }}</span>
    @else
        <span class="label label-primary">{{ $options->off }}</span>
    @endif
@else
    {{ $dataTypeContent->{$dataType->field} }}
@endif