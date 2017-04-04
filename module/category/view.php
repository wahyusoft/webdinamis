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
		
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a href="?pages=add_category" class="btn btn-primary">Add Category</a></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Description</th>                 
				  <th>Action</th>
                </tr>
               <?php
				$sql = "SELECT * FROM categories ORDER BY CategoryID DESC";
				$data = $conn->prepare($sql);
				$data->execute();
			
				while($row = $data->fetch(PDO::FETCH_OBJ)){
					$link_del = "index.php?pages=category&act=delete&ID=$row->CategoryID";
					$link_edit= "index.php?pages=add_category&act=edit&ID=$row->CategoryID";					
					echo "<tr>
						<td>$row->CategoryID</td>
						<td>$row->CategoryName</td>
						<td>$row->Description</td>
						<td><a href='$link_edit' title='edit'><i class='fa fa-pencil-square-o'></i></a>
							&nbsp;
							<a href='$link_del' title='delete'><i class='fa fa-times'></i></a>
						</td>
						</tr>";
				} 
				if(isset($_GET["act"])=="delete"):
					try {
						$sql = "DELETE FROM categories WHERE CategoryID=".$_GET["ID"];
						if ($conn->query($sql)) {
							echo "<script type= 'text/javascript'>alert('Deleted Successfully');
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
					
				$conn = null; // close connection
				?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
    
    </section>
    <!-- /.content -->