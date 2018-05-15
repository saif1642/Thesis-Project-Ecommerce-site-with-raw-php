<?php 
include "auth.php";
$info=new auth();
$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');

if (!(isset($_SESSION['loginuserinfo']))) 
{
	header("location:index.php?unauthorized_try");
}

$userdata=$_SESSION['loginuserinfo'];
//print_r($userdata);

$username=$userdata['name'];
$role=$userdata['role'];
$join=$userdata['join_date'];
$phone=$userdata['phone'];
$userid=$userdata['user_id'];
$timelapsed=$info->time_elapsed($join,true);
//echo $timelapsed;



/*Get all ads*/
 $q="SELECT u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id=l.location_id AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.user_id='$userid' order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $ads=$stt->fetchall(PDO::FETCH_ASSOC);
 $num_of_ads=count($ads);

/*get orders*/
$qorder="SELECT a.caption,a.image_url,a.price,a.user_id,a.ad_id,o.orderer,o.phone,o.o_id FROM advertisements a,orders o WHERE o.ad_id=a.ad_id AND a.user_id=$userid";
$orders=$pdo->prepare($qorder);
$orders->execute();
$orderlist=$orders->fetchall(PDO::FETCH_ASSOC);
$num_of_orders=count($orderlist);
//print_r($orderlist);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userprofile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/userprof.css">
    <style type="text/css">
      #ordernotice{
        animation-duration: 1500ms;
        animation-name: orders;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        margin-left:50px; 
      }
      @keyframes orders{
        from{
          opacity: 1;
          color: red;
        }
        to{
          opacity: 0;
        }
      }
    </style>


     <script type="text/javascript">
      function deleteme(id)
      {
        if(confirm("Are you sure deal is done?"))
        {
          window.location.href='processes.php?delid=' +id+ '';
          return true;
        }
      }
    </script>
    

</head>
<body>
<!-- navbar -->
 <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand wow rubberBand" data-wow-iteration="infinite" data-wow-delay="4s" href="#"><img src="assets/img/ec.png" class="brandlogo pull-left"></a>
                <a class="navbar-brand navbar-link wow rubberBand" href="index.php"><strong>bechakena.com</strong></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse wow zoomIn" id="navcol-1">
                <a class="btn btn-warning btn-sm navbar-btn navbar-right" type="button" href="showad.php">See Ads</a>
                <a class="btn btn-primary btn-sm navbar-btn navbar-right" type="button" href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>
 


     <!-- Profile INfo -->

  <div class="container" style="max-width:700px;">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="login.png">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <img alt="" src="login.png">
        </div>
        <div class="card-info"> <span class="card-title"><?php echo strtoupper($username); ?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab">
                <div class="hidden-xs">Information</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab">
                <div class="hidden-xs">Favorites</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab">
                <div class="hidden-xs">My advertisements</div>
            </button>
        </div>
        <?php if($role==="dealer"){ ?>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab">
                <div class="hidden-xs">Orders</div>
            </button>
        </div>
        <?php } ?>
    </div>

     <div class="well">
      <div class="tab-content">

        <div class="tab-pane fade in active" id="tab1">
          
          <div class="container ">
		          <h4>User Information</h4>
		          <h6>Role: </h6>
		          <span class="label label-success"><?php echo $role; ?></span>
		          <h6>Phone: </h6>
		          <span class="label label-success"><?php echo $phone; ?></span>
		          <h6>joined: </h6>
		          <span class="label label-success"><?php echo $timelapsed; ?></span>


		          <h6>Join date: </h6>
		          <span class="label label-success"><?php echo $join; ?></span>

          </div>
          

        </div>

        <div class="tab-pane fade in" id="tab2">
          <h4>No bookmarks yet</h4>
        </div>

        <div class="tab-pane fade in" id="tab4">
         
            <?php 
            if ($num_of_orders>0){
                foreach ($orderlist as $sh) { ?>
                   <span class="text-success" id="ordernotice">Hit Confirm Order after confirming the orders manually by contacting the orderer<br><br></span>
                 
                    <div class="row" style="max-height:600px;background:white;margin:10px;padding:20px">
                          <div class="col-sm-4">
                            <img src="<?php echo $sh['image_url'];?>" class="img-responsive img-thumbnail" style="max-height:150px;width:150px;">
                          </div>
                          <div class="col-sm-8">
                            <span class="label label-primary">Order id# <?php echo $sh['o_id'];?></span>
                            <h4><span class="label label-default"><?php echo $sh['caption']; ?></span></h4>
                            <span class="label label-danger"><?php echo $sh['price'];?> taka</span>
                            <button class="btn btn-sm btn-warning" style="margin-left:250px;" onclick="deleteme(<?php echo $sh['o_id'];?>)">Confirm Order</button>

                            
                            <h3><span class="label label-success">Ordered by: <?php echo $sh['orderer'];?></span>
                            <span class="label label-success"><br>Phone Num: <?php echo $sh['phone'];?><br></span></h3>
                            
                            
                          </div>    
                    </div>
           
             <?php }
             }?>
             
             <?php
             if ($num_of_orders==0) { ?>
                <h4>No orders to show now</h4>
             <?php }?>

        </div>

        <!-- ads posted -->

        <div class="tab-pane fade in" id="tab3">
           


          <?php 
            if ($num_of_ads>0){
                foreach ($ads as $sh) {
                            $timeago=$info->time_elapsed($sh['post_time'],true);
                        ?>
                    <div class="row" style="max-height:500px;background:white;margin:10px;">
                          <div class="col-sm-4">
                            <img src="<?php echo $sh['image_url'];?>" class="img-responsive img-thumbnail" style="max-height:150px;width:150px;">
                          </div>
                          <div class="col-sm-8">
                            <h3><span class="label label-default"><?php echo $sh['caption']; ?></span></h3>
                            <span class="label label-success"><?php echo $sh['role'];?> </span>
                            <span class="label label-danger"><br><?php echo $sh['price'];?> taka</span>
                            <span class="text-muted"><br><br>posted <?php echo $timeago;?><br></span>
                            <span class="text-muted "><?php echo $sh['subloc'].",".$sh['locname'];?><br><br></span>
                          </div>    
                    </div>
           
             <?php }
             }?>
             
             <?php
             if ($num_of_ads==0) { ?>
                <h4>No ads posted by you</h4>
                <span><a href="postad.php">Lets post some ads!</a></span>
             <?php }?>


        </div>

      </div>
    </div>
    
  </div>
    













    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    
    <script type="text/javascript">
    	$(document).ready(function() {
               $(".btn-pref .btn").click(function () {
                  $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                  $(this).removeClass("btn-default").addClass("btn-primary");   
                 });
         });
    </script>

   


   </body>
 </html>