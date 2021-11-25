<!DOCTYPE HTML>
<html>
<head>
    <title>English Song List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }

  button
    {
      display: inline-block;
      padding: 5px 15px;
      font-size: 20px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      outline: none;
      color: #fff;
      background-color: red;
      border: none;
      border-radius: 15px;
      box-shadow: 0 9px #999;
      margin: 50px 50px;
    }
    body {
    }
    </style>

</head>

<body>
  <div class="w3-display-topleft" ><form method="post" >
      <button type="submit" name="back" value="back"><i class="fa fa-angle-double-left" style="font-size:36px"></i></button>

      <?php
      // If the user requested logout go back to homepage.php
      if ( isset($_POST['back']) ) {
          header('Location: category.php');
          return;
      }
      ?>
  </form></div>
<div class="w3-display-topright" ><form method="post" >
  <button type="submit" name="logout" value="logout" onclick="logout();">Logout</button>

  <?php
  // If the user requested logout go back to homepage.php
  if ( isset($_POST['logout']) ) {
      header('Location: login.php');
      return;
  }
  ?>

</form></div>

</div>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Top English Song List</h1>
        </div>

        <!-- PHP code to read records will be here -->
        <?php
        // include database connection
        include 'config/database.php';

        // delete message prompt will be here
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if($action=='deleted'){
            echo "<div class='alert alert-success'>Song deleted.</div>";
        }
        // select all data
        $query = "SELECT id, title, singer, year, link, lyrics FROM engmusic ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<a href='create.php' class='btn btn-primary m-b-1em'>Add new song</a>";

        //check if more than 0 record found
        if($num>0){

            // data from database will be here
            echo "<table class='table table-hover table-responsive table-bordered'>";//start table

                //creating our table heading
                echo "<tr>";
                    echo "<th>Title</th>";
                    echo "<th>Singer</th>";
                    echo "<th>Year</th>";
                echo "</tr>";

                // table body will be here
                // retrieve our table contents
                // fetch() is faster than fetchAll()
                // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['firstname'] to
                    // just $firstname only
                    extract($row);

                    // creating new table row per record
                    echo "<tr>";
                        echo "<td>{$title}</td>";
                        echo "<td>{$singer}</td>";
                        echo "<td>{$year}</td>";
                        echo "<td>";
                            // read one record
                            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>View</a>";

                            // we will use this links on next part of this post
                            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                            // we will use this links on next part of this post
                            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            // end table
            echo "</table>";
        }

        // if no records found
        else{
            echo "<div class='alert alert-danger'>No Song found.</div>";
        }
        ?>
   </div> <!-- end .container -->

<!-- confirm delete record will be here -->
<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
    var answer = confirm('Delete song?');
    if (answer){
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}
</script>
</body>
</html>
