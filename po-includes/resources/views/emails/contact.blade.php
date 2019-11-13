@extends('layouts.email')

@section('content')
	<font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 32px; line-height: 40px; font-weight: 300; letter-spacing: -1.5px;">
		<span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 32px; line-height: 40px; font-weight: 300; letter-spacing: -1.5px;">Hai {{ $contact->name }},</span>
	</font>
	<div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
	<div style="font-size: 18px; line-height: 26px;">
		<p style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 14px; line-height: 22px;">{!! $content !!}</p>
	</div>
@endsection
