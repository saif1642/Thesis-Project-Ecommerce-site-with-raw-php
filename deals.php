<?php
 include "auth.php";
 $info=new auth();


/*get categories*/
 $pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');
 $query="SELECT * from categories";
 $statement=$pdo->prepare($query);
 $statement->execute();
 $data=$statement->fetchall();
 

 /*Get all deals*/
 $q="SELECT a.ad_id,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id=l.location_id AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.role='dealer' order by a.post_time desc";
 $stt=$pdo->prepare($q);
 $stt->execute();
 $deals=$stt->fetchall(PDO::FETCH_ASSOC);
 /*echo "<pre>";
 print_r($ads);*/


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

            </div>
        </div>
    </nav>

 <div class="jumbotron text-success" style="margin-top:-30px">
    <div class="container">
       <b><h2>Bechakena Deals!</h2></b>
    </div>
 </div>


 <!--Deals section -->

<div class="jumbotron" style="margin-bottom:20px;margin-left:200px;margin-right:200px">
  <div class="container">
      <div class="row">
              
         <!-- Deals -->
        <div class="container">
          <h4 class="text-center"><b>Deals waiting for orders!</b></h4>
          	<!-- Deals -->
					<?php foreach ($deals as $sh) {
                            $timeago=$info->time_elapsed($sh['post_time'],true);
						?>
					
					<div class="row" style="max-height:500px;background:white;margin:10px;padding:10px;">
					    <a  href="addetails.php?shontu=<?php echo $sh['ad_id'];?>" target="_blank">	
					      <div class="col-sm-4">
					      	<img src="<?php echo $sh['image_url'];?>" class="img-responsive img-thumbnail" style="max-height:150px;width:150px;">
					      </div>
					      <div class="col-sm-8">
					      	<h3><span class="label label-default"><?php echo $sh['caption']; ?></span></h3>
					      	</a>
					      	<span class="text-muted">Posted by: <?php echo $sh['username'];?> </span>
					      	<span class="label label-success"><?php echo $sh['role'];?> </span>
					      	<span class="label label-danger"><br><?php echo number_format($sh['price']);?> taka</span>
					      	<span class="text-muted"><br><br>posted <?php echo $timeago;?><br></span>
					      	
					      	<a class="btn btn-success" style="margin-top:10px" onclick="document.getElementById('orderform').style.display='block'">Order Now!</a>
					      </div>
					      
					</div>
						
					
                    <?php
                         $adid=$sh['ad_id'];
                     }?>


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

    
 <!-- Order Form -->
<div id="orderform" class="modal animate text-center">
  
  
    <div class="">
      <span onclick="document.getElementById('orderform').style.display='none'" class="close" title="Close form">x</span>
    </div>

    <div class="jumbotron container" style="max-width:500px;">
      <h2 style="margin-bottom:40px">Place your Order here</h2>
      
      <form action="processes.php?adid=<?php echo $adid;?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Please Insert your Name</label>
            <input type="text" class="form-control" name="oname" id="oname" required="true" placeholder="Orderer's Name" autofocus="autofocus">
          </div>
          <div class="form-group">
            <label for="caption">Phone Number</label>
            <input type="text" name="ophone" id="ophone" class="form-control" maxlength="11"  onkeyup="digitscheck(this)">
            <small id="desHelpBlock" class="form-text text-success">

            <br>You will get a call from the seller,Pay when delivered!
            </small>
          </div>
          <button type="submit" class="btn btn-success" name="ordersubmit">Place Order</button>
     </form>
    </div>
</div>








    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script>new WOW().init();</script>

	<!-- check digits -->
	<script type="text/javascript">
	    function digitscheck(inp)
	    {
	        var check= /[^0-9]/gi;
	        inp.value=inp.value.replace(check,"");

	    }

	</script>


</body>
</html>