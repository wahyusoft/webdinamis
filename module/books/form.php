 <!-- Content Header (Page header) -->
 <?php
 	if(isset($_GET['act'])=="edit"){
 		$stmt = $conn->prepare("SELECT * FROM books WHERE bookId=".$_GET["ID"]);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_OBJ);	
 		$title = $rows[0]->title; 		
 		$authorID = $rows[0]->authorID;
 	}else{
 		$title = ""; 		
 		$authorID = "";		
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
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter book title" required="required" value="<?php echo $title;?>">
                </div>
                <div class="form-group">
                  <label for="AuthorName">Author Name</label>
                  <select name="authorID" class="form-control">
                  <?php 
                  	$auth = $conn->prepare("SELECT * FROM authors");
					$auth->execute();
					while($row = $auth->fetch(PDO::FETCH_OBJ)){
						$selected = ($row->authorID==$authorID)? "selected" : "";
						echo "<option value='$row->authorID' $selected >$row->authorName</option>";
					}	

                  ?>
                  </select>
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
		$a = $_POST["title"];
		$b = $_POST["authorID"];		
		// validation
		if(empty($a)){
			echo "The book title cannot empty";
			exit();
		}

		if(empty($b)){
			echo "Author Name cannot empty";
			exit();
		}
		
		try {
			if(isset($_GET['act'])=="edit")
				$sql = "UPDATE books SET title='$a' , authorID='$b' WHERE bookId=".$_GET["ID"];
			else
				$sql = "INSERT INTO books (title,authorID)VALUES ('$a','$b')";
				
			if ($conn->query($sql)) {
				echo "<script type= 'text/javascript'>alert('Save data Successfully');
				      window.location.replace('index.php?pages=books');
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