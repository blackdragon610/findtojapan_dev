<?php 
	if (!isset($inputs)){
		$inputs[$name] = '';
	}
	
	$selects = viewConfig($file, getVariable($inputs, $name), $keyValue, false);
?>


@if (!empty($isConfirmation))
	@if (isset($selects[getVariable($inputs, $name)]))
		{{$selects[getVariable($inputs, $name)]['value']}}
		
	@else
		@if (isset($first))
			{!! $first !!}
		@endif		
	@endif
	
	<input type="hidden" name="{{$name}}" value="{{getVariable($inputs, $name)}}">
@else
	
	<select name="{{$name}}" {!! $contents !!} >
		@if (isset($first))
			<option value="0">{!! $first !!}</option>
		@endif
			@if ($selects)
				@foreach ($selects as $key => $select)
					<option value="{{$key}}"@if ($select['select']) selected @endif>{{$select['value']}}</option>
				@endforeach
			@endif
	</select>
		
	@include('layouts.parts.editor.error')
@endif
