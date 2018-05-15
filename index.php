<?php 
 
 session_start();
 $pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');
 $query="SELECT * from categories";
 $statement=$pdo->prepare($query);
 $statement->execute();
 $data=$statement->fetchall();


 // get top categories
 $sq="SELECT cat_id,count(cat_id) AS total
    FROM advertisements
    GROUP BY cat_id
    ORDER BY count(cat_id) DESC
    LIMIT 4";
 $top=$pdo->prepare($sq);
 $top->execute();
 $topc=$top->fetchall();
 //print_r($topc);
 

 
 $colcount=0;
 $maxcol=4;
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
 //echo $loggedin;


?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bechakena.com</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <!-- alert box -->
    <script>
         function logsuccess() {
                      alert("Login successful! welcome <?php echo $userdata['name']; ?>");


                 }
         function logfail() {
                      alert("Login Failed, Please insert correct info");
                 }
        
    </script>
    <script type="text/javascript">
         function postad() {
                      alert("Please Login to post Advertisement");
                 }
    </script>

</head>

<body>
    


    <?php 
         if(isset($_SESSION['Loginsuccess']))
         {
            unset($_SESSION['Loginsuccess']);
            echo "<script>logsuccess();</script>";
        

         }
         if(isset($_SESSION["Loginfailed"]))
         {
            unset($_SESSION["Loginfailed"]);
            echo "<script>logfail();</script>";

         }
         if (isset($_SESSION['Msg'])) {
            unset($_SESSION['Msg']);
            echo "<script>postad();</script>";
         }

       
     ?>

  <!-- Navbar -->
 

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand wow rubberBand" data-wow-iteration="infinite" data-wow-delay="4s" href="#"><img src="assets/img/ec.png" class="brandlogo pull-left"></a>
                <a class="navbar-brand navbar-link wow rubberBand" href="#"><strong>bechakena.com</strong></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse wow zoomIn" id="navcol-1">
                <a class="btn btn-warning btn-sm navbar-btn navbar-right" type="button" href="showad.php">See Ads</a>
                <a class="btn btn-primary btn-sm navbar-btn navbar-right" type="button" href="postad.php">Post Advertisement</a>
                
                <?php if($loggedin){ ?>
                    <a class="btn btn-primary btn-sm navbar-btn navbar-right" type="button" href="logout.php">Log Out</a>
                <ul class="nav navbar-nav navbar-right ">
                    <li role="presentation"><a href="userprof.php"><span class="fa fa-user"></span><?php echo " ".$showname; ?></a></li>
                    
                </ul>
                <?php }else{ ?>

                
                <ul class="nav navbar-nav navbar-right ">
                    <li role="presentation"><a href="#" onclick="document.getElementById('id01').style.display='block'">Login </a></li>
                    <li role="presentation"><a href="signup.php">SignUp </a></li>
                </ul>
                <?php }?>

            </div>
        </div>
    </nav>
   
   
   <!-- first section -->

    <div class="container firstsec">
        <div class="row">
            <div class="col-md-7">
                <h1 class="wow fadeInDownBig" data-wow-duration="2s">welcome to <strong>bechakena.com</strong></h1>
                <p class="text-left text-success wow bounceIn" data-wow-delay="3s">Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more&nbsp;<strong>in Bangladesh - for free</strong>! </p>
                
                <div id="topcat" class="wow zoomInDown" data-wow-delay="4s">
                    <h3 class="text-center">Browse our top categories</h3>
                    <div class="row" id="popular">
                        <?php foreach ($topc as $getc) { 
                          $topc_id=$getc['cat_id'];
                          $qu="SELECT * from categories where cat_id='$topc_id'";
                          $stt=$pdo->prepare($qu);
                          $stt->execute();
                          $getdata=$stt->fetch();
                        ?>
                        <div class="col-md-3" id="col1">
                            <img src="<?php echo $getdata['icon']; ?>" alt="icon" height="45" width="45">
                            <h4 class="text-center"><?php echo $getdata['name'];?></h4>
                        </div>
                        <?php
                        }
                        ?>
                    
                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div id="citiesdiv">
                    <h3 class="bg-success wow lightSpeedIn" data-wow-delay="3s"><strong>CITIES </strong></h3>
                    <ul class="list-unstyled wow fadeIn" data-wow-delay="3.5s">
                        <li>Dhaka </li>
                        <li>Chittagong </li>
                        <li>Sylhet </li>
                        <li>Jessore </li>
                        <li>Bogra </li>
                        <li>Barisal </li>
                        <li>Rajshahi </li>
                        <li>Rangpur </li>
                    </ul>
                </div>
                <div id="divisionsdiv">
                    <h3 class="bg-success wow lightSpeedIn" data-wow-delay="3s"><strong>D</strong>IVISIONS </h3>
                    <ul class="list-unstyled wow fadeIn" data-wow-delay="3.5s">
                        <li>Dhaka </li>
                        <li>Chittagong </li>
                        <li>Sylhet </li>
                        <li>Barisal </li>
                        <li>Rajshahi </li>
                        <li>Rangpur </li>
                        <li>khulna </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


 


<!-- Display Categories -->


    <div class="container-fluid secondsec">

    <div class="container wow fadeIn">
            <div class="row">
                <div class="row-center-content">
                    <div class="col-lg-8 col-md-8 col-sm-8 heading1">
                        <h4>Stay safe while trading!</h4>
                        <p>All ads are manually reviewed by our team for your safety.</p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 heading2">
                        <a href="facebook.com" class="facebook"><img src="facebook.png" alt="facebook" height="40" width="40">Like us on Facebook</a>
                    </div>
                </div>
            </div>
        </div>
        
        


        <div class="container row1 wow fadeIn">
            
            <div class="row">

                <?php foreach ($data as $item) { ?>
                
                    <div class="col-lg-3 col-md-3 col-sm-3 column1 wow zoomIn" data-wow-duration="2s">
                        <img src="<?php echo $item['icon']; ?>" alt="icon" height="45" width="45">
                        <h4><?php echo $item['name'];?></h4>
                        <p><?php
                              $cat=$item['cat_id'];
                              $q="SELECT count(cat_id) as total FROM advertisements WHERE cat_id='$cat'";
                              $st=$pdo->prepare($q);
                              $st->execute();
                              $count=$st->fetch(PDO::FETCH_ASSOC);

                              echo "(".$count['total'].")"; 
                            ?>
                          
                         </p>
                        <p><?php echo $item['description'];?></p>
                    </div>

                <?php 
                  $colcount++;
                  if($colcount==$maxcol)
                  {
                    $colcount=0;
                    echo '</div><div class="row">';

                  }


                }?>


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
    
     

   <!-- login popup -->

<div id="id01" class="modal modal-content animate text-center">
  
  
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="login.png" alt="Avatar" class="avatar">
    </div>
    <div class="jumbotron container" style="max-width:500px;">
      <h4>Please Login</h4>
      
      <form action="processes.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" autofocus="autofocus">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <p>Not a member? <strong><a href="signup.php">Join Here</a></strong></p>
          <button type="submit" class="btn btn-success" name="loginsubmit">Enter</button>
     </form>
      
        
    </div>

  
</div>









    <!-- Js -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script>new WOW().init();</script>
    
    <!-- Login script -->
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
          }
     </script>
</body>

</html>