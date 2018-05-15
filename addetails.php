<?php 
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');

$adid=$_GET['shontu'];


$query="SELECT a.ad_id,a.description,a.condition,a.phone_num,u.name as username,c.name as catname,l.name as locname,s.subname,sl.name as subloc,a.price,a.role,a.post_time,a.negotiable,a.caption,a.image_url FROM users u,categories c,locations l,subcategories s,advertisements a ,sublocations sl WHERE a.user_id=u.user_id AND a.cat_id=c.cat_id AND a.location_id=l.location_id AND a.subcat_id=s.subcat_id AND a.subloc_id=sl.subloc_id AND a.ad_id='$adid'";

$stmt = $pdo->prepare($query);
$stmt->execute();
$sh=$stmt->fetch();

/*reformat date*/
$date=$sh['post_time'];
$t = strtotime($date);
$time=date('d F Y',$t);

/*reports count*/
 $repquery="SELECT count(ad_id) as tc FROM report WHERE ad_id='$adid'";
 $report = $pdo->prepare($repquery);
 $report->execute();
 $badcount=$report->fetch(PDO::FETCH_ASSOC);




?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad Details.Bechakena.com</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">

    <script type="text/javascript">
         function reported() {
                      alert("Your report has been submitted for review!");
                 }
    </script>
    <script type="text/javascript">
         function ordered() {
                      alert("Your order has been placed!");
                 }
    </script>
    
</head>
<body>

<?php 
   
   if(isset($_SESSION['report']))
         {
            unset($_SESSION['report']);
            echo "<script>reported();</script>";

         }
    if(isset($_SESSION['order']))
         {
            unset($_SESSION['order']);
            echo "<script>ordered();</script>";

         }


 ?>



<!-- navbar -->
 <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand wow rubberBand" data-wow-iteration="infinite" data-wow-delay="4s" href="#"><img src="assets/img/ec.png" class="brandlogo pull-left"></a>
                <a class="navbar-brand navbar-link wow rubberBand" href="index.php"><strong>bechakena.com</strong></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse wow zoomIn" id="navcol-1">
                <a class="btn btn-warning btn-sm navbar-btn navbar-right" href="showad.php" type="button">See Ads</a>
            </div>
        </div>
    </nav>


    

  <!-- Detailed Ad -->

<div class="container jumbotron" style="max-width:600px;" >
<div class="container jumbotron">

              
                
                  <img src="<?php echo $sh['image_url'];?>" class="img-responsive img-thumbnail" style="max-height:500px;width:500px;">
              
                  <h3><span class="label label-default"><?php echo $sh['caption']; ?></span></h3>
                  <span class="text-muted">Posted by: <?php echo $sh['username'];?> </span>
                  <span class="label label-success"><?php echo $sh['role'];?> </span>
                  <span class="label label-danger"><br><?php echo number_format($sh['price']);?> taka</span>
                  <span class="text-muted"><br><br>posted: <?php echo $time;?><br></span>
                  <span class="text-muted "><?php echo $sh['subloc'].",".$sh['locname'];?><br><br></span>
                  <span class="text-active "><span class="label label-success">Category:</span><br><?php echo $sh['catname'];?><br><br></span>
                  <span class="text-active "><span class="label label-success">Description:</span><br><?php echo $sh['description'];?><br><br></span>
                  <span class="text-active "><span class="label label-success">Condition:</span><br><?php echo $sh['condition'];?><br><br></span>
                  <span class="text-active "><span class="label label-success">Price Negotiable ?</span><br><?php echo $sh['negotiable'];?><br><br></span>
                  <span class="text-active "><span class="label label-success">Phone Number:</span><br><?php echo $sh['phone_num'];?><br><br></span>
                  
                
                  <!-- report div -->
                  <div class="container " style="background:white;text-align:center;padding:20px;margin-top:10px;">
                    <span class="label label-danger">This post is reported <?php echo $badcount['tc'];?> time(s) so far <br><br></span>
                    <span>If you find it irrelevent,you may</span>
                    <a href="#" onclick="document.getElementById('reportform').style.display='block'"><h3><span class="label label-warning"><i class="fa fa-ban"></i> Report this</span></h3></a>
                  </div>

                   
                  

</div>





<!-- Report form -->
<div id="reportform" class="modal animate text-center">
  
  
    <div class="">
      <span onclick="document.getElementById('reportform').style.display='none'" class="close" title="Close form">x</span>
    </div>

    <div class="jumbotron container" style="max-width:500px;">
      <h2 style="margin-bottom:40px">Report here</h2>
      
      <form action="processes.php?adid=<?php echo $adid;?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Please Insert your Email</label>
            <input type="email" class="form-control" name="email" id="email" required="true" placeholder="Email" autofocus="autofocus">
          </div>
          <div class="form-group">
            <label for="caption">Describe your Reason for reporting </label>
            <textarea rows="8" cols="50" required="true" class="form-control" id="description" name="description" placeholder="Reasons for Reporting"></textarea>
            <small id="desHelpBlock" class="form-text text-success">
            <br>Describe your reason to the point,all the reports are manually checked and will be under obeservation
            </small>
          </div>
          <button type="submit" class="btn btn-success" name="reportsubmit">Submit Report</button>
     </form>
    </div>
</div>






<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>







</body>
</html>