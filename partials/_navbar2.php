<?php 
    session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://wediscuss.lovestoblog.com/">WeDiscuss</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://wediscuss.lovestoblog.com/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            // dropdown categories are implemented here 
                        $sql = "SELECT catname,catid FROM `categories` LIMIT 10";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                           echo '<a class="dropdown-item" href="http://wediscuss.lovestoblog.com/threadlist.php?ctid='.$row['catid'].'">'.$row['catname'].'</a>';
                        }
                        // <div class="dropdown-divider"></div>
                        // <a class="dropdown-item" href="#">Something else here</a>
                        // dropdown categories emplementation ends here 
                    echo '</div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="http://wediscuss.lovestoblog.com/about.php">About Us</a>
                </li>
            </ul>
            <div class="row mx-2">';
                
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                    //    echo '<p class = "text-light mx-2 my-2">'.$_SESSION['username'].'</p>
                    //    <a href = "partials/_logout.php" class="btn btn-outline-success mx-2" >Logout</a>';
                        echo '<a href = "user.php" class="btn btn-success mx-2" >'.$_SESSION['username'].'</a>
                       <a href = "partials/_logout.php" class="btn btn-outline-success mx-2" >Logout</a>';

                     
                }else{
                    echo '<button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginmodal" >Login</button>
                    <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupmodal">SignUp</button>';
                }
                
            echo '</div>

        </div>
    </nav>';
                // search functionality 
                // <form class="form-inline my-2 my-lg-0">
                //     <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                //     <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                // </form>';
                // search functionality 
                //  <li class="nav-item">
                //     <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                // </li>
    
    include 'partials/_loginmodal.php';
    include 'partials/_signupmodal.php';
    // signup completion message goes here ------------------------
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
        
         echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
         <strong>Holy guacamole!</strong> You have signed Up. Now you can login.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
    }else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
         $error = $_GET['error'];
         echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
         <strong>Error :</strong> '.$error.'
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
    }
    // login completion message goes here ---------------------------
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Welcome</strong> '.$_SESSION['username'].'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
   }else if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"){
        $error = $_GET['error'];
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Login failes due to: </strong> '.$error.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
   }


  ?>