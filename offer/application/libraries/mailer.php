<?php
final class Mailer {
	protected static $to;
	protected static $from;
	protected static $sender;
	protected static $subject;
	protected static $text;
	protected static $html;
	protected static $attachments = array();
	public static $protocol = 'mail';
	public static $hostname;
	public static $username;
	public static $password;
	public static $port = 25;
	public static $timeout = 5;
	public static $newline = "\n";
	public static $crlf = "\r\n";
	public static $verp = false;
	public static $parameter = '';

	public static function setTo($to) {
		self::$to = $to;
	}

	public static function setFrom($from) {
		self::$from = $from;
	}

	public static function setSender($sender) {
		self::$sender = html_entity_decode($sender, ENT_QUOTES, 'UTF-8');
	}

	public static function setSubject($subject) {
		self::$subject = html_entity_decode($subject, ENT_QUOTES, 'UTF-8');
	}

	public static function setText($text) {
		self::$text = $text;
	}

	public static function setHtml($html) {
		self::$html = $html;
	}

	public static function addAttachment($file, $filename = '') {
		if (!$filename) {
			$filename = basename($file);
		}

		self::$attachments[] = array(
			'filename' => $filename,
			'file'     => $file
			);
	}

	public static function send() {
		if (!self::$to) {
			trigger_error('Error: E-Mail to required!');
			exit();			
		}

		if (!self::$from) {
			trigger_error('Error: E-Mail from required!');
			exit();					
		}

		if (!self::$sender) {
			trigger_error('Error: E-Mail sender required!');
			exit();					
		}

		if (!self::$subject) {
			trigger_error('Error: E-Mail subject required!');
			exit();					
		}

		if ((!self::$text) && (!self::$html)) {
			trigger_error('Error: E-Mail message required!');
			exit();					
		}

		if (is_array(self::$to)) {
			$to = implode(',', self::$to);
		} else {
			$to = self::$to;
		}

		$boundary = '----=_NextPart_' . md5(time());

		$header = '';
		
		$header .= 'MIME-Version: 1.0' . self::$newline;
		
		if (self::$protocol != 'mail') {
			$header .= 'To: ' . $to . self::$newline;
			$header .= 'Subject: ' . self::$subject . self::$newline;
		}
		
		$header .= 'Date: ' . date("D, d M Y H:i:s O") . self::$newline;
		$header .= 'From: ' . '=?UTF-8?B?' . base64_encode(self::$sender) . '?=' . '<' . self::$from . '>' . self::$newline;
		$header .= 'Reply-To: ' . self::$sender . '<' . self::$from . '>' . self::$newline;
		$header .= 'Return-Path: ' . self::$from . self::$newline;
		$header .= 'X-Mailer: PHP/' . phpversion() . self::$newline;
		$header .= 'Content-Type: multipart/related; boundary="' . $boundary . '"' . self::$newline;
		$header .= self::$newline; 

		if (!self::$html) {
			$message  = '--' . $boundary . self::$newline;
			$message .= 'Content-Type: text/plain; charset="utf-8"' . self::$newline;
			$message .= 'Content-Transfer-Encoding: 8bit' . self::$newline . self::$newline;
			$message .= self::$text . self::$newline;
		} else {
			$message  = '--' . $boundary . self::$newline;
			$message .= 'Content-Type: multipart/alternative; boundary="' . $boundary . '_alt"' . self::$newline . self::$newline;
			$message .= '--' . $boundary . '_alt' . self::$newline;
			$message .= 'Content-Type: text/plain; charset="utf-8"' . self::$newline;
			$message .= 'Content-Transfer-Encoding: 8bit' . self::$newline . self::$newline;

			if (self::$text) {
				$message .= self::$text . self::$newline;
			} else {
				$message .= 'This is a HTML email and your email client software does not support HTML email!' . self::$newline;
			}

			$message .= '--' . $boundary . '_alt' . self::$newline;
			$message .= 'Content-Type: text/html; charset="utf-8"' . self::$newline;
			$message .= 'Content-Transfer-Encoding: 8bit' . self::$newline . self::$newline;
			$message .= self::$html . self::$newline;
			$message .= '--' . $boundary . '_alt--' . self::$newline;
		}

		foreach (self::$attachments as $attachment) {
			if (file_exists($attachment['file'])) {
				$handle = fopen($attachment['file'], 'r');
				
				$content = fread($handle, filesize($attachment['file']));
				
				fclose($handle);

				$message .= '--' . $boundary . self::$newline;
				$message .= 'Content-Type: application/octetstream; name="' . basename($attachment['file']) . '"' . self::$newline;
				$message .= 'Content-Transfer-Encoding: base64' . self::$newline;
				$message .= 'Content-Disposition: attachment; filename="' . basename($attachment['filename']) . '"' . self::$newline;
				$message .= 'Content-ID: <' . basename($attachment['filename']) . '>' . self::$newline;
				$message .= 'X-Attachment-Id: ' . basename($attachment['filename']) . self::$newline . self::$newline;
				$message .= chunk_split(base64_encode($content));
			}
		}

		$message .= '--' . $boundary . '--' . self::$newline;

		if (self::$protocol == 'mail') {
			ini_set('sendmail_from', self::$from);

			if (self::$parameter) {
				mail($to, '=?UTF-8?B?' . base64_encode(self::$subject) . '?=', $message, $header, self::$parameter);
			} else {
				mail($to, '=?UTF-8?B?' . base64_encode(self::$subject) . '?=', $message, $header);
			}

		} elseif (self::$protocol == 'smtp') {
			$handle = fsockopen(self::$hostname, self::$port, $errno, $errstr, self::$timeout);

			if (!$handle) {
				trigger_error('Error: ' . $errstr . ' (' . $errno . ')');
				exit();					
			} else {
				if (substr(PHP_OS, 0, 3) != 'WIN') {
					socket_set_timeout($handle, self::$timeout, 0);
				}

				while ($line = fgets($handle, 515)) {
					if (substr($line, 3, 1) == ' ') {
						break;
					}
				}

				if (substr(self::$hostname, 0, 3) == 'tls') {
					fputs($handle, 'STARTTLS' . self::$crlf);

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 220) {
						trigger_error('Error: STARTTLS not accepted from server!');
						exit();								
					}
				}

				if (!empty(self::$username)  && !empty(self::$password)) {
					fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 250) {
						trigger_error('Error: EHLO not accepted from server!');
						exit();								
					}

					fputs($handle, 'AUTH LOGIN' . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 334) {
						trigger_error('Error: AUTH LOGIN not accepted from server!');
						exit();						
					}

					fputs($handle, base64_encode(self::$username) . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 334) {
						trigger_error('Error: Username not accepted from server!');
						exit();								
					}

					fputs($handle, base64_encode(self::$password) . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 235) {
						trigger_error('Error: Password not accepted from server!');
						exit();								
					}
				} else {
					fputs($handle, 'HELO ' . getenv('SERVER_NAME') . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if (substr($reply, 0, 3) != 250) {
						trigger_error('Error: HELO not accepted from server!');
						exit();							
					}
				}

				if (self::$verp) {
					fputs($handle, 'MAIL FROM: <' . self::$from . '>XVERP' . self::$crlf);
				} else {
					fputs($handle, 'MAIL FROM: <' . self::$from . '>' . self::$crlf);
				}

				$reply = '';

				while ($line = fgets($handle, 515)) {
					$reply .= $line;

					if (substr($line, 3, 1) == ' ') {
						break;
					}
				}

				if (substr($reply, 0, 3) != 250) {
					trigger_error('Error: MAIL FROM not accepted from server!');
					exit();							
				}

				if (!is_array(self::$to)) {
					fputs($handle, 'RCPT TO: <' . self::$to . '>' . self::$crlf);

					$reply = '';

					while ($line = fgets($handle, 515)) {
						$reply .= $line;

						if (substr($line, 3, 1) == ' ') {
							break;
						}
					}

					if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)) {
						trigger_error('Error: RCPT TO not accepted from server!');
						exit();							
					}
				} else {
					foreach (self::$to as $recipient) {
						fputs($handle, 'RCPT TO: <' . $recipient . '>' . self::$crlf);

						$reply = '';

						while ($line = fgets($handle, 515)) {
							$reply .= $line;

							if (substr($line, 3, 1) == ' ') {
								break;
							}
						}

						if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)) {
							trigger_error('Error: RCPT TO not accepted from server!');
							exit();								
						}
					}
				}

				fputs($handle, 'DATA' . self::$crlf);

				$reply = '';

				while ($line = fgets($handle, 515)) {
					$reply .= $line;

					if (substr($line, 3, 1) == ' ') {
						break;
					}
				}

				if (substr($reply, 0, 3) != 354) {
					trigger_error('Error: DATA not accepted from server!');
					exit();						
				}

				// According to rfc 821 we should not send more than 1000 including the CRLF
				$message = str_replace("\r\n", "\n",  $header . $message);
				$message = str_replace("\r", "\n", $message);
				
				$lines = explode("\n", $message);
				
				foreach ($lines as $line) {
					$results = str_split($line, 998);
					
					foreach ($results as $result) {
						if (substr(PHP_OS, 0, 3) != 'WIN') {
							fputs($handle, $result . self::$crlf);
						} else {
							fputs($handle, str_replace("\n", "\r\n", $result) . self::$crlf);
						}							
					}
				}
				
				fputs($handle, '.' . self::$crlf);

				$reply = '';

				while ($line = fgets($handle, 515)) {
					$reply .= $line;

					if (substr($line, 3, 1) == ' ') {
						break;
					}
				}

				if (substr($reply, 0, 3) != 250) {
					trigger_error('Error: DATA not accepted from server!');
					exit();						
				}
				
				fputs($handle, 'QUIT' . self::$crlf);

				$reply = '';

				while ($line = fgets($handle, 515)) {
					$reply .= $line;

					if (substr($line, 3, 1) == ' ') {
						break;
					}
				}

				if (substr($reply, 0, 3) != 221) {
					trigger_error('Error: QUIT not accepted from server!');
					exit();						
				}

				fclose($handle);
			}
		}
	}
}
?>
