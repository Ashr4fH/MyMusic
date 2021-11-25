<!DOCTYPE HTML>
<html>
<head>
    <title>Song Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
    body {
        background-image: url('d.jpg');
    }
    button {
  position: absolute;
  left: 50px;
  top: 50px;
}
    </style>
</head>
<body>
   <form action="index.php" method = post>
  <button class='btn btn-danger'><i class="fa fa-angle-double-left" style="font-size:36px"></i></button>
  </form>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Song Detail</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Song ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT id, title, singer, year, link, lyrics FROM engmusic WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
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
        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Song title</td>
                <td><?php echo htmlspecialchars($title, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Singer Name</td>
                <td><?php echo htmlspecialchars($singer, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Year Published</td>
                <td><?php echo htmlspecialchars($year, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Youtube Link</td>
                <td><a href = '<?php echo htmlspecialchars($link, ENT_QUOTES);  ?>'><?php echo htmlspecialchars($link, ENT_QUOTES);?></td>
            </tr>
            <tr>
                <td>Lyrics</td>
                <td><textarea  name="lyrics" rows="20" cols="80" class='form-control'><?php echo htmlspecialchars($lyrics, ENT_QUOTES);  ?></textarea></td>
            </tr>
                <td></td>
                <td>

                </td>

            </tr>
        </table>
    </div> <!-- end .container -->
</div> <!-- end .bg -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
