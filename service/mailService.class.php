<?php

require_once dirname ( __FILE__ ) . '/../tools/phpmailer/class.phpmailer.php';

class MailService {

	private $host = "smtp.163.com";
	private $userName = "horse_dreamer@163.com";
	private $password = "horse2014dreamer";
	
	// 给一组email发邮件，携带附件
	public function sendEmail($emails, $subject, $content, $attachments) {
		
		date_default_timezone_set ( 'UTC' );
		$mail = new PHPMailer ();
		$mail->IsSMTP ();
		$mail->Host = $this->host;
		$mail->SMTPAuth = true;
		$mail->CharSet = "UTF-8";
		$mail->Username = $this->userName;
		$mail->Password = $this->password;
		$mail->From = $this->userName;
		$mail->FromName = "欣欣网站制作";
		foreach($emails as $email) {
			$mail->AddAddress ( $email );
		}
		$mail->WordWrap = 50;
		foreach($attachments as $attachment) {
			$mail->AddAttachment($attachment);
		}
		$mail->IsHTML ( true );
		$mail->Subject = $subject;
		$mail->Body = $content;
		if (! $mail->Send ()) {
			return false;
		}
		return true;
		
	}
	
	// 有人申请建站，给admin发邮件
	public function sendToAdminEmail($username) {
		
		$emails = array();
		$emails[0] = "channingbreeze@163.com";
		
		$attachments = array();
		
		$subject = $username . "申请了建站";
		$content = $username . "申请了建站，快前往<a href='http://www.xinxinweb.xyz'>http://www.xinxinweb.xyz</a>查看吧";
		
		$this->sendEmail($emails, $subject, $content, $attachments);
		
	}
	
	public function sendToUserEmail($username) {
		
		$emails = array();
		$emails[0] = $username;

		$attachments = array();
		
		$subject = "欣欣网站制作";
		$content = "尊敬的用户，感谢您选择欣欣网站制作，您提交的需求我们已经收到，我们会在第一时间与您联系，谢谢！";
		
		$this->sendEmail($emails, $subject, $content, $attachments);
		
	}
	
}

?>
