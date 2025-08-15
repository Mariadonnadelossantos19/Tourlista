<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
  <td>Province</td>
  <td>City</td>
  <td>Accommodation Establishment</td>
  <td>Event</td>
  <td>Date</td>
  <td>Month</td>
  <td>Year</td>
  <td>No. of Days</td>
  <td>No. of Hours</td>
  <td>Classification</td>
  <td>Type</td>
  <td>No. of Male</td>
  <td>No. of Female</td>
  <td>Local Tourist</td>
  <td>Foreign Tourist</td>
  <td>Organizer</td>
  <td>Contact Person</td>
  <td>Contact Number</td>
  <td>Address</td>
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
          $addq = "and p.province_c = '".$province."' and c.citymun_c = '".$citymun."'";
      }
      if($_SESSION['level']=='4'){
          $addq = "and p.province_c = '".$province."'";
      }
        $sql = "SELECT province_m, citymun_m, access_level, month, year, ae_name, mice_id, mice_date,event_name, no_of_days, no_of_hours, classification, m.type as ty,
        no_male, no_female, local_tourist, foreign_tourist, organizer, contact_person, m.contact_number, address
        from mice m
        left join ts_users t on m.user_id = t.user_id
        left join accommodation_establishment a on t.user_id = a.user_id
        left join province p on t.province_c = p.province_c
        left join citymun c on t.province_c = c.province_c and t.citymun_c = c.citymun_c
        where access_level = '1' and year = '".$year."' and month = '".$month."' and t.region_c = '".$region."'" .$addq." order by year, province_m, citymun_m asc";
        $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                                    echo
                                    '<tr>
                                          <td>'.$row['province_m'].'</td>
                                          <td>'.$row['citymun_m'].'</td>
                                          <td>'.$row['ae_name'].'</td>
                                          <td>'.$row['event_name'].'</td>
                                          <td>'.$row['mice_date'].'</td>
                                          <td>'.$row['month'].'</td>
                                          <td>'.$row['year'].'</td>
                                          <td>'.$row['no_of_days'].'</td>
                                          <td>'.$row['no_of_hours'].'</td>
                                          <td>'.$row['classification'].'</td>
                                          <td>'.$row['ty'].'</td>
                                          <td>'.$row['no_male'].'</td>
                                          <td>'.$row['no_female'].'</td>
                                          <td>'.$row['local_tourist'].'</td>
                                          <td>'.$row['foreign_tourist'].'</td>
                                          <td>'.$row['organizer'].'</td>
                                          <td>'.$row['contact_person'].'</td>
                                          <td>'.$row['contact_number'].'</td>
                                          <td>'.$row['address'].'</td>
                                    </tr>';
                                }
                    }
    ?>
  </tbody>