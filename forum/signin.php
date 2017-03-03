<?php
if(!isset($_SESSION))
{
session_start();
}
//signin.php
include 'connect.php';
include 'header.php';

echo '<h3>Sign in</h3>';

//check if user is already signed in
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	echo 'You are already signed in, you can <a href="signout.php">sign out here</a> if you want.';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//form hasn't been posted yet, display it
	echo '<form method="post" action="">
	Username: <input type="text" name="user_name"/>
	Password: <input type="password" name="user_pass">
	<input type="submit" value="Sign in"/>
	</form>';
	}
	else
	{
		//process the data
		$errors = array();
		
		if(!isset($_POST['user_name']))
		{
			$errors[] = 'The username field must not be empty.';
		}
		
		if(!isset($_POST['user_pass']))
		{
			$errors[] = 'The password field must not be empty.';
		}
		
		if(!empty($errors))
		{
			echo 'Uh-oh.. a couple of fields are not filled in correctly..';
			echo '<ul>';
			foreach($errors as $key => $value)
			{
				echo '<li>' .$value . '</li>';
			}
			echo '</ul>';
		}
		else
		{
			//no errors so save data
			$result = mysqli_query($sql, "SELECT 
			user_id,
			user_name,
			user_level
			FROM forum.users WHERE
			user_name = '" . mysqli_real_escape_string($sql, $_POST['user_name']) . "'
			AND user_pass = '" . sha1($_POST['user_pass']) . "'");
			
				
			
			
			if(!$result)
			{
			 //something went wrong, display the error
                echo 'Something went wrong while signing in. Please try again later.';
                //echo mysql_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                //the query was successfully executed, there are 2 possibilities
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong
                if(mysqli_num_rows($result) == 0)
                {
                    echo 'You have entered an incorrect username or password. Please try again.';
                }
                else
                {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                     
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
						$_SESSION['user_level']    = $row['user_level'];
                    }
				
				echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="index.php">Proceed to the forum overview</a>.';
				}
			}
		}
	}
}


include 'footer.php';
?>