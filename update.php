<?php
include 'connection.php';
$id = $_GET['update'];
$empartment_id= $_GET['empartmentid'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = implode($_POST['department']);
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // $delete_query = "DELETE Empartment from Empartment WHERE Empartment.EmpId = $id";
    // $delete_result = mysqli_query($con, $delete_query);
    // if($delete_result){
    // $empartment_query = "SELECT * FROM Empartment";
    // $empartment_result = mysqli_query($con, $empartment_query);
    // $fetch = mysqli_fetch_assoc($empartment_result);
    // if($empartment_result){
    //     $empartment_id = $fetch['empartment_id'];
    // }

    $query = "UPDATE Employee, Empartment SET Employee.Name='$name', empartment.DeptId=$department, Employee.Email='$email', Employee.Mobile='$mobile', Employee.Password='$password' WHERE Employee.EmpId=$id and Empartment.empartment_id=$empartment_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location: view.php');
    }
// }
}

$query = " SELECT * FROM Employee JOIN empartment ON empartment.EmpId = employee.EmpId JOIN department ON department.DeptId = empartment.DeptId WHERE employee.EmpId=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if ($result) {
    $id =  $row['EmpId'];
    $name = $row['Name'];
    $email = $row['Email'];
    $mobile =  $row['Mobile'];
    $password =  $row['Password'];
    // $query_for_depts = "SELECT * FROM `empartment` WHERE empartment.EmpId = $id";
    // $dept_result = mysqli_query( $con, $query_for_depts);
    //$departments = mysqli_fetch_assoc($dept_result);

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <a href="view.php" class="text-light"><button class="btn btn-primary my-5">Home</button></a>

        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" maxlength="10" class="form-control" name="name" placeholder="Enter your name" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Select Department</label><br>
                <?php $dept_query_new =  "SELECT * FROM department";
                $results = mysqli_query($con, $dept_query_new);
                foreach ($results as $result) :
                    $DeptId  = $result['DeptId'];
                    $DeptName  =  $result['DeptName'];
                    $DeptLocation =   $result['DeptLocation'];
                ?>
                    <?php
                    //$userDeptId = '';
                    // $checked = array(array)
                    // while ($departments = mysqli_fetch_assoc($dept_result)) {
                    //     if ( $DeptId === $departments['DeptId'] ) {
                    //         $checked = "checked";
                    //     } else {
                    //         $checked = '';
                    //     }
                    // }
                    
                    ?>
                    <input type="checkbox" id="<?= strtolower($DeptName) ?>" name="department[]" value="<?= $DeptId ?>"     >
                    <label for="<?= strtolower($DeptName) ?>"> <?= $DeptName ?></label><br>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?= $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" name="mobile" placeholder="Enter your mobile" value="<?= $mobile; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Enter your password" value="<?= $password; ?>" required>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Update</button>
        </form>
    </div>

</body>

</html>