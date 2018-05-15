<?php
 session_start(); 
 if(!(isset($_SESSION['loginuserinfo'])))
 {
 	$_SESSION['Msg']="not logged in";
 	header("location:index.php");

 }

$pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');

//get categories
 
 $query="SELECT * FROM categories";
 $stmt = $pdo->prepare($query);
 $stmt->execute();
 $catlist=$stmt->fetchall();

 //get locations

 $query="SELECT * FROM locations";
 $stmt = $pdo->prepare($query);
 $stmt->execute();
 $loclist=$stmt->fetchall();





?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Advertisement.Bechakena.com</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">

    <style type="text/css">
        label.error{
            color:red;
        }
    </style>

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
            </div>
        </div>
    </nav>

   




   <!-- Advertisement form -->


<div class="container jumbotron text-center" style="max-width:600px;" >
<div class="container jumbotron">
  <h2 style="margin-bottom:40px;">Post advertisement</h2>

  <form id="adform" enctype="multipart/form-data" method="POST" action="imgprocess.php" >

    
    <div class="form-group">
        <label for="catsel">Select category: </label>
        <select class="form-control" id="cat_id" name="cat_id">
                <option value="">Select</option>
                
                <?php  
                  foreach ($catlist as $item) {
                ?>
                 <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['name'];?></option>
                <?php }?>
        </select>
    </div>

    <div class="form-group">
        <label for="subsel">Select subcategory: </label>
        <select class="form-control" id="subcat_id" name="subcat_id">
                <option value="">Select Category First</option>
        </select>
    </div>


    <div class="form-group">
        <label for="locsel">Select your location: </label>
        <select class="form-control" id="loc_id" name="loc_id">
                <option value="">Select location</option>
                
                <?php  
                  foreach ($loclist as $item) {
                ?>
                 <option value="<?php echo $item['location_id']; ?>"><?php echo $item['name'];?></option>
                <?php }?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="sublocsel">Select Sub-location: </label>
        <select class="form-control" id="subloc_id" name="subloc_id">
                <option value="">Select location First</option>
        </select>
    </div>

    <!--Caption -->
    <div class="form-group">
        <label for="caption">Enter a Suitable caption for your product: </label>
        <input type="text" id="caption" name="caption" class="form-control" aria-describedby="captionHelpBlock">
        <small id="captionHelpBlock" class="form-text text-success">
        <br>Choose a more relevent caption according to product,this will help to reach people easily
        </small>
    </div>

   <!-- description/condition -->
   <div class="row">
    <div class="form-group col-sm-10">
        <label for="caption">Describe your product briefly: </label>
        <textarea rows="8" cols="50" class="form-control" id="des" name="des"></textarea>
        <small id="desHelpBlock" class="form-text text-success">
        <br>Describe your product specification,faults if have any, if used-how long used? , reasons for sale etc for better response
        </small>
    </div>

    <div class="form-group col-sm-2 " style="margin-top:50px;">
       <label>Condition:</label>
       <br><br>
       <input type="radio" name="condition" id="condition" value="Used" >Used<br><br></input>
       <input type="radio" name="condition" id="condition" value="New" >New</input>        
    </div>    
   </div>

    <!-- price and negotiable -->
    <div class="row text-left">
        <div class="col-sm-8 form-group form-inline">
            <label>Price (taka): </label>
            <input type="number" name="price" id="price" min="1" class="form-control">
        </div>

        <div class="col-sm-4 form-group form-inline">
            <label>Price Negotiable ?</label>
            <br>
            <input type="radio" name="negotiable" id="nego" value="yes" >Yes<br></input>
            <input type="radio" name="negotiable" id="nego" value="no" >no</input>
        </div>
    </div>

    <!-- image and phonenum -->

    <div class="row ">
        <div class="form-group input-group-addon">
            <label>Attach product image</label>
            <input type="file" name="icon" id="icon">
            <small class="form-text text-success">
            <br>Upload clear image of the product in jpg , jpeg or png format
            </small>
        </div>
    </div>

    <div class="form-group form-inline" style="margin-top:10px">
            <label>Contact Number:  </label>  
            <input type="text" name="phone" id="phone" class="form-control" maxlength="11" onkeyup="digitscheck(this)"> 
            <small class="form-text text-success">
            <br>Enter a valid Phone number
            </small> 
    </div>
    




    
    <button type="submit" class="btn btn-success" name="adprocess" id="adbtn">Post Advertisement</button>
  </form>

</div>	
</div>



<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>


<!-- check digits -->
<script type="text/javascript">
    function digitscheck(inp)
    {
        var check= /[^0-9]/gi;
        inp.value=inp.value.replace(check,"");

    }

</script>


<!-- sub options checks -->

<script type="text/javascript">
  $(document).ready(function(){
    
    /*get sub categories*/
    $("#cat_id").change(function(){
        var catId = $(this).val();
        console.log(catId);

        $.ajax({
            url: 'imgprocess.php',
            type: 'post',
            data: {catIdsent:catId},
            dataType: 'json',
            success:function(response){

                console.log(response);

                var len = response.length;
                
                $("#subcat_id").empty();
                $("#subcat_id").append("<option value=''>Select subcategory</option>");
                for( var i = 0; i<len; i++){
                    var id = response[i]['subcat_id'];
                    var name = response[i]['subname'];
                    
                    $("#subcat_id").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

    /*get sublocations*/
    $("#loc_id").change(function(){
        var locId = $(this).val();
        console.log(locId);

        $.ajax({
            url: 'imgprocess.php',
            type: 'post',
            data: {locIdsent:locId},
            dataType: 'json',
            success:function(response){

                console.log(response);

                var len = response.length;
                
                $("#subloc_id").empty();
                $("#subloc_id").append("<option value=''>Select sub-location</option>");
                for( var i = 0; i<len; i++){
                    var id = response[i]['subloc_id'];
                    var name = response[i]['name'];
                    
                    $("#subloc_id").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });





});
</script>





<!-- Validation -->

<script>
   
    
    $(document).ready(function(){

         
         $("#adform").validate({
            
            rules:{
                cat_id: "required",
                subcat_id:"required",
                loc_id:"required",
                subloc_id:"required",
                caption:"required",
                des:"required",
                phone:{
                    required:true,
                    digits:true,
                    maxlength: 11
                },
                condition: "required",
                price:"required",
                negotiable:"required",
                icon:"required"

            },
            messages:{
                cat_id: "Select a category",
                subcat_id:"Forgot to select sub-category?",
                loc_id:"Enter your location",
                subloc_id:"select your area name please"

            }



         });


    });
</script>


</body>
</html>