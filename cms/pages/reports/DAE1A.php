<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th colspan="2">Date</th>
    <th colspan="1">Room Identification (number of rooms occupied)</th>
    <th colspan="3">Visitors Information</th>

  </thead>
  <thead>
    <th>Day</th>
    <th>Day of the week</th>
    <th>No. of Rooms Available</th>
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
        $sql = "select ae_task_id, task_date, day, month, year, no_rooms, no_new_checkin, no_rooms_occupied, no_stayed_overnight from ae_daily_task d left join
        accommodation_establishment a on d.ae_id = a.ae_id where d.user_id = '".$_SESSION['id']."'
                  and day = '".$x."' and month = '".$_GET["month"]."' and year = '".$_GET["year"]."' order by task_date asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                                    echo
                                    '<tr>
                                          <td>'.$x.'</td>
                                          <td>'.date('l', strtotime($_GET["month"].'/'.$x.'/'.$_GET["year"])).'</td>
                                          <td >'.($row['no_rooms']-$row['no_rooms_occupied']).'</td>
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
      <td colspan="3"><b>TOTAL OF THIS MONTH</b></td>
      <td><b>'.$total_ci.'</b></td>
      <td><b>'.$total_so.'</b></td>
      <td><b>'.$total_ro.'</b></td>


      </tr>

      ';
    ?>
  </tbody>