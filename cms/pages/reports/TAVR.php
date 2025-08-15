<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
<thead style="text-align: center;">
<tr>
    <th colspan="2">Visitor Attraction</th>
    <th colspan="12">Place of Residence</th>
    <th colspan="3" rowspan="3">Grand Total Number of Visitors</th>
  </tr>
  <tr>
    <th rowspan="3">Name</th>
    <th rowspan="3">Attraction Code</th>
    <th colspan="9">Philippines</th>
    <th colspan="3" rowspan="2">Foreign Country of Residence</th>
  </tr>
  <tr>
    <th colspan="3">This Municipality</th>
    <th colspan="3">This Province</th>
    <th colspan="3">Other Province</th>
  </tr>
  <tr>
    <th>Male</th>
    <th>Female</th>
    <th>Total</th>
    <th>Male</th>
    <th>Female</th>
    <th>Total</th>
    <th>Male</th>
    <th>Female</th>
    <th>Total</th>
    <th>Male</th>
    <th>Female</th>
    <th>Total</th>
    <th>Male</th>
    <th>Female</th>
    <th>Total</th>
  </tr>
  </thead>
  <tbody>
  <?php
  include '../../connection/connection.php';
  $year = $_GET["year"];
  $month = $_GET["month"];
  $region = $_GET["region"];
  $province = $_GET["province"];
  $citymun = $_GET["citymun"];
  $addq = "";

  if($_SESSION['level']=='3'){
      $addq = "and p.province_c = '".$province."' and c.citymun_c = '".$citymun."' and year = '".$year."' and month = '".$month."'";
  }
  if($_SESSION['level']=='4'){
      $addq = "and p.province_c = '".$province."' and year = '".$year."' and month = '".$month."'";
  }

  $sql = "select ta_name, sum(r_male) as r_male, sum(r_female) as r_female, sum(nr_male) as nr_male, sum(nr_female) as nr_female,
    sum(fo_male) as fo_male, sum(fo_female) as fo_female  from tourist_attraction a
    left join ta_daily_task b on a.ta_id = b.ta_id
    left join ts_users t on a.user_id = t.user_id 
    left join province p on t.province_c = p.province_c 
    left join citymun c on t.citymun_c = c.citymun_c and c.province_c = p.province_c
    where a.approve_status = '1' and t.region_c = '".$region."' " .$addq." group by a.ta_id";

  $result = mysqli_query($conn, $sql);

  // Initialize totals
  $total_r_male = 0;
  $total_r_female = 0;
  $total_nr_male = 0;
  $total_nr_female = 0;
  $total_fo_male = 0;
  $total_fo_female = 0;

  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        // Add to totals
        $total_r_male += $row['r_male'];
        $total_r_female += $row['r_female'];
        $total_nr_male += $row['nr_male'];
        $total_nr_female += $row['nr_female'];
        $total_fo_male += $row['fo_male'];
        $total_fo_female += $row['fo_female'];

        // Output each row
        echo "<tr>
          <td>".$row['ta_name']."</td>
          <td>N/A</td>
          <td>".$row['r_male']."</td>
          <td>".$row['r_female']."</td>
          <td>".($row['r_male']+$row['r_female'])."</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>".$row['nr_male']."</td>
          <td>".$row['nr_female']."</td>
          <td>".($row['nr_male']+$row['nr_female'])."</td>
          <td>".$row['fo_male']."</td>
          <td>".$row['fo_female']."</td>
          <td>".($row['fo_male']+$row['fo_female'])."</td>
          <td>".($row['fo_male']+$row['nr_male']+$row['r_male'])."</td>
          <td>".($row['fo_female']+$row['nr_female']+$row['r_female'])."</td>
          <td>".($row['fo_female']+$row['nr_female']+$row['r_female']+$row['fo_male']+$row['nr_male']+$row['r_male'])."</td>
        </tr>";
      }

      // Output totals row
      echo "<tr>
        <td colspan = '2'><strong>Total of this Month</strong></td>
        <td><strong>".$total_r_male."</strong></td>
        <td><strong>".$total_r_female."</strong></td>
        <td><strong>".($total_r_male + $total_r_female)."</strong></td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td><strong>".$total_nr_male."</strong></td>
        <td><strong>".$total_nr_female."</strong></td>
        <td><strong>".($total_nr_male + $total_nr_female)."</strong></td>
        <td><strong>".$total_fo_male."</strong></td>
        <td><strong>".$total_fo_female."</strong></td>
        <td><strong>".($total_fo_male + $total_fo_female)."</strong></td>
        <td><strong>".($total_fo_male + $total_nr_male + $total_r_male)."</strong></td>
        <td><strong>".($total_fo_female + $total_nr_female + $total_r_female)."</strong></td>
        <td><strong>".($total_fo_female + $total_nr_female + $total_r_female + $total_fo_male + $total_nr_male + $total_r_male)."</strong></td>
      </tr>";
  }
?>

  </tbody>