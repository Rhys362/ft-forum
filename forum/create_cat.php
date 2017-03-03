<?php
//create_cat.php
include 'header.php';
include 'connect.php';
echo '<h2>Create a Category</h2>';
if($_SESSION['user_level'] < 1)
	{
		echo'Only an administrator can create a new category.';
	}
	else
	{
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	
    //the form hasn't been posted yet, display it
    echo '<form method="post" action="">
        Category name: <input type="text" name="cat_name" />
        Category description: <textarea name="cat_description" /></textarea>
        <input type="submit" value="Add category" />
     </form>';
}
else
{
	//form posted without errors so save to database
	mysqli_query($sql, "INSERT INTO forum.categories(cat_name, cat_description) 
       VALUES('".mysqli_real_escape_string($sql, $_POST['cat_name'])."', '". mysqli_real_escape_string($sql, $_POST['cat_description'])."')"); 
	
	if($sql)
	{
		echo 'New category added.';
		
	}
	else
	{
		//uh-oh, something went wrong, show the error
		echo 'Error' .mysqli_error();
	}
	
	
	
    
}
	}
	
?>