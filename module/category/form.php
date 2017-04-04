 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categories
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
	 	
      <!-- Small boxes (Stat box) -->
		<div class="row">
		 <div class="col-md-12">
			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="#">
              <div class="box-body">
                <div class="form-group">
                  <label for="CategoryName">Category Name</label>
                  <input type="text" class="form-control" name="CategoryName" placeholder="Enter Category Name" required="required">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" class="form-control" name="Description" placeholder="Enter Description">
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="btnSimpan" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		</div>
		
		</div>
      <!-- /.row -->
      <!-- Main row -->
	<?php
	  if(isset($_POST["btnSimpan"])):
		$a = $_POST["CategoryName"];
		$b = $_POST["Description"];
		// validation
		if(empty($a)){
			echo "Category cannot empty";
			exit();
		}
		if(empty($b)){
			echo "Description cannot empty";
			exit();
		}
		try {
			$sql = "INSERT INTO categories (CategoryName, Description)VALUES ('$a','$b')";
			if ($conn->query($sql)) {
				echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');
				      window.location.replace('index.php?pages=category');
					 </script>";
			}else{
				echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
			}
			$conn = null;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	  endif;	
	?>	
    </section>
    <!-- /.content -->