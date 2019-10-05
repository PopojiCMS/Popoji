<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('username', 'Username *', ['class' => 'control-label']) !!}
		<input type="text" class="form-control" value="{{ isset($user) ? $user->username : 'Auto Generate' }}" disabled />
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('name', 'Name *', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-4">
		{!! Form::label('email', 'Email *', ['class' => 'control-label']) !!}
		{!! Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('telp', 'Telephone', ['class' => 'control-label']) !!}
		{!! Form::text('telp', null, ['class' => $errors->has('telp') ? 'form-control is-invalid' : 'form-control']) !!}
		{!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('password', 'Password *', ['class' => 'control-label']) !!}
		@php
			$passwordOptions = ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control'];
			if ($formMode === 'create') {
				$passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
			}
		@endphp
		{!! Form::password('password', $passwordOptions) !!}
		{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
		<small><i>{{ (isset($user) ? 'Please leave empty if password don\'t change' : '') }}</i></small>
	</div>
</div>
<div class="form-group">
	{!! Form::label('bio', 'Bio', ['class' => 'control-label']) !!}
	{!! Form::textarea('bio', null, ['class' => $errors->has('bio') ? 'form-control is-invalid ht-150' : 'form-control ht-150-i']) !!}
	{!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
</div>
@if (isset($user))
	@if (Auth::user()->id == $user->id)
	<div class="form-group">
		{!! Form::label('picture', 'Picture', ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::text('picture', null, ['class' => $errors->has('picture') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager']) !!}
			<span class="input-group-append">
				<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&&akey=i7GLt0sqUVc0uWdlxT4t8TftzX5Ebi8gm8uqa6IGE6w') }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> Browse</a>

			</span>
		</div>
		{!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
	</div>
	@endif
@endif
@if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
	<div class="form-row">
		<div class="form-group col-md-6">
			{!! Form::label('block', 'Block *', ['class' => 'control-label']) !!}
			<select class="select2 form-control" id="block" name="block">
				@if (isset($user))
					<option value="{{ $user->block }}">Selected {{ $user->block == 'Y' ? 'Block' : 'Unblock' }}</option>
				@endif
				<option value="Y">Block</option>
				<option value="N">Unblock</option>
			</select>
			{!! $errors->first('block', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group col-md-6">
			{!! Form::label('roles', 'Role *', ['class' => 'control-label']) !!}
			<select name="roles[]" class="select2 form-control roles" multiple required>
				@foreach ($roles as $row)
					@if (isset($user))
						<option value="{{ $row->name }}" {{ $user->hasRole($row) ? 'selected':'' }}>{{ $row->name }}</option>
					@else
						<option value="{{ $row->name }}">{{ $row->name }}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
@endif
