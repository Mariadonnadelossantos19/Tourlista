<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
<thead>
  <tr>
    <th rowspan="3">Day of the Month</th>
    <th rowspan="3">Event Name / Title of Event</th>
    <th rowspan="3">Number of Hours</th>
    <th rowspan="3">Classification (Scope of Event)</th>
    <th rowspan="3">Type of Event</th>
    <th colspan="4">Number of Attendees</th>
    <th colspan="3">Exhibitions</th>
    <th rowspan="3">Name and Address  of Organizer, Contact Person &amp; Tel. No.</th>
  </tr>
  <tr>
    <th colspan="3">Foreign Participants</th>
    <th rowspan="2">Local Attendees</th>
    <th rowspan="2">With Exhibitions? (Yes/No)</th>
    <th rowspan="2">Number of Exhibitors</th>
    <th rowspan="2">Number of Visitors</th>
  </tr>
  <tr>
    <th class="tg-0lax">No. of Foreign Attendees</th>
    <th class="tg-0lax">No. of Countries</th>
    <th class="tg-0lax">Breakdown of Countries</th>
  </tr></thead>
  <tbody>
    <?php
      include '../../connection/connection.php';
      $year = $_GET["year"];
      $month = $_GET["month"];
      $sql = "select * from mice where month = '".$_GET['month']."' and year = '".$_GET['year']."' and user_id = '".$_SESSION['id']."' order by day ASC";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $json_data = $row['foreign_details'];

                // Decode JSON to an associative array
                $data = json_decode($json_data, true);

                // Number of countries
                $num_countries = count($data);

                // Sum of the values
                $sum_values = array_sum($data);

                // Breakdown of countries
                $temp = "";

                foreach ($data as $country => $value) {
                    $temp.= $country. "<br>";
                }
                echo "<tr>
                <td>".$row['day']."</td>
                <td>".$row['event_name']."</td>
                <td>".$row['no_of_hours']."</td>
                <td>".$row['classification']."</td>
                <td>".$row['type']."</td>
                <td>".$row['foreign_tourist']."</td>
                <td>".$num_countries."</td>
                <td>".$temp."</td>
                <td>".$row['local_tourist']."</td>
                <td>".$row['with_exhibition']."</td>
                <td>".$row['num_exhibitors']."</td>
                <td>".($row['no_male']+$row['no_female'])."</td>
                <td>".$row['organizer']." / ".$row['address']." / ".$row['contact_person']." / ".$row['contact_number']."</td>";

                echo '</tr>';

              }
            //  echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>