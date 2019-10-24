@extends('layouts.email')

@section('content')
	<font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 32px; line-height: 40px; font-weight: 300; letter-spacing: -1.5px;">
		<span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 32px; line-height: 40px; font-weight: 300; letter-spacing: -1.5px;">Hai {{ $person->name }},</span>
	</font>
	<div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
	<div style="font-size: 18px; line-height: 26px;">
		<p style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 22px; line-height: 30px;">{{ $post->title }}</p>
		<p style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 18px; line-height: 26px;">{{ Str::limit(strip_tags($post->content), 500) }}</p>
	</div>
	<div style="height: 33px; line-height: 33px; font-size: 31px;">&nbsp;</div>
	<table class="mob_btn" cellpadding="0" cellspacing="0" border="0" style="background: #27cbcc; border-radius: 4px;">
		<tr>
			<td align="center" valign="top"> 
				<a href="{{ url('detailpost/'.$post->seotitle) }}" target="_blank" style="display: block; border: 1px solid #27cbcc; border-radius: 4px; padding: 12px 23px; font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
					<font face="'Source Sans Pro', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
						<span style="font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Read&nbsp;more</span>
					</font>
				</a>
			</td>
		</tr>
	</table>
@endsection
