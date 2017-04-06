 <!-- Content Header (Page header) -->
 <?php
 	if(isset($_GET['act'])=="edit"){
 		$stmt = $conn->prepare("SELECT * FROM authors WHERE authorID=".$_GET["ID"]);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_OBJ);	
 		$authorName = $rows[0]->authorName; 		
 	}else{
 		$authorName = ""; 		
 	}
 ?>
    <section class="content-header">
      <h1>
        Author
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
                  <label for="AuthorName">Author Name</label>
                  <input type="text" class="form-control" name="AuthorName" placeholder="Enter Author Name" required="required" value="<?php echo $authorName;?>">
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
		$a = $_POST["AuthorName"];		
		// validation
		if(empty($a)){
			echo "Author Name cannot empty";
			exit();
		}
		
		try {
			if(isset($_GET['act'])=="edit")
				$sql = "UPDATE authors SET authorName='$a' WHERE authorID=".$_GET["ID"];
			else
				$sql = "INSERT INTO authors (authorName)VALUES ('$a')";
				
			if ($conn->query($sql)) {
				echo "<script type= 'text/javascript'>alert('Save data Successfully');
				      window.location.replace('index.php?pages=authors');
					 </script>";
			}else{
				echo "<script type= 'text/javascript'>alert('Data not successfully save data.');</script>";
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