# PHP-Contact-Form-to-Email
PHP Contact Form that sends to Email

#### JS Dependencies:
- gen_validatorv31.js

#### PHP Dependencies:
- form-to-email.php

 #### The JS Validation script:
 
```js
var frmvalidator  = new Validator("contact");
frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
frmvalidator.addValidation("comment","req","Please provide a comment"); 
```

#### The HTML
```html
<form method="post" name="contact" action="php-form/form-to-email.php">
      <legend>Drop us a line and we will get back to you asap.</legend>
<div class="form-group">
              <label for="name">Name: <span class="asterix">*</span></label>
              <input id="" name="name" class="form-control" required />
          </div>
          <div class="form-group">
              <label for="email">Email: <span class="asterix">*</span></label>
              <input id="email" name="email" type="email" class="form-control"  />
          </div>
          <div class="form-group">
              <label for="enquiry">Enquiry type: <span class="asterix">*</span></label>
              <select id="select" name="select" class="form-control" required >
                  <option value="1"></option>
                  <option value="2">general enquiry</option>
                  <option value="3">information about online sales</option>
                  <option value="4">how can my shop stock scientifik products</option>
                  <option value="5">sponsorship enquiry</option>
                  <option value="6">other</option>
              </select>
          </div>
          <div class="form-group">
              <label for="comment">Comment: <span class="asterix">*</span></label>
              <textarea rows="7" cols="20" name="comment" class="form-control" required></textarea> 
          </div>
      <input type="submit" name="submit" value="submit" class="btn btn-md btn-default submit">                
  </form>
  ```
#### The PHP File:
```php
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
```
