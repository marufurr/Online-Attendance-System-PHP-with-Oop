<?php
include_once ('./inc/header.php');
include_once ('./lib/Student.php');
?>
<div class="btn btn-block btn-warning mt-1">
    <h2>Student View System</h2>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn  btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info" href="index.php">Take Attendance</a>
        </h2>
    </div>
    <div class="panel-body">
        <form action="" method="POST">
            <table class="table table-striped">
                <tr>
                    <th width="30%">Serial</th>
                    <th width="50%">Student Name</th>
                    <th width="20%">Action</th>
                </tr>
                <?php
                $stu = new Student();
                $get_date = $stu->getDateList();
                if ($get_date){
                    $i=0;
                    while ($value=$get_date->fetch_assoc()){
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $value['att_time'];?></td>
                            <td>
                                <a class="btn btn-primary" href="student_view.php?dt=<?php echo $value['att_time'];?>">View</a>
                            </td>
                        </tr>
                    <?php }}?>

            </table>
        </form>
    </div>
</div>

<?php include_once ('./inc/footer.php');?>

<!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
<script src="./inc/js/jquery.min.js"></script>
<script src="./inc/js/bootstrap.min.js"></script>
</body>
</html>

