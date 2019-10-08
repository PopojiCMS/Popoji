<div class="form-group">
    {!! Form::label('name', __('role.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
@if(isset($role))
	<div class="row" id="checkAllBox">
		<div class="col-md-12 text-center">
			<p><label><input type="checkbox" id="checkAll" /> <b>{{ __('general.check_all') }}</b></label></p>
		</div>
		<div class="col-md-3" style="margin-bottom:10px;">
			@php $no = 1; @endphp
			@foreach ($permissions as $key => $row)
				<input type="checkbox" name="permission[]" value="{{ $row }}" {{ in_array($row, $hasPermission) ? "checked" : "" }} /> {{ $row }} <br />
				@if ($no++%4 == 0)
					</div>
					<div class="col-md-3" style="margin-bottom:10px;">
				@endif
			@endforeach
		</div>
	</div>
@endif
