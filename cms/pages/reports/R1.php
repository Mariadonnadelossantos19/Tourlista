<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th colspan="2">Date</th>
    <th colspan="10">Room Identification (adjust number of columns=number of rooms)</th>
    <th colspan="3">Visitors Information</th>

  </thead>
  <thead>
    <td>Day</td>
    <td>Day of the week</td>
    <td>RM 1</td>
    <td>RM 2</td>
    <td>RM 3</td>
    <td>RM 4</td>
    <td>RM 5</td>
    <td>RM 6</td>
    <td>RM 7</td>
    <td>RM 8</td>
    <td>RM 9</td>
    <td>RM 10</td>
    <th>No. of Guests Check In</th>
    <th>No. of Guests staying over-night</th>
    <th>No. of Rooms Occupied by Guests</th>
  </thead>
  <tbody>
    <?php
      include '../../connection/connection.php';
      $d=cal_days_in_month(CAL_GREGORIAN,$_GET["month"],date("Y"));
      $x = $_GET["month"];
      $total_ci = 0;
      $total_so = 0;
      $total_ro = 0;
      for($x=1; $x<=$d; $x++){
        $sql = "select ae_task_id, task_date, day, month, year, no_new_checkin, no_rooms_occupied, no_stayed_overnight from ae_daily_task where user_id = '".$_SESSION['id']."'
                  and day = '".$x."' and month = '".$_GET["month"]."' order by task_date asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                                    echo
                                    '<tr>
                                          <td>'.$x.'</td>
                                          <td>'.date('l', strtotime($_GET["month"].'/'.$x.'/'.$_GET["year"])).'</td>
                                          <td colspan="10"></td>
                                          <td>'.$row['no_new_checkin'].'</td>
                                          <td>'.$row['no_stayed_overnight'].'</td>
                                          <td>'.$row['no_rooms_occupied'].'</td>
                                    </tr>';
                                    $total_ci += $row['no_new_checkin'];
                                    $total_so += $row['no_stayed_overnight'];
                                    $total_ro += $row['no_rooms_occupied'];
                                }
                    }
      }
      echo 
      '
      <tr>
      <td colspan="12"><b>TOTAL OF THIS MONTH</b></td>
      <td><b>'.$total_ci.'</b></td>
      <td><b>'.$total_so.'</b></td>
      <td><b>'.$total_ro.'</b></td>


      </tr>

      ';
    ?>
  </tbody>