<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- <style>
    #bq {
        min-height: 433px;
    }
    </style> -->

    <title>WeDiscuss</title>





</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_navbar2.php' ?>


    <!-- this is the php to handle jumbotron section means the question is shown by this php -->


    <?php 
         $id = $_GET['threadid'];
         $sql = "SELECT * FROM `thread` WHERE `thread_id` = $id";
         $result = mysqli_query($conn,$sql);

         while($row = mysqli_fetch_assoc($result)){
               $thname = $row['thread_title'];
               $thdes = $row['thread_des'];
               $userid = $row['thread_user_id'];
               $sql2 =   "SELECT username FROM `users` WHERE `user_id` = $userid";
               $result2 = mysqli_query($conn,$sql2);
               
               $row2 = mysqli_fetch_assoc($result2);
               $commentby = $row2['username'];

         }
       
     ?>

    <!-- this is the ending of the above section php to handle jumbotron section means the question is shown by this php -->









    <!-- post answers handeled here  -->
    <?php 
       $method = $_SERVER['REQUEST_METHOD'];
       if($method =='POST'){
            // insert thread into  database
            $cm_content = $_POST['comment'];
            $cm_content = str_replace("<","&lt",$cm_content);
            $cm_content = str_replace("<","&gt",$cm_content);
            $userid = $_POST['user_id'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$cm_content', '$id', '$userid', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            if($result){
                 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> Your answer have been added. Keep the good work!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                         </div>';
            }
       }
     ?>


    <!-- post answers handled ends here  -->
    <!-- jumbotron begins here -->
    <!-- <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $thname?>
            </h1>
            <p class="lead"><?php echo $thdes?></p>
            <hr class="my-4">
            <p>Welcome to the IdiscussCP forums. These forums are available to help you solve problems regarding various
                programming topics. All users are expected to be kind, helpful, and respectful. Beyond just seeking
                solutions, users are encouraged to help others. If they know the answer to someone else’s question, it
                is greatly appreciated that they offer assistance. This is by no means mandatory, and no one is
                compelled to help anyone else.</p>
            <p>Posted By: <b><?php echo $commentby;?></b></p>
        </div>
    </div> -->
    <div class="container my-3">
        <div class="jumbotron p-3 p-md-3 text-white rounded bg-dark">
            <div class="col-md-12 px-0">
                <h2 class="display-4 font-italic"><?php echo $thname?></h2>
                <p class="lead my-3"><?php echo $thdes?></p>
                <p>Posted By: <b><?php echo $commentby;?></b></p>
            </div>
        </div>
    </div>

    <!-- jumbotron end here  -->



    <!-- post comment form begins here  -->
    <!-- restricting user to post comment only when user is logged in  -->
    <?php  
         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            $val = $_SESSION['userid'];
             echo '<div class="container askquestion my-3 py-2">
                    <h1>Post Comment</h1>
                    <form action="' .$_SERVER['REQUEST_URI']. '" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Enter Your answer here</label>
                                <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                            </div>
                            <input type="hidden" name = "user_id" value =  "'.$val.'">
                            <button type="submit" class="btn btn-success">Post</button>
                    </form>
                </div>';
         }else{
            echo'<div class="container my-3">
                    <h1>Post Comment</h1>
                    <p class = "lead">You are not logged in. Please login to Post a comment</p>
    
                </div>';
         }
    
    ?>
    <!-- <div class="container askquestion my-3 py-2">
        <h1>Post Comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Enter Your answer here</label>
                <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post</button>
        </form>
    </div> -->
    <!-- post comment form ends here  -->





    <!-- Discussion starts here  -->
    <div class="container" id="bq">
        <h1 class="my-3">Discussions</h1>
        <?php 
           $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
           $result = mysqli_query($conn,$sql);
           $noresult = true;
           while($row = mysqli_fetch_assoc($result)){
                $noresult = false;
                $cid = $row['comment_id'];
                $content = $row['comment_content'];
                date_default_timezone_set('Asia/Kolkata');
                $time = $row['comment_time'];
                $today = date("Y-m-d H:i:s");
                $firstDate  = new DateTime($today);
                $secondDate = new DateTime($time);
                $intv1 = $firstDate->diff($secondDate);
                $userid = $row['comment_by'];
                $sql2 = "SELECT username FROM `users` WHERE user_id = '$userid'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 =  mysqli_fetch_assoc($result2);
                echo '<div class="media my-3">
                <img src="img/userdef.png" width = "54px" class="mr-3" alt="...">
                <div class="media-body"><p class = "my-0">Answered by: '.$row2['username'].' ';
                if($intv1->y > 0){
                echo $intv1->y . " year ago";
                }else if($intv1->m > 0){
                        echo $intv1->m . " months ago";
                }else if($intv1->d > 0){
                        echo $intv1->d. " days ago";
                }else if($intv1->h > 0){
                        echo $intv1->h. " hours ago";
                }else if($intv1->i > 0){
                        echo $intv1->i.  " minutes ago";
                }else echo $intv1->s. " seconds ago";
                echo '</p>'.$content.'
                </div>
            </div>';
            }
            if($noresult){
                 echo '<div class="jumbotron jumbotron-fluid">
                 <div class="container">
                   <p class="display-4">No Answers Yet!</p>
                   <p class="lead">Be the first person to post answer of this question!</p>
                 </div>
               </div>';
            }
        ?>
    </div>
    <!-- Discussion ends here  -->
    <?php include 'partials/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>