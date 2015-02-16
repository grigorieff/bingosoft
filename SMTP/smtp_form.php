<?php 
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');
	function smtpmail($to, $subject, $content, $attach=false)
	{
require_once('config.php'); //путь до конфигурационного файла для вашего smtp сервера
require_once('class.phpmailer.php'); //путь до класса phpmailer
$mail = new PHPMailer(true);

$mail->IsSMTP();
echo $to."<br />".$subject."<br />".$content."<br />";
try {
  $mail->Host       = $__smtp['host']; 
  $mail->SMTPDebug  = $__smtp['debug']; 
  $mail->SMTPAuth   = $__smtp['auth'];
  $mail->Port       = $__smtp['port']; 
  $mail->Username   = $__smtp['username'];
  $mail->Password   = $__smtp['password'];
  $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
  $mail->AddAddress($to);
  $mail->SetFrom($__smtp['addreply'], $__smtp['username']);
  $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
  $mail->Subject = mb_encode_mimeheader($subject);
  $mail->MsgHTML($content);
  if($attach)  $mail->AddAttachment($attach);
  $mail->Send();
  echo "Message sent Ok!</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); 
} catch (Exception $e) {
  echo $e->getMessage(); 
}
	}
	if($_POST['msgsent']!=1 || empty($_POST['to']) ||  empty($_POST['subject']) || empty($_POST['content']))
	{
?>
		<form action = "smtp_form.php" method = "POST">
		<input type = "hidden" name = "msgsent" value = "1" />
		Кому:			<input type = "text" name = "to" value = "" /><br />
		Тема:	<input type = "text" name = "subject" value = "" /><br />
		Текст сообщения:<br />
					<textarea cols = "40" rows = "5" name = "content"></textarea><br />
		<input type = "submit" value = "Отправить письмо" />
		</form>
<?php
	}else{
		smtpmail($_POST['to'], $_POST['subject'], $_POST['content']);
	}
?>	