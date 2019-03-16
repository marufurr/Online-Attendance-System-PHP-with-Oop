
<?php
 include_once ('./inc/header.php');
 include_once ('./lib/Student.php');
 ?>
<?php
  $stu = new Student();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name = $_POST['name'];
      $roll = $_POST['roll'];
      $insertData = $stu->insertStudent($name,$roll);
  }
 ?>
<?php
if (isset($insertData)){
    echo $insertData;
}
?>
<div class="btn btn-block btn-primary mt-5">
    <h2>Student Added System</h2>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn  btn-success" href="add.php">Add Student</a>
            <a class="btn btn-info pull-right" href="index.php">Back</a>
        </h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Student Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Student Roll</label>
                                    <input type="text" class="form-control" name="roll" id="roll" placeholder="Enter Your Roll Number">
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label"></label>
                                    <input type="submit" class="btn btn-block btn-success" name="submit" value="Add Student">
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </form>
    </div>
</div>

<?php //include_once ('./inc/footer.php');?>

<script src="./inc/js/jquery.min.js"></script>
<script src="./inc/js/bootstrap.min.js"></script>
</body>
</html>

