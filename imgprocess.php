<?php 

//print_r($_POST);
session_start();
include "geo.php";
$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');



if(isset($_POST['done']))
{
    unset($_POST['done']);
	//echo "Button clicked";
     $file= $_FILES['icon'];
     //echo "<pre>";
     //print_r($file);

     //category name and description variables
     $categoryname=$_POST['catname'];
     $description=$_POST['des'];


     //File  variables
     $filename=$file['name'];
     $filetype=$file['type'];
     $tmploc=$file['tmp_name'];
     $filesize=$file['size'];
     $filerror=$file['error'];


     //getting into pieces
     $filext=explode('.',$filename); //string k divide kore
     $actualext=strtolower(end($filext));
     $allowed=['jpg','jpeg','png'];

     if(in_array($actualext,$allowed))
     {
     	if($filerror===0)
     	{
     		if($filesize<5000000)
     		{
     			$newfilename=uniqid('',true).".".$actualext;
     			$filedest= "images/".$newfilename;
     			

     			$query="INSERT INTO categories(name,description,icon) values('$categoryname','$description','$filedest')";
                $stmt = $pdo->prepare($query);
                $status=$stmt->execute();

                if($status)
                {
                	move_uploaded_file($tmploc,$filedest);
                	header("Location:adminoperation.php?oper=add_cat");

                }
                else
                {
                	header("Location:adminoperation.php?unsuccessful!");

                }

     			
     		}
     		else
     		{
     			echo "File is too big!";
     		}
     	}


     }
     else
     { 
     	echo "Only upload Image of jpg jpeg and png format";

     }



}




/*Post ad subcat add*/

if (isset($_POST['catIdsent'])) 
{

        $catId= $_POST['catIdsent'];
        $sql= "SELECT * FROM subcategories where cat_id='$catId'";
        $st = $pdo->prepare($sql);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        unset($_POST['catIdsent']);

       echo json_encode($result);

}


/*sublocation add*/

if (isset($_POST['locIdsent'])) 
{

        $locId= $_POST['locIdsent'];
        $sql= "SELECT * FROM sublocations where location_id='$locId'";
        $st = $pdo->prepare($sql);
        $st->execute();
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        unset($_POST['locIdsent']);

       echo json_encode($result);


}



/*post ad*/

if(isset($_POST['adprocess']))
{
    unset($_POST['adprocess']);
    echo "<pre>";
    //print_r($_POST);
    
    $file= $_FILES['icon'];
    $userinfo=$_SESSION['loginuserinfo'];
    //print_r($userinfo);
    
    //User infos
    $userid=$userinfo['user_id'];
    $role=$userinfo['role'];

    //other infos
    $catid=$_POST['cat_id'];
    $subcatid=$_POST['subcat_id'];
    $locid=$_POST['loc_id'];
    $sublocid=$_POST['subloc_id'];
    $caption=$_POST['caption'];
    $description=$_POST['des'];
    $cond=$_POST['condition'];
    $price=$_POST['price'];
    $nego=$_POST['negotiable'];
    $phone=$_POST['phone'];

    //image File  variables
     $filename=$file['name'];
     $filetype=$file['type'];
     $tmploc=$file['tmp_name'];
     $filesize=$file['size'];
     $filerror=$file['error'];


     //getting into pieces
     $filext=explode('.',$filename); //string k divide kore
     $actualext=strtolower(end($filext));
     $allowed=['jpg','JPG','JPEG','PNG','jpeg','png'];

     if(in_array($actualext,$allowed))
     {
        if($filerror===0)
        {
            
                $newfilename=uniqid('',true).".".$actualext;
                $filedest= "ads/".$newfilename;
        

                $timezone="Asia/Dhaka";
                date_default_timezone_set($timezone);
                $postdate=date('y-m-d h:i:sa');

                $query="INSERT INTO  advertisements VALUES (NULL,'$userid','$catid','$subcatid','$locid','$sublocid','$role','$caption','$description','$cond','$price','$postdate','$phone','$filedest','$nego')";
               $stmt = $pdo->prepare($query);
               $status=$stmt->execute();

                if($status)
                {
                    move_uploaded_file($tmploc,$filedest);
                    header("Location:showad.php?Success!");

                }
                else
                {
                    header("Location:showad.php?unsuccessful!");

                }            
            
        }


     }
     else
     { 
        echo "Only upload Image of jpg jpeg and png format";

     }



}




      /* $allowed=['jpg','jpeg','png'];
      for ($i=0; $i <count($allowed) ; $i++) { 
             echo $allowed[$i];
             echo "<br>";
      	
      }
     */


 ?>





