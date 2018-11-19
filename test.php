<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="mdcstyle.css" />
<title>Submission form</title>

<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type='text/javascript'>
//<![CDATA[
 $(document).ready(function() {
  var currentItem = 0;
  $('#addnew').click(function(){
   currentItem++;
   $('#items').val(currentItem);
var strToAdd = '<tr><td>Area:<input class="textfield"  name="area['+currentItem+']" id =" area['+currentItem+']" type="text" /></td><td>Contractor:<input class="textfield"  name="contractor['+currentItem+']" id ="contractor['+currentItem+']"type="text" /></td></tr>';
   $('#data').append(strToAdd);

  });
 });

//]]>
</script>

</head>

<body>
  <?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);

 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }


 if($error == '')
 {
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Gewoon bedankt ofzo voor de inzending</label>';
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Upload</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Beheer videos</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Artist Name</label>
      <input type="text" name="name" placeholder="ArtistName" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Song Name</label>
      <input type="text" name="email" class="form-control" placeholder="SongTitle" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <label>Enter PlaybackId</label>
      <input type="text" name="subject" class="form-control" placeholder="PlaybackId" value="<?php echo $subject; ?>" />
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>

</body>


</html>
