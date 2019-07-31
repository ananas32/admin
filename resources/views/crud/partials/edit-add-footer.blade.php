<div class="panel-footer">
	<button type="submit" class="btn btn-primary save">{{ __('admin.generic.save') }}</button>
	@if($dataTypeContent->id)
		<a href="{{ url('admin/'.$dataType->slug.'/'.$dataTypeContent->id) }}" target="blank" class="btn btn-default preview pull-right">
			<i class="voyager-eye"></i> {{ __('Просмотр деталей') }}</a>
	@endif
</div>
