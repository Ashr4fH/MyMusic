<!DOCTYPE HTML>
<html>
<head>
    <title>Update Song</title>
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
  <a href='index2.php' class='btn btn-danger' ><i class="fa fa-angle-double-left" style="font-size:36px"></i></a>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Update Song</h1>
        </div>

        <!-- PHP read record by ID will be here -->
        <?php
       // get passed parameter value, in this case, the record ID
       // isset() is a PHP function used to verify if a value is there or not
       $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

       //include database connection
       include 'config/database.php';

       // read current record's data
       try {
           // prepare select query
           $query = "SELECT id, title, singer, year, link, lyrics FROM koreamusic WHERE id = ? LIMIT 0,1";
           $stmt = $con->prepare( $query );

           // this is the first question mark
           $stmt->bindParam(1, $id);

           // execute our query
           $stmt->execute();

           // store retrieved row to a variable
           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           // values to fill up our form
           $stmt->bindParam(':id', $id);
           $title = $row['title'];
           $singer = $row['singer'];
           $year = $row['year'];
           $link = $row['link'];
           $lyrics = $row['lyrics'];


       }

       // show error
       catch(PDOException $exception){
           die('ERROR: ' . $exception->getMessage());
       }
       ?>

        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->
        <?php

        // check if form was submitted
        if($_POST){

            try{

                // write update query
                // in this case, it seemed like we have so many fields to pass and
                // it is better to label them and not use question marks
                $query = "UPDATE koreamusic
                            SET title=:title, singer=:singer, year=:year, lyrics=:lyrics, link=:link
                            WHERE id = :id";

                // prepare query for excecution
                $stmt = $con->prepare($query);

                // posted values
                $title=htmlspecialchars(strip_tags($_POST['title']));
                $singer=htmlspecialchars(strip_tags($_POST['singer']));
                $year=htmlspecialchars(strip_tags($_POST['year']));
                $link=htmlspecialchars(strip_tags($_POST['link']));
                $lyrics=htmlspecialchars(strip_tags($_POST['lyrics']));


                // bind the parameters
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':singer', $singer);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':link', $link);
                $stmt->bindParam(':lyrics', $lyrics);



                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Song updated.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to update song. Please try again.</div>";
                }

            }

            // show errors
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Song title</td>
                    <td><input type='text' name='title' value="<?php echo htmlspecialchars($title, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Singer Name</td>
                    <td><input type='text' name='singer' value="<?php echo htmlspecialchars($singer, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                  <td>Year Published</td>
                  <td><input type='text' name='year'  value="<?php echo htmlspecialchars($year, ENT_QUOTES);  ?>"class='form-control' /></td>
                </tr>
                <tr>
                  <td>Youtube link</td>
                  <td><input type='text' name='link'  value="<?php echo htmlspecialchars($link, ENT_QUOTES);  ?>"class='form-control' /></td>
                </tr>
                <tr>
                    <td>Lyrics</td>
                    <td><textarea  name="lyrics" rows="20" cols="80" class='form-control'><?php echo htmlspecialchars($lyrics, ENT_QUOTES); ?></textarea></td>
                </tr>
                <tr>

                <tr>
                    <td></td>
                    <td>
                      <button type='submit' value='Update'  class='button'>Update</button>

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
