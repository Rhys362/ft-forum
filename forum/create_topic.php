<?php
session_start();
//create_topic.php
include 'connect.php';
include 'header.php';

echo'<h2>Create a topic</h2>';
if(!isset($_SESSION['signed_in']))
{
	//user is not signed in
	echo'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';

	}
	else
	{
		//user is signed in
		if($_SERVER['REQUEST_METHOD'] !='POST')
		{
			//the form hasn't been posted yet, display it
			//retrieve the categories from the database for use in the dropdown
			$result = mysqli_query($sql, "SELECT * FROM forum.categories");
			
			if(mysqli_num_rows($result) >= 1)
			{
				echo'<form method="post" action="">
				Subject: <input type="text" name="topic_subject" />
				Category:';
				
				echo'<select name="topic_cat">';
				while($row = mysqli_fetch_assoc($result))
				{
					echo'<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
				}
				echo'</select>';
				
				echo'Message: <textarea name="post_content" /></textarea>
				<input type="submit" value="Create topic" />
				</form>';
				
			}
			else
			{
				
				if(mysqli_num_rows($result) == 0)
				
			{
			
				if($_SESSION['user_level'] >= 1)
				{
					echo'You have not created any categories yet.';
				}
				else 
				{
					
					echo'Before you can post a topic, you must wait for an admin to create a category.';
				}
				
			}
		}
	}
}
			
include 'footer.php';

?>