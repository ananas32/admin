<ul class="nav navbar-nav">

	@php
		if (Admin::translatable($items)) {
				$items = $items->load('translations');
		}
	@endphp

	@foreach ($items as $item)
		@php
			$listItemClass = [];
			$styles = null;
			$linkAttributes = null;
			$transItem = $item;

			if (Admin::translatable($item)) {
					$transItem = $item->translate($options->locale);
			}

			$href = $item->link();

			// Current page
			if(url($href) == url()->current()) {
					array_push($listItemClass, 'active');
			}

			$permission = '';
			$hasChildren = false;

			// With Children Attributes
			if(!$item->children->isEmpty())
			{
					foreach($item->children as $child)
					{
							$hasChildren = $hasChildren || Auth::user()->can('browse', $child);

							if(url($child->link()) == url()->current())
							{
									array_push($listItemClass, 'active');
							}
					}
					if (!$hasChildren) {
							continue;
					}

					$linkAttributes = 'href="#' . str_slug($transItem->title, '-') .'-dropdown-element" data-toggle="collapse" aria-expanded="'. (in_array('active', $listItemClass) ? 'true' : 'false').'"';
					array_push($listItemClass, 'dropdown');
			}
			else
			{
					if(!Auth::user()->can('browse', $item)) {
							continue;
					}

					$linkAttributes =  'href="' . url($href) .'"';
			}
		@endphp

		<li class="{{ implode(" ", $listItemClass) }}">
			<a {!! $linkAttributes !!} target="{{ $item->target }}">
				<span class="icon {{ $item->icon_class }}"></span>
				<span class="title">
                {{ $transItem->title }}
					@if($item->details)
						@php $details = json_decode($item->details); @endphp
						@if(isset($details->badges))
							@foreach($details->badges as $badge)
								<span class="label label-{{ $badge->class }}">
                        {{ app("App\\".$details->model)->where("$badge->field", "$badge->operator", "$badge->value")->count() }}
                        </span>
							@endforeach
						@endif
					@endif
            </span>
			</a>
			@if($hasChildren)
				<div id="{{ str_slug($transItem->title, '-') }}-dropdown-element"
						 class="panel-collapse collapse {{ (in_array('active', $listItemClass) ? 'in' : '') }}">
					<div class="panel-body">
						@include('admin::menu.admin_menu', ['items' => $item->children, 'options' => $options, 'innerLoop' => true])
					</div>
				</div>
			@endif
		</li>
	@endforeach

</ul>
