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
    <style>
    .db {
        min-height: 1000px;
    }
    </style>
    <title>Wediscuss</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar2.php' ?>
    <!-- corusel bootstrap -->
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider-14.png"  class="d-block w-100 ht" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-15.jpg" class="d-block w-100 ht" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-16.jpg" class="d-block w-100 ht" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
   <!-- corousel ends  here  -->
      
   
    <div class="container-fluid dt">
       <h1>Discuss-Categories</h1>
    </div>
    

    <!-- next section  -->
    <!-- next section   -->


    <!-- categories starts here  -->
    <div class= "container db">
        <div class="row">
            <!-- fetch all the categories -->
            <?php 
                $sql = "SELECT * FROM `categories`";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    // echo $row['catid'];
                    $id = $row['catid'];
                    $name = $row['catname'];
                    $about = $row['catdescrip'];
                    echo '<div class="col-md-4 my-2">
                            <div class="card" style="width: 18rem;">
                                <img src="img/card-'.$id.'.jpg" height = "300px" width = "400px" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href = "http://wediscuss.lovestoblog.com/threadlist.php?ctid='.$id.'">'. $name .'</a></h5>
                                    <p class="card-text">'. $about. '</p> 
                                    <a href="http://wediscuss.lovestoblog.com/threadlist.php?ctid='.$id.'" class="btn btn-primary">'.$name.' forums</a>
                                </div>
                            </div>
                        </div>';
                }
            ?>
            <!-- use a loop to iterate through all categories -->


        </div>
    </div>
    <!-- categories ends here -->
    

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