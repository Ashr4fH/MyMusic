<!DOCTYPE HTML>
<html>
<head>
    <title>Add Song</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
    body {
    }

    a {
  position: absolute;
  left: 50px;
  top: 50px;
  }

  .button {
  display: inline-block;
  padding: 5px 15px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  }

  .button:hover {background-color: #3e8e41}

  .button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  }

    </style>

</head>
<body>
<a href='index1.php' class='btn btn-danger'><i class="fa fa-angle-double-left" style="font-size:36px"></i></a>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Add New Song</h1>
        </div>

    <!-- html form to create product will be here -->
    <!-- PHP insert code will be here -->
    <?php
    if($_POST){
        // include database connection
        include 'config/database.php';

        try{

            // insert query
            $query = "INSERT INTO malaymusic SET title=:title, singer=:singer, year=:year, link=:link, lyrics=:lyrics";

            // prepare query for execution
            $stmt = $con->prepare($query);

            // posted values
            $title=htmlspecialchars(strip_tags($_POST['title']));
            $singer=htmlspecialchars(strip_tags($_POST['singer']));
            $year=htmlspecialchars(strip_tags($_POST['year']));
            $link=htmlspecialchars(strip_tags($_POST['link']));
            $lyrics=htmlspecialchars(strip_tags($_POST['lyrics']));

            // bind the parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':singer', $singer);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':lyrics', $lyrics);

            // Execute the query
            if($stmt->execute()){
                echo "<div class='alert alert-success'>Song saved.</div>";
            }else{
                echo "<div class='alert alert-danger'>Unable to save song.</div>";
            }

        }

        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }
    ?>

    <!-- html form here where the product information will be entered -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
              <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Song Title</td>
                    <td><input type='text' name='title' class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Singer Name</td>
                    <td><input type='text' name='singer' class='form-control' required/></td>
                </tr>
                <tr>
                  <td>Year Published</td>
                  <td><input type='text' name='year' class='form-control' /></td>
                </tr>
                <tr>
                  <td>Youtube link</td>
                  <td><input type='text' name='link' class='form-control' /></td>
                </tr>
                <tr>
                  <td>Lyrics</td>
                  <td><textarea  name="lyrics" rows="20" cols="80" class='form-control' ></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' value='Add Song'  class='button'>Add Song</button>

                    </td>
                </tr>
            </table>
        </form>
    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
