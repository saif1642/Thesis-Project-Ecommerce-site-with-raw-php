<?php 
session_start();
if(isset($_SESSION['loginuserinfo']))
 {
  
  header("location:index.php");

 }




$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');
$query="SELECT * FROM locations";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result=$stmt->fetchall();




?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup.Bechakena.com</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    
    <!-- alert box -->
    <script>
         function regsuccess() {
                      alert("Registration Successful!");
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
                <button class="btn btn-warning btn-sm navbar-btn navbar-right" type="button">See Ads</button>
            </div>
        </div>
    </nav>


    <?php 
       
       if(isset($_SESSION["Message"]))
        {
          echo "<script>regsuccess();</script>";
          unset($_SESSION["Message"]);

        }
     ?>

    <!-- Register form -->

<div class="container jumbotron text-center" style="max-width:600px;" >
<div class="container jumbotron">
  <h2 style="margin-bottom:40px;">Register Here</h2>

  <form id="regform" enctype="multipart/form-data" method="POST" action="processes.php">

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Username" name="name" autofocus="autofocus">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" onkeyup="checkemail();">
      <span id="email_status"></span>
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>

    <div class="form-group">
      <label for="pwd2">Enter Password again:</label>
      <input type="password" class="form-control" id="pwd2" placeholder="Enter password" name="pwd2">
    </div>

    <div class="form-group">
      <label for="phone">Phone Number:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone-number" name="phone" autofocus="autofocus">
    </div>

    <div class="form-group">
			  <label for="sel1">Location</label>
			  <select class="form-control" id="seloc" name="location">
			  <option value="">Select</option>
			    
			    <?php  
                  foreach ($result as $item) {
			    ?>
                 <option value="<?php echo $item['name'];?>"><?php echo $item['name'];?></option>
			    <?php }?>


			  </select>
     </div>

    <div class="form-group">
         <label for="role">Sign Up as: </label>
         <input type="radio" name="role" value="member" class="form-control"><br>Member</input>
         <input type="radio" name="role" value="dealer" class="form-control">Dealer</input>
    </div>



    <button type="submit" class="btn btn-success" name="regprocess" id="regbtn">Register</button>
  </form>

</div>	
</div>



<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script>
   
  
    $(document).ready(function(){

    	 
         $("#regform").validate({

         	rules:{
         		name: "required",
         		email:{
         			required:true,
         			email:true

         		},
         		pwd:{
         			required:true,
         			minlength:8
         		},
         		pwd2:{
         			required:true,
         			minlength:8,
         			equalTo:"#pwd"
         		},
         		phone: "required",
         		role: "required"


         	}



         });


    });
</script>



<!-- Email duplicacy check -->
<script type="text/javascript">

		function checkemail()
		{
		 var email=document.getElementById( "email" ).value;
			
		 if(email)
		 {
			$.ajax({
			  type: 'post',
			  url: 'checkdata.php',
			  data: {
			   user_email:email,
			  },
			  success: function (response) {
			   $( '#email_status' ).html(response);
			   if(response=="Email available")	
			   {
                 $("#regbtn").prop('disabled', false);
			     return true;	
			   }
			   else
			   { 
                 $("#regbtn").prop('disabled', true);
			    return false;	
			   }
			  }
			});
		 }
		 else
		 {
		  $( '#email_status' ).html("");
		  return false;
		 }
	}



</script>






</body>
</html>