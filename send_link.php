<?php
session_start();
include 'DB_CONN.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['send']) && $_POST['usuario'])
{

    
$query = 'select * from users where username='.'"'.$_POST['usuario'].'"';
$query = $db->query($query);

  if(mysqli_num_rows($query)==1)
  {
    while($row = $query ->fetch_assoc() )
    {
    
    $email=md5($row['userName']);
    $pass=md5($row['password']);
    
    $link="<a href='https://harman-cert.com//reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
  
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet =  "utf-8";
        $mail->SMTPAuth = true;             
        $mail->SMTPDebug = 2;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

   
        $mail->Host = "smtp.gmail.com"; 
        $mail->Port = "587";
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "smtp";

 

    $mail->Username = "ces.pertel@gmail.com";
    $mail->Password = "rxlujugwzlfamhuz";
    

    $mail->setFrom('ces.pertel@gmail.com', 'ADMIN'); 
    $mail->addAddress($row['userName'], 'DEAR TRAINER');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
           echo "Check Your Email and Click on the link sent to your email";

     
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
  }
}
?>