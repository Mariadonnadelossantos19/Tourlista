<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th>Region / Province</th>
    <th>January</th>
    <th>February</th>
    <th>March</th>
    <th>April</th>
    <th>May</th>
    <th>June</th>
    <th>July</th>
    <th>August</th>
    <th>September</th>
    <th>October</th>
    <th>November</th>
    <th>December</th>
    <th>Total</th>
  </thead>
<tbody>
<?php
 include '../../connection/connection.php';
 $year = $_GET["year"];
 $filR = array();
 $filRT = 0;
 $forRT = 0;
 $RRT = 0;
 $nfilR = array();

  
    //GET ALL PROVINCE AND PUT IN AN ARRAY
    $province = array();
    $sqlProvince = "select province_m from region a left join province b on a.region_c = b.region_c order by region_sort asc, province_c asc";
    $resultProvince = mysqli_query($conn, $sqlProvince);
        if (mysqli_num_rows($resultProvince) > 0) {
          while($rowProvince = mysqli_fetch_assoc($resultProvince)) {
              $province[]=array($rowProvince['province_m']);
          }
        }

    //DISPLAYING THE province
    for($x=0; $x<119; $x++){
      if($x==0){
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>NATIONAL CAPITAL REGION</b></td>";
      }
      if($x==17 || $x==21 || $x==26 || $x==35 || $x==41 || $x==47 || $x==53 || $x==61 || $x==68 || $x==75 || $x==80 || $x==87 || $x==93 || $x==98 || $x==105 || $x==111 || $x==118){
          echo "<tr style='background-color: #33C6FF;'><td><b>SUB-TOTAL</b></td>";
          
      }
      if($x==17){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 0; $b<17; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION I  - ILOCOS REGION</b></td></tr>";
      }
      if($x==21){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 17; $b<21; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION II - CAGAYAN VALLEY</b></td></tr>";
      }
      if($x==26){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 21; $b<26; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION III - CENTRAL LUZON</b></td></tr>";
      }
      if($x==35){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 26; $b<35; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION IVA - CALABARZON</b></td></tr>";
      }
      if($x==41){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 35; $b<41; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION IVB - MIMAROPA</b></td></tr>";
      }
      if($x==47){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 41; $b<47; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION V - BICOL REGION</b></td></tr>";
      }
      if($x==53){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 47; $b<53; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION VI - WESTERN VISAYAS</b></td></tr>";
      }
      if($x==61){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 53; $b<61; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION VII - CENTRAL VISAYAS</b></td></tr>";
      }
      if($x==68){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 61; $b<68; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>EASTERN VISAYAS</b></td></tr>";
      }
      if($x==75){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 68; $b<75; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION IX - ZAMBOANGA PENINSULA</b></td></tr>";
      }
      if($x==80){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 75; $b<80; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION X - NORTHERN MINDANAO</b></td></tr>";
      }

      if($x==87){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 80; $b<87; $b++){
              $subtotal+=$province[$b][$c];
              $ss+=$province[$b][$c];
            }
            echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          echo "</tr>";

          echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION XI - DAVAO REGION</b></td></tr>";
      }

      if($x==93){
        $subtotal = 0;
        for($c=1; $c<13; $c++){
          $ss=0;
          for($b = 87; $b<93; $b++){
            $subtotal+=$province[$b][$c];
            $ss+=$province[$b][$c];
          }
          echo "<td style='color:red;'><b>".$ss."</b></td>";
        }
        echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        echo "</tr>";

        echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION XII - SOCCSKSARGEN</b></td></tr>";
    }

    if($x==98){
        $subtotal = 0;
        for($c=1; $c<13; $c++){
          $ss=0;
          for($b = 93; $b<98; $b++){
            $subtotal+=$province[$b][$c];
            $ss+=$province[$b][$c];
          }
          echo "<td style='color:red;'><b>".$ss."</b></td>";
        }
        echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        echo "</tr>";

        echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>CORDILLERA ADMINISTRATIVE REGION</b></td></tr>";
    }
    if($x==105){
        $subtotal = 0;
        for($c=1; $c<13; $c++){
          $ss=0;
          for($b = 98; $b<105; $b++){
            $subtotal+=$province[$b][$c];
            $ss+=$province[$b][$c];
          }
          echo "<td style='color:red;'><b>".$ss."</b></td>";
        }
        echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        echo "</tr>";

        echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>REGION XIII - CARAGA</b></td></tr>";
    }

    if($x==111){
        $subtotal = 0;
        for($c=1; $c<13; $c++){
          $ss=0;
          for($b = 105; $b<111; $b++){
            $subtotal+=$province[$b][$c];
            $ss+=$province[$b][$c];
          }
          echo "<td style='color:red;'><b>".$ss."</b></td>";
        }
        echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        echo "</tr>";

        echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>BARMM - BANGSAMORO AUTONOMOUS REGION IN MUSLIM MINDANAO</b></td></tr>";
    }

    if($x==118){
        $subtotal = 0;
        for($c=1; $c<13; $c++){
          $ss=0;
          for($b = 111; $b<118; $b++){
            $subtotal+=$province[$b][$c];
            $ss+=$province[$b][$c];
          }
          echo "<td style='color:red;'><b>".$ss."</b></td>";
        }
        echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        echo "</tr>";
    }

    if($x==118){
        echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        echo "<tr style='background-color: #026CFF;'><td><b>TOTAL LOCAL TOURIST</b></td>";
        $total_local = 0;
        for($y=1; $y<13; $y++){
            $sql = "";
            $tot = 0;
            if($_SESSION['level']=='5'){
            $sql = "select sum(local_tourist) as tot from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
            left join ts_users u on x.user_id = u.user_id where approve_status = '1' and month = '".$y."' and year = '".$year."'";
            }
            if($_SESSION['level']=='4'){
            $sql = "select sum(local_tourist) as tot from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
            left join ts_users u on x.user_id = u.user_id where approve_status = '1' and province_c = '".$_GET['province']."' and month = '".$y."' and year = '".$year."'";
            }
            if($_SESSION['level']=='3'){
            $sql = "select sum(local_tourist) as tot from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
            left join ts_users u on x.user_id = u.user_id where approve_status = '1' and province_c = '".$_GET['province']."' and citymun_c = '".$_GET['citymun']."' and month = '".$y."' and year = '".$year."'";
            }
        

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              $tot = $row['tot'];
              $total_local+=$tot;
          }
        }
        echo "<td><b>".number_format($tot)."</b></td>";
    }

        echo "<td><b>".number_format($total_local)."</b></td>";
        echo "</tr>";

    }


      echo "<tr><td>".$province[$x]['0']."</td>";

    //LOOPING THE DATE VALUES

      $cacheDir = __DIR__ . '/cache';
      if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0777, true);
      }
      for($y=1; $y<13; $y++){
            if($_SESSION['level']=='5'){
              $cacheFile = $cacheDir . '/cached_data_' . $_SESSION['level'] . '_' . $year . '_' . $province[$x]['0'] . '_' . $y . '.json';
          }
          if($_SESSION['level']=='4'){
              $cacheFile = $cacheDir . '/cached_data_' . $_SESSION['level'] . '_' . $year . '_' . $_GET['province'] . '_' . $province[$x]['0'] . '_' . $y . '.json';
          }
          if($_SESSION['level']=='3'){
              $cacheFile = $cacheDir . '/cached_data_' . $_SESSION['level'] . '_' . $year . '_' . $_GET['province'] . '_' . $_GET['citymun'] . '_' . $province[$x]['0'] . '_' . $y . '.json';
            
          }
          $cacheLifetime = 3600; // Cache lifetime in seconds (1 hour)

                      // Check if the cache file exists and if it's still valid
          if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheLifetime) {
              $data = file_get_contents($cacheFile);
          } else {

            $sql = "";
            if($_SESSION['level']=='5'){
              $sql = "select local_details from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
              left join ts_users u on x.user_id = u.user_id where approve_status = '1' and month = '".$y."' and year = '".$year."' and local_details like '%".$province[$x]['0']."%'";
            }
            if($_SESSION['level']=='4'){
              $sql = "select local_details from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
              left join ts_users u on x.user_id = u.user_id where approve_status = '1' and province_c = '".$_GET['province']."' and month = '".$y."' and year = '".$year."' and local_details like '%".$province[$x]['0']."%'";
            }
            if($_SESSION['level']=='3'){
              $sql = "select local_details from ae_daily_task a left join accommodation_establishment x on a.ae_id = x.ae_id
              left join ts_users u on x.user_id = u.user_id where approve_status = '1' and province_c = '".$_GET['province']."' and citymun_c = '".$_GET['citymun']."' and month = '".$y."' and year = '".$year."' and local_details like '%".$province[$x]['0']."%'";
            }

            $data = "";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    if (is_object(json_decode($row['local_details']))) 
                    { 
                        $data.=$row['local_details'].",";
                    }
                  }
                }

            $data = substr($data, 0, -1);
            $data = '['.$data.']';
            file_put_contents($cacheFile, $data);
            }

            $array = json_decode($data, true);
            $sum = 0;
            foreach($array as $values) {
                  $sum+=intval($values[$province[$x]['0']]);
            }
            echo "<td>".$sum."</td>";
            $province[$x][$y]=$sum;
            

      }
      $total = 0;
      for($a = 1; $a<13; $a++){
          $total+=$province[$x][$a];
      }
      echo "<td style='color:red;'><b>".$total."</b></td>";
      
      echo "</tr>";

    }

?>

 </tbody>
