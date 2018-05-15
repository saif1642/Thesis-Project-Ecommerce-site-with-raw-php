<?php 
$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');





if(isset($_POST['user_email']))
{
	$email=$_POST['user_email'];
    

    $query="SELECT * FROM users WHERE email='$email' ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchall();

    if(count($result)>0)
    {
       echo "Email Already used!";
    }
    else
    {
    	echo "Email available";
    }


    exit();

}















?>