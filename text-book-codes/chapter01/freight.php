<!DOCTYPE html>
<html>
  <head>
   <title>Bob's Auto Parts - Freight Costs</title>
  </head>
  <body>
    
    <table style="border: 0px; padding: 3px">
    <tr>
     <td style="background: #cccccc; text-align: center;">Distance</td>
     <td style="background: #cccccc; text-align: center;">Cost</td>
    </tr>

    <?php
    /**
     * Declare a variable for distance
     */
    $distance = 50;

    // A loop
    while ($distance <= 250) {
      echo "<tr>
            <td style=\"text-align: right;\">".$distance."</td>
            <td style=\"text-align: right;\">".($distance / 10)."</td>
            </tr>\n";
      $distance += 50;
    }
    ?>
    
    </table>
  </body>
</html>