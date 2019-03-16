<?php
include_once ('./inc/header.php');
include_once ('./lib/Student.php');
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('form').submit(function(){
            var roll = true;
            $(':radio').each(function(){
               $name = $(this).attr('name');
              if (roll && !$(':radio[name="' +name+ '"]:checked').length){
                // alert(name + "Roll Missing !");
                  $('.alert').show();
                roll = false;
              }
            });
            return roll;
        });
    });
</script>
<?php
//error_reporting(0);
$stu = new Student();
//$cur_date = date('Y-m-d');
$dt= $_GET['dt'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $attend = $_POST['attend'];
    $att_update= $stu->updateAttendance($dt,$attend);
}
?>
<?php
    if (isset($att_update)){
        echo $att_update;
    }
?>
<div class='alert alert-success' style="display: none;"><strong>Error!</strong>Student Roll Missing! </div>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="btn btn-block btn-primary mt-1">
            <h2>Student View</h2>
        </div>
        <h2>
            <a class="btn  btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info pull-right" href="date_view.php">Back</a>

        </h2>
    </div>
    <div class="panel-body">
        <div class="well text-center" style="font-size: 18px;">
            <strong>Date: </strong><?php  echo $dt;?>
        </div>
        <form action="" method="POST">
           <table class="table table-striped">
                <tr>
                    <th width="30%">Serial</th>
                    <th width="50%">Student Name</th>
                    <th width="50%">Student Roll</th>
                    <th width="20%">Attendance</th>
                </tr>
                <?php
                $stu = new Student();
                $get_student = $stu->getAllData($dt);
                if ($get_student){
                    $i=0;
                    while ($value=$get_student->fetch_assoc()){
                        $i++;
                ?>

              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $value['name'];?></td>
                  <td><?php echo $value['roll'];?></td>
                  <td>
                      <input type="radio" name="attend[<?php echo $value['roll'];?>]" value="present"
                          <?php if ($value['attend'] == "present"){
                              echo "checked";}?>>P

                      <input type="radio" name="attend[<?php echo $value['roll'];?>]" value="present"
                          <?php if ($value['attend'] == "absent"){
                              echo "checked";}?>>A
                  </td>

              </tr>
<?php }}?>
           </table>
               <tr>
                  <td>
                      <input type="button" class="btn btn-primary" name="update" value="Update"></input>
                  </td>
               </tr>


        </form>
    </div>
</div>

<?php //include_once ('./inc/footer.php');?>

<!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
<script src="./inc/js/jquery.min.js"></script>
<script src="./inc/js/bootstrap.min.js"></script>
</body>
</html>

