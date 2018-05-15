<?php 

include("auth.php");
$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');


/*For registration*/
if(isset($_POST['regprocess']))
{

    unset($_POST['regprocess']);
	$object = new auth();
    $object->setdata($_POST)->store();
    //print_r($_POST);
}



/*for login*/

if(isset($_POST['loginsubmit']))
{
     unset($_POST['loginsubmit']);
     $info=new auth();
     $info->login($_POST);


}


/*report ads*/
if(isset($_POST['reportsubmit']))
{
     unset($_POST['reportsubmit']);
     $adid=$_GET['adid'];
     unset($_GET['adid']);
     $email=$_POST['email'];
     $description=$_POST['description'];

      $qr="INSERT INTO report(ad_id,email,description) values('$adid','$email','$description')";
      $stmt = $pdo->prepare($qr);
      $stat=$stmt->execute();
      if($stat)
                {
                    $_SESSION['report']="successful";
                    header("Location:addetails.php?shontu=".$adid."");

                }


     
     
}

/*Order submits*/
if(isset($_POST['ordersubmit']))
{
     unset($_POST['ordersubmit']);
     $adid=$_GET['adid'];
     unset($_GET['adid']);
     $orderer=$_POST['oname'];
     $phone=$_POST['ophone'];

      $qo="INSERT INTO orders(ad_id,orderer,phone) values('$adid','$orderer','$phone')";
      $stmt = $pdo->prepare($qo);
      $sta=$stmt->execute();
      if($sta)
                {
                    $_SESSION['order']="successful";
                    header("Location:addetails.php?shontu=".$adid."");

                }
    
}


/*Delete orders*/
if(isset($_GET['delid']))
{
    $oid=$_GET['delid'];
    unset($_GET['delid']);
    //echo $oid;
    $delquery="DELETE FROM orders WHERE o_id=$oid";
    $stats=$pdo->prepare($delquery);
    $stats->execute();
    header("Location:userprof.php?order_confirmed!");

}



/*admin subcat add part*/
if(isset($_POST['subcat_add']))
{

    //print_r($_POST);
     $catid=$_POST['selcat'];
     $subname=$_POST['subname'];


    $query="INSERT INTO subcategories(cat_id,subname) values('$catid','$subname')";
    $stmt = $pdo->prepare($query);
    $status=$stmt->execute();
    if($status)
                {
                    header("Location:adminoperation.php?oper=add_subcat");

                }
                else
                {
                    header("Location:adminoperation.php?unsuccessful!");

                }

}


















 ?>