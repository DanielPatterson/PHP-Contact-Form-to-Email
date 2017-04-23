<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}

$name = $_POST['name'];
$email = $_POST['email'];
$select = $_POST['select'];
$comment = $_POST['comment'];

//Validate first
if(empty($email)) 
{
    echo "email is mandatory!";
    exit;
}

if(IsInjected($email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'yourname@yoursite.com.au';//<== update the email address
$email_subject = "contact form";
$email_body = "Name:\n $name //-> ".
              "Email:\n $email //-> ".
			  "Subject:\n $select //-> ".
			  "Comment:\n $comment //-> ".
    
$to = "youremail@address.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: php-form/thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 