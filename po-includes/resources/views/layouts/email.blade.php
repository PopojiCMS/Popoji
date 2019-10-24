<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<style type="text/css">
		html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}
		@media only screen and (min-device-width: 750px) {
			.table750 {width: 750px !important;}
		}
		@media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
			table[class="table750"] {width: 100% !important;}
			.mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
			.mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
			.mob_left {text-align: left !important;}
			.mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
			.mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
			.mob_center {text-align: center !important;}
			.top_pad {height: 15px !important; max-height: 15px !important; min-height: 15px !important;}
			.mob_pad {width: 15px !important; max-width: 15px !important; min-width: 15px !important;}
			.mob_div {display: block !important;}
		}
		@media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
			.mod_div {display: block !important;}
		}
		.table750 {width: 750px;}
	</style>
</head>
<body style="margin: 0; padding: 0;">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f3f3f3; min-width: 350px; font-size: 1px; line-height: normal;">
		<tr>
			<td align="center" valign="top">
				<table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #f3f3f3;">
					<tr>
						<td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
						<td align="center" valign="top" style="background: #ffffff;">
							<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
								<tr>
									<td align="right" valign="top">
										<div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
									</td>
								</tr>
							</table>

							<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
								<tr>
									<td align="left" valign="top">
										<div style="height: 39px; line-height: 39px; font-size: 37px;">&nbsp;</div>
										<a href="{{ url('/') }}" target="_blank" style="display: block; max-width: 128px;">
											<img src="{{ $message->embed('po-content/uploads/'.getSetting('logo')) }}" alt="img" width="128" border="0" style="display: block; width: 128px;" />
										</a>
										<div style="height: 43px; line-height: 43px; font-size: 41px;">&nbsp;</div>
									</td>
								</tr>
							</table>

							<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
								<tr>
									<td align="left" valign="top">
										@yield('content')
										<div style="height: 75px; line-height: 75px; font-size: 73px;">&nbsp;</div>
									</td>
								</tr>
							</table>

							<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
								<tr>
									<td align="center" valign="top">
										<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
										<table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
											<tr>
												<td align="center" valign="top">
													<div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
													<font face="'Source Sans Pro', sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
														<span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 17px; line-height: 20px;">Copyright &copy; {{ date('Y') }} {{ getSetting('web_author') }}. All Rights Reserved.</span>
													</font>
													<div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
													<font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 20px;">
														<span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">{{ getSetting('email') }}</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">{{ getSetting('telephone') }}</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Unsubscribe</a></span>
													</font>
													<div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
													<table cellpadding="0" cellspacing="0" border="0">
														<tr>
															<td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
															<td align="center" valign="top">
																<a href="{{ getSetting('facebook') }}" target="_blank" style="display: block; max-width: 18px;">
																	<img src="{{ $message->embed('po-admin/email/soc_2.png') }}" alt="img" width="18" border="0" style="display: block; width: 18px;" />
																</a>
															</td>
															<td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
															<td align="center" valign="top">
																<a href="{{ getSetting('twitter') }}" target="_blank" style="display: block; max-width: 21px;">
																	<img src="{{ $message->embed('po-admin/email/soc_3.png') }}" alt="img" width="21" border="0" style="display: block; width: 21px;" />
																</a>
															</td>
														</tr>
													</table>
													<div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						<td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>