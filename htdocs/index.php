<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css.css">
	<title>Share YouTube video</title>
</head>
<body>

<h1>Share YouTube video</h1>

<!-- Message board form -->
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
Type YouTube URL:<br/>
<input name="message" size="60">
</input>
<input type="submit" value="Share Now!">
</form>
<!-- /Message board form -->

<?php
// Check invalid or valid & change the text file
@$message = $_POST['message'];

if(isset($_POST['message'])) {

	if (preg_match("/(\/youtube.com)|(\/www.youtube.com)|(\/m.youtube.com)|(\/youtu.be)/", $message)) {
	$fp = fopen("price.txt", "w");
	fwrite($fp, "$message");
	fclose($fp);

	    echo '<b style="color:blue;">' , "Valid YouTube URL. Your video has been posted." , "</b>";
	} else {
	    echo '<b style="color:red;">' , "Invalid YouTube URL" , "</b>";
	}

}
?>

<br/><br/>

<?php
$fp = fopen("price.txt", "r");
while ($line = fgets($fp)) {

// picking up Youtube video ID by regurar expression
$url = $line;
preg_match('/([-\w]{11})/',$url,$match);
$id = $match[1];

echo '<a href="',"https://www.youtube.com/watch?v=", "$id" , '" />' , "Watch the video on YouTube" , '</a><br />';

echo '<div class="movie-wrap"><iframe width="560" height="315" src="https://www.youtube.com/embed/' , "$id" , '"' , 'frameborder="0" allowfullscreen></iframe></div>' ;

}
fclose($fp);
?>

</body>
</html>