<?php
if(!isset($_SESSION))
{
session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>FreeThinking Forum</title>
    <link rel="stylesheet" href="forumstylesheet.css" type="text/css">
</head>
<body>
<h1><img src = "/forum/logoforum.png" alt = "logo" height = "200px" weight = "200px"></h1>
    <div id="wrapper">
	<div id="menu">
        <a class="item" href="/forum/index.php">Home</a> -
        <a class="item" href="/forum/create_topic.php">Create a topic</a> -
        <a class="item" href="/forum/create_cat.php">Create a category</a>
         
        <div id="userbar">	
        
		<?php 
		
    if(isset($_SESSION['signed_in']))
	{
			echo 'Hello '  .$_SESSION['user_name'] . '. Not you? <a class ="item" href="signout.php">Sign out</a>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign in</a> or <a class="item" href="signup.php">Create an account</a>.';
		}
	?>
	
    </div>
		
		
        <div id="content">
		
		