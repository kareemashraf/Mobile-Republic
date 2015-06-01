<?php 
return array(
	'message' => 'Masha\'Allah! I\'ve just got my free copy of #SistersMagazine from http://goo.gl/shIog1',

	'title'   => 'Sisters-Magazine Free Issue',

	'fb_api'		=> 'http://sisters-magazine.com/offer/public/withyou/share',
	
	'referral_url' => htmlspecialchars_decode('http://goo.gl/shIog1'),

	'email_subject' => 'Sisters-Magazine Free Issue',

	'email_content' => '<!DOCTYPE html><html><html>
<head>
	<title>Sisters-Magazine</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body bgcolor="#FFFFFF">
	<table align="center" width="520" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td style="font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:14px; line-height:22px;">
					<span>Salam <strong>%s</strong></span><br /><br />
					<span>Thank you for your interest in <a href="http://sisters-magazine.com/" target="_blank">SISTERS Magazine</a>.</span><br><br>
					<span>May All bless your affairs in this life and the next.</span><br><br>
					<span>Please find a link to your download. Please click the link below, if the link does not work then please copy it into your browser.</span><br><br>
					<span>Please also remember to support our sponsors. You will receive an email shortly from our sponsors please support them by checking out the email and by trying out anything you find interesting.</span><br><br>
					<span>Some selected customers will receive a call from our marketing team with a special offer, this only takes place when there is a special promotion and stock is available, so please note you will not always receive a call with a discount from <a href="http://sisters-magazine.com/" target="_blank">SISTERS</a>.</span><br><br><br>
					<a href="%s" target="_blank">Click here to download your issue</a><br><br>
					<span>Thank you again for supporting us!</span> <br><br><br>
					<span>Was Salam</span> <br><br>
					<span>Your Sisters in Islam</span> <br><br>
				</td>
			</tr>
	</table>
	<table align="center" width="520" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td>
				<a href="http://sisters-magazine.com/">
					<img style="display:block; border:none" border="0" src="http://sisters-magazine.com/emails/referral/images/reward_01.jpg" width="500" height="55" alt="">
				</a>
			</td>
		</tr>
	</table>
</body>
</html>'
	);
?>