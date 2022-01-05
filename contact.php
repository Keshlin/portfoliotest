<?php 

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$mailFrom = $_POST['mail'];
	$message = $_POST['message'];

	$mailTo = "kpillay091@gmail.com";
	$headers = "From: ".$mailFrom;
	$txt = "You have an email from ".$name.".\n\n".$message;


	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$secretKey = "6Lc3S-kdAAAAAGimYC9OUObC_6vH32ZDRSjgIHHU ";

	$response = file_get_contents($url."?secret=".$secretKey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

	$data = json_decode($response);

	if($data->success){
		mail($mailTo, $txt, $headers);
		header('Location: index.php?CaptchaPass=True');
	}
	else{
		header('Location: index.php?CaptchaFail=True');
	}


	
}

?>