<?php
  include '../../cms/connection/connection.php';
  $user=$_POST["username"];
  $password=sha1($_POST["password"]);
  $sql="select * from users where username='".$user."' and status='1'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result)) {
      $auth = password_verify($password, $row['password']);
      if($auth){
       session_start();
       $_SESSION['level'] = $row['access_level'];
       $_SESSION['id'] = $row['user_id'];
       $sqlx = "UPDATE users set attempts = '0' where user_id = '".$row['user_id']."'";
       mysqli_query($conn, $sqlx);
            if($_SESSION['level']>0){
                header("Location:../../cms");
            }
      }
      else
      {
        $attempts = 0;
        $sql1 = "UPDATE users set attempts = '".($row['attempts']+1)."' where user_id = '".$row['user_id']."'";
        mysqli_query($conn, $sql1);
        $sql2 = "select * from users where user_id='".$row['user_id']."'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0){
          while($row2 = mysqli_fetch_assoc($result2)) {
              if($row2["attempts"]>4){
                $sql3 = "UPDATE users set status = '0' where user_id = '".$row['user_id']."'";
                mysqli_query($conn, $sql3);
                $message = "Your account has been locked due to multiple failed login attempts. Please contact the administrator to reactivate the account.";
            header("Location:../index.php?status=5&message=" . urlencode($message));
              }
              else{
                $attempts = $row2["attempts"];
              }
          }
        }
        header("Location:../index.php?status=4&attempts=".$attempts);
      }
    }
  }
  else
  {
    ?><script>
       alert("Your account has been locked due to multiple failed login attempts. Please contact the administrator to reactivate the account. Attempts remaining: 0")
      </script>
    <?php
    $message = "Your account has been locked due to multiple failed login attempts. Please contact the administrator to reactivate the account.";
    header("Location:../index.php?status=5&message=" . urlencode($message));
  }

?>
