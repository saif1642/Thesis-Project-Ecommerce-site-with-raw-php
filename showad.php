<?php 

 include "auth.php";
 $info=new auth();
 

 $loggedin=0;
 if(isset($_SESSION['loginuserinfo']))
 {
    $userdata=$_SESSION['loginuserinfo'];
    $username=$userdata['name'];
    $breakname=explode(" ",$username);
    $showname=reset($breakname);
    //echo $showname;
    $loggedin=1;   
 }




/*get categories*/
 $pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');
 $query="SELECT * from categories";
 $statement=$pdo->prepare($query);
 $statement->execute();
 $data=$statement->fetchall();

 /*get location*/
  $qtwo="SELECT * from locations";
  $sttt=$pdo->prepare($qtwo);
  $sttt->execute();
  $ld=$sttt->fetchall();
// echo "<pre>";
//  print_r($ld);


  

if(isset($_GET['catid'])){

  $cat_id = $_GET['catid'];

  /*Get all ads*/
 $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id='$cat_id' AND a.location_id=l.location_id AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.role='member' order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $ads=$stt->fetchall(PDO::FETCH_ASSOC);


  }else if(isset($_GET['subcat_id']) && isset($_GET['catid'])){
    $subcat_id = $_GET['subcat_id'];
    $cat_id = $_GET['catid'];
     /*Get all ads*/
 $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id='$cat_id' AND a.location_id=l.location_id AND a.subcat_id='$subcat_id' AND a.subloc_id=sl.subloc_id AND a.role='member' order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $ads=$stt->fetchall(PDO::FETCH_ASSOC);

}else if(isset($_GET['location_id'])){
 $location_id = $_GET['location_id'];
     /*Get all ads*/
 $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id='$location_id' AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.role='member' order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $ads=$stt->fetchall(PDO::FETCH_ASSOC);

}else if (isset($_GET['r_submit'])) {
  $high=$_GET['high'];
  $low = $_GET['low'];
  
   $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE  a.price>='$low' AND a.price<='$high' AND a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id=l.location_id 
     AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.role='member'  order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $ads=$stt->fetchall(PDO::FETCH_ASSOC);

  
}else{

        /*Get all ads*/
         $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id=l.location_id AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.role='member' order by a.post_time desc";
         $stt=$pdo->prepare($q);
         $stt->execute();
         $ads=$stt->fetchall(PDO::FETCH_ASSOC);

}





                        
 //echo "<pre>";
 //print_r($ads);
 

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Ads.Bechakena.com</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/js/jquery-ui.css">
    <style type="text/css">
      #deals{
        animation-duration: 500ms;
        animation-name: deals;
        animation-iteration-count: infinite;
        animation-direction: alternate;
      }
      @keyframes deals{
        from{
          opacity: 1;
          color: red;
        }
        to{
          opacity: 0;
        }
      }
    </style>
</head>
<body>

  <!-- Navbar -->
 

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand wow rubberBand" data-wow-iteration="infinite" data-wow-delay="4s" href="index.php"><img src="assets/img/ec.png" class="brandlogo pull-left"></a>
                <a class="navbar-brand navbar-link wow rubberBand" href="index.php"><strong>bechakena.com</strong></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse wow zoomIn" id="navcol-1">
   
                <a class="btn btn-primary btn-sm navbar-btn navbar-right" type="button" href="postad.php">Post Advertisement</a>
                
                <?php if($loggedin){ ?>
                    <a class="btn btn-primary btn-sm navbar-btn navbar-right" type="button" href="logout.php">Log Out</a>
                <ul class="nav navbar-nav navbar-right ">
                    <li role="presentation"><a href="userprof.php"><span class="fa fa-user"></span><?php echo " ".$showname; ?></a></li>
                    
                </ul>
                <?php }else{ ?>

                
                <ul class="nav navbar-nav navbar-right ">
                    <li role="presentation"><a href="signup.php">SignUp </a></li>
                </ul>
                <?php }?>

            </div>
        </div>
    </nav>


 <!-- Advertisement Section -->

<div class="jumbotron">
  <div class="container">
  		<div class="row">
	            <!-- categories -->
	            <div class="col-sm-3 " style="background:white;">
                     <h4>Categories</h4>
                     <div class="text-right" style="padding:30px">
                      <ul class="mainmenu" style="list-style: none;padding: 0;margin: 0;">
                          <?php foreach ($data as $key){?>
                              <li>
                                  <div class="row">
                                      <a href="?catid=<?php echo $key['cat_id']?>">
                                      
                                      
                                   		<img src="<?php echo $key['icon']; ?>" alt="icon" style="max-width:20px;max-height:20px;">
                                   		<span class="label label-info"><?php echo $key['name']; ?></span>
                                   		<small class="form-text text-success" style="color: white;">
                                   		  <?php
                                   		    $cat=$key['cat_id'];
                                          $q="SELECT count(cat_id) as total FROM advertisements WHERE cat_id='$cat'";
                            						  $st=$pdo->prepare($q);
                            						  $st->execute();
                            						  $count=$st->fetch(PDO::FETCH_ASSOC);

                            						  echo "(".$count['total'].")";	
                					              ?>
                                   			
                                   		</small>
                                    
                                
                                   	  </a>

                                      




                                       <ul class="submenu" list-style: none;padding: 0;margin: 0;>
                                         <?php
                                                $cat=$key['cat_id'];
                                                $query="SELECT * from subcategories WHERE cat_id='$cat'";
                                                $statement=$pdo->prepare($query);
                                                $statement->execute();
                                                $subdata=$statement->fetchall();
                                          ?>
                                  <h5 style="text-align: center;">Subcategories</h5>

                                        <?php foreach ($subdata as $s_key){?> 
                                        <li>
                                            <a href="?catid=<?php echo $key['cat_id']?>&subcat_id=<?php echo $s_key['subcat_id']?>">
                                            <span class="label label-info"><?php echo $s_key['subname']; ?></span>
                                            <small class="form-text text-success">
                                              <?php
                                                $cat=$key['cat_id'];
                                                $subcat=$s_key['subcat_id'];
                                                $q="SELECT count(subcat_id) as total FROM advertisements WHERE subcat_id='$subcat'";
                                                $st=$pdo->prepare($q);
                                                $st->execute();
                                                $count=$st->fetch(PDO::FETCH_ASSOC);

                                                echo "(".$count['total'].")"; 
                                              ?>
                                              
                                            </small>
                                            </a>

                                        </li>
                                       <?php }?>                    

                                       
                                       </ul>
                                       

                                  </div>
                             </li>
                           <?php }?>                  	
                      </ul>
                      </div>
                  <h4>Search by location</h4>
                    <ul class="mainmenu" style="list-style: none;padding: 0;margin: 0;">
                       <?php foreach ($ld as $k){ ?>

                         <li>
                            <a href="?location_id=<?php echo $k['location_id']?>">
                            <span class="label label-info"><?php echo $k['name']; ?></span>
                            </a>
                            <ul class="submenu" list-style: none;padding: 0;margin: 0;>
                                <?php
                                      $l_id=$k['location_id'];
                                      $query="SELECT * from sublocations WHERE location_id='$l_id'";
                                      $statement=$pdo->prepare($query);
                                      $statement->execute();
                                      $sublocdata=$statement->fetchall();
                                  ?>
                            <h5 style="text-align: center;">Sublocations</h5>
                            <?php foreach ($sublocdata as $s_k){?> 
                            <li>
                            <a href="#?sublocation_id=<?php echo $s_k['subloc_id']?>">
                            <span class="label label-info"><?php echo $s_k['name']; ?></span>
                            </a>
                            </li>
                            <?php } ?>
                            </ul>

                        </li>


                    <?php } ?>

                    </ul>
                    <div class="pr_range">
                      <h4>Search by price</h4>
                     <form>
                      <div style="padding-bottom: 10px;">
                       <span>Low price:</span>
                       <input type="text" name="low">
                     </div>
                       <div style="padding-bottom: 8px;">
                       <span>High price:</span>
                       <input type="text" name="high">
                       </div>
                       <input type="submit" name="r_submit" value="Search" style="padding: 5px;width: 100%;margin-top: 7px;color: white;background-color: #18BC9C;">
                     </form>
                   
                    </div>
                


                  </div>

                   

                  
     


	            <!-- Ads -->
				<div class="col-sm-6">
					<h4 class="text-center">Advertisements</h4>
					<!-- top ads -->
					<div class="container" style="box-shadow: 5px 5px 5px rgba(55,240,170,0.4);">
						<div class="row" style="max-height:500px;background:rgba(55,240,170,0.7);">
						      <div class="col-sm-5" style="background:white;height:120px">
						      	<img src="" style="background:white">
						      </div>
						      <div class="col-sm-7">
						      	<h4>this is a ad</h4>
						      	<span class="label label-warning">Top Ad</span>
						      </div>	
						</div>
						<div class="row topad" style="max-height:500px;background:rgba(55,240,170,0.7);margin-top:10px;">
						      <div class="col-sm-5" style="background:white;height:120px">
						      	<img src="" style="background:white">
						      </div>
						      <div class="col-sm-7">
						      	<h4>this is a ad</h4>
						      	<span class="label label-warning">Top Ad</span>
						      </div>	
						</div>
					</div>

					<!-- Normal ads -->
					<?php foreach ($ads as $sh) {
                $timeago=$info->time_elapsed($sh['post_time'],true);
					?>
					
					<a  href="addetails.php?shontu=<?php echo $sh['ad_id'];?>" target="_blank">	
					<div class="row" style="max-height:500px;background:white;margin:10px;padding:10px;">
					    
					      <div class="col-sm-4">
					      	<img src="<?php echo $sh['image_url'];?>" class="img-responsive img-thumbnail" style="max-height:150px;width:150px;">
					      </div>
					      <div class="col-sm-8">
					      	<h3><span class="label label-default"><?php echo $sh['caption']; ?></span></h3>
					      	<span class="text-muted">Posted by: <?php echo $sh['username'];?> </span>
					      	<span class="label label-success"><?php echo $sh['role'];?> </span>
					      	<span class="label label-danger"><br><?php echo number_format($sh['price']);?> taka</span>
					      	<span class="text-muted"><br><br>posted <?php echo $timeago;?><br></span>
					      	<span class="text-muted "><?php echo $sh['subloc'].",".$sh['locname'];?><br><br></span>
					      </div>
					      
					</div>
					</a>	
					
                    <?php }?>

				</div>


				<div class="col-sm-3">
					<h4>Notices</h4>
          <span>Dont forget to checkout the <a href="deals.php" id="deals"><b>bechakena Deals!</b></a></span>
				</div>
	    </div>
  </div>
</div>

















<!-- Footer -->
<footer>
        <div class="row">
            <div class="col-md-4 col-sm-6 footer-navigation">
                <h3><a href="index.php">bechakena<span>.com</span></a></h3>
                <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Blog</a><strong> · </strong></strong><a href="#">About</a><strong> · </strong><a href="#">Faq</a><strong> · </strong><a href="#">Contact</a></p>
                <p class="company-name">bkdevs © 2017 </p>
            </div>
            <div class="col-md-4 col-sm-6 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p><span class="new-line-span"></span> Dhaka,Bangladesh</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left">+8801953593181</p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank">support@bechakena.com</a></p>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-4 footer-about">
                <h4>About the company</h4>
                <p>Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more&nbsp;<strong>in Bangladesh - for free</strong>! 
                </p>
                <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
            </div>
        </div>
    </footer>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script>new WOW().init();</script>

</body>
</html>