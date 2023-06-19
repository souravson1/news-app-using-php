<?php include "header.php"; 
if(isset($_POST['submit'])){
    include 'config.php';

    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);


    $sql = "SELECT username FROM user WHERE username = '{$user}'";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful!");

    if(mysqli_num_rows($result)>0){
        echo '<p style="color: red;">UserName Already Exists.</p>';
    } else{
        $sql1 = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '$role' WHERE user_id = {$userid}";
        $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccesful!");

        if($result1){
            header("Location: {$hostname}/admin/users.php");
        }
    }


}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  $user_id = $_GET['id'];
                  include 'config.php';
                  $sql = "SELECT * FROM user WHERE user_id = '{$user_id}'";
                  $result = mysqli_query($conn, $sql) or die("Query Unsuccessful!");

                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                  ?>
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                              <option value="0" <?php if($row['role']==0){echo "Selected";} ?>>Normal User</option>
                              <option value="1" <?php if($row['role']==1){echo "Selected";} ?>>Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                }}
                ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
