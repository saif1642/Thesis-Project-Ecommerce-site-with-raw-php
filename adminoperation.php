<?php 

$operation= $_GET['oper'];


?>




<!DOCTYPE html>
<html>
<head>
	<title>admin operations</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/shoumik.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">

</head>
<body>

    <div class="jumbotron">
       <div class="container">
       <h3 class="text-uppercase ">Operations</h3>
       <a href="admin.php" class="btn btn-warning">Go to Dashboard</a>	
       </div>
    </div>


  <!-- Category add -->
   <?php if($operation=='add_cat'){?>


    <div class="jumbotron container" style="max-width:500px;">
      <h4>Add Categories</h4>
      
      <form action="imgprocess.php" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
		    <label>Category Name</label>
		    <input type="text" class="form-control" name="catname">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <input type="text" class="form-control" name="des">
		  </div>
		  <div class="form-group">
		    <label class="text-success">Choose ICON</label>
		    <input type="file" class="form-control" name="icon">
		  </div>
	
		  <button type="submit" class="btn btn-success" name="done">Enter</button>
     </form>
	  
    	
    </div>

    <?php  }?>

    <!-- subcategory add -->
    <?php if($operation=='add_subcat'){

        $pdo = new PDO('mysql:host=localhost;dbname=bkdb','root','');
        $query="SELECT * FROM categories";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchall();


    	?>


    <div class="jumbotron container" style="max-width:500px;">
      <h4>Add Subcategories</h4>
      
      <form action="processes.php" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
		    <label>SUB-Category Name</label>
		    <input type="text" class="form-control" name="subname">
		  </div>
		  <div class="form-group">
			  <label for="sel1">Select subcategory</label>
			  <select class="form-control" id="selcat" name="selcat">
			    <option value="">Select</option>
			    
			    <?php  
                  foreach ($result as $item) {
			    ?>
                 <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['name'];?></option>
			    <?php }?>


			  </select>
          </div>
	
		  <button type="submit" class="btn btn-success" name="subcat_add">Enter</button>
     </form>
	  
    	
    </div>

    <?php  }?>






</body>
</html>