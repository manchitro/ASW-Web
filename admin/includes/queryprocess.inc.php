<?php
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['qbox']) ) {
    $getQuery = $_POST['qbox'];

    $sql = $getQuery;
    $result = mysqli_query($conn, $sql);


    # Exception Handler: IF NOT A SQL QUERY
    if(!$result) {
      echo "Not a SQL Query Found !" . "<br>";
      exit();
    }

    # RETURNS DATA
    if (mysqli_num_rows($result) > 0) {



    # RETURNS COLUMN
    $str = $getQuery;
    $arr = explode(" ",$str);
    $getTableName = "NULL";
    
    foreach($arr as $x => $value) {
      if($value == "from") {
            $getTableName = $arr[$x+1];
        }
    }
    
    $chopSemicolon = chop($getTableName,";");
    $getTableName = strtoupper($chopSemicolon);

    
    $getColumn = "SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'aswdb' AND TABLE_NAME = '" . $getTableName . "';";

    $getColumnResult = mysqli_query($conn, $getColumn);

    while($column = mysqli_fetch_assoc($getColumnResult )) {
      foreach($column as $value) {
        echo "<div style='border: 1px solid #FFF; color: #000; padding: 5px; width: 130px;; display: inline-block; background-color: #CCC; overflow: scroll; height: 40px;'>" . $value . "</div>";
      }
    }







        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            foreach($row as $value) {
              echo "<div style='border: 1px solid #FFF; color: #000; padding: 5px; width: 130px;; display: inline-block; background-color: #CCC; overflow: scroll; height: 40px;'>" . $value . "</div>";
            }
            echo "<br><br>";
        }
    } else {
        echo "0 results";
    }
    
  } else {
    echo "Write Query !!";
  }
  
?>