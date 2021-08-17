<?php 
   $showerror = "false";
   if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "_dbconnect.php";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from `users` where username = '$username'";
        $result = mysqli_query($conn,$sql);
        $nums = mysqli_num_rows($result);
        if($nums == 1){
             $row = mysqli_fetch_assoc($result);
             if(password_verify($password,$row['Password'])){
                  session_start();
                  $_SESSION['loggedin'] = true;
                  $_SESSION['username'] = $username;
                  $_SESSION['userid'] = $row['user_id'];
                //   echo 'logged in '.$username.'now you can proceed';
               //  $path = $_SERVER['REQUEST_URI'];
               //  $path = preg_replace('~\\.html?$~', '.php', $path);
                // header("Location:/idiscusscp/index.php?loginsuccess=true");
                header("Location:http://wediscuss.lovestoblog.com?loginsuccess=true");
                exit();

             }else{
               $showerror = "Password is incorrect";
             }
        }else if($nums == 0){
            //  echo 'user does exists';
            $showerror = "User doesnot exists";
        }
     //    $path = $_SERVER['REQUEST_URI'];
     //     $path = preg_replace('~\\.html?$~', '.php', $path);
      //   header("Location:/idiscusscp/index.php?loginsuccess=false&error=$showerror");
        header("Location:http://wediscuss.lovestoblog.com?loginsuccess=false&error=$showerror");

   }
?>
