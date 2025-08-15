<?php
 include '../connection/connection.php';
 $year = 2021;
 $filR = array();
 $filRT = 0;
 $forRT = 0;
 $RRT = 0;
 $nfilR = array();
 $totalFor = 0;

    //DISPLAYING PHILIPPINE RESIDENTS
   // echo "<tr style='background-color: white;'><td colspan='14'></td></tr>";
   // echo "<tr style='background-color: #026CFF;'><td colspan='14'><b>PHILIPPINE RESIDENTS</b></td></tr>";
   // echo "<tr><td><b>FILIPINO NATIONALITY</b></td>";
    for($d=1; $d<13; $d++){
        $sqlF = "select sum(local_tourist) as lt from ae_daily_task where month = '".$d."' and year = '".$year."'";

            $resultF = mysqli_query($conn, $sqlF);
                if (mysqli_num_rows($resultF) > 0) {
                  while($rowF = mysqli_fetch_assoc($resultF)) {
                    //  echo "<td>".($rowF['lt']+0)."</td>";
                      $filR[$d] = ($rowF['lt']+0);
                      $filRT += $filR[$d];
                  }
                }
    }
   // echo "<td style='color:red;'><b>".$filRT."</td>";
   // echo "</tr>";
  //  echo "<tr><td><b>FOREIGN NATIONALITY</b></td>";
    for($d=1; $d<13; $d++){
    //    echo "<td>0</td>";
    }
   // echo "<td style='color:red;'><b>".$forRT."</td>";
   // echo "</tr>";
   // echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL PHILIPPINE RESIDENTS</b></td>";
    for($d=1; $d<13; $d++){
        $sqlF = "select sum(local_tourist) as lt from ae_daily_task where month = '".$d."' and year = '".$year."'";
           

            $resultF = mysqli_query($conn, $sqlF);
                if (mysqli_num_rows($resultF) > 0) {
                  while($rowF = mysqli_fetch_assoc($resultF)) {
                    //  echo "<td>".($rowF['lt']+0)."</td>";
                      $filR[$d] = ($rowF['lt']+0);
                      $RRT += $filR[$d];
                  }
                }
    }
  //  echo "<td style='color:red;'><b>".$RRT."</td>";
  //  echo "</tr>";
  //  echo "<tr style='background-color: white;'><td colspan='14'></td></tr>";
  //  echo "<tr style='background-color: #026CFF;'><td colspan='14'><b>NON-PHILIPPINE RESIDENTS</b></td></tr>";
  //  echo "<tr style='background-color: white;'><td colspan='14'></td></tr>";



    //GET ALL COUNTRIES AND PUT IN AN ARRAY
    $country = array();
    $topc = array();
    $sqlCountry = "select country from country";
    $resultCountry = mysqli_query($conn, $sqlCountry);
        if (mysqli_num_rows($resultCountry) > 0) {
          while($rowCountry = mysqli_fetch_assoc($resultCountry)) {
              $country[]=array($rowCountry['country']);
              $topc[] = array($rowCountry['country']);
          }
        }

    //DISPLAYING THE COUNTRY
    for($x=0; $x<64; $x++){
      if($x==0){
        //  echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>ASIA</b></td>";
        //  echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>ASEAN</b></td>";
      }
      if($x==9 || $x==14 || $x==20 || $x==27 || $x==30 || $x==35 || $x==42 || $x==48 || $x==53 || $x==56 || $x==61 || $x==63){
        //  echo "<tr style='background-color: #33C6FF;'><td><b>SUB-TOTAL</b></td>";
          
      }

      if($x==9){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 0; $b<9; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>EAST ASIA</b></td></tr>";
      }
      if($x==14){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 9; $b<14; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
        //  echo "<td style='color:red;'><b>".$subtotal."</b></td>";
       //   echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>SOUTH ASIA</b></td></tr>";
      }
      if($x==20){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 14; $b<20; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

         // echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>MIDDLE EAST</b></td></tr>";
      }
      if($x==27){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 20; $b<27; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
          //  echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

         // echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>AMERICA</b></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>NORTH AMERICA</b></td></tr>";
      }
      if($x==30){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 27; $b<30; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

         // echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>SOUTH AMERICA</b></td></tr>";
      }
      if($x==35){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 30; $b<35; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

         // echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>EUROPE</b></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>WESTERN EUROPE</b></td></tr>";
      }
      if($x==42){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 35; $b<42; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
          //echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          //echo "</tr>";

         // echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
         // echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>NORTHERN EUROPE</b></td></tr>";
      }
      if($x==48){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 42; $b<48; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
          //echo "</tr>";

          //echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
          //echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>SOUTHERN EUROPE</b></td></tr>";
      }
      if($x==53){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 48; $b<53; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
           // echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        //  echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        //  echo "<tr style='background-color: #FFE933;'><td colspan='14'><b>EASTERN EUROPE</b></td></tr>";
      }
      if($x==56){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 53; $b<56; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
          //  echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
        //  echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        //  echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>AUSTRALASIA/PACIFIC</b></td></tr>";
      }
      if($x==61){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 56; $b<61; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
          //  echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
        //  echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        //  echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>AFRICA</b></td></tr>";
      }

      if($x==63){
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 61; $b<63; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
          //  echo "<td style='color:red;'><b>".$ss."</b></td>";
          }
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
         // echo "</tr>";

        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        //  echo "<tr style='background-color: #FF5733;'><td colspan='14'><b>OTHERS</b></td></tr>";
      }

     // echo "<tr><td>".$country[$x]['0']."</td>";

    //LOOPING THE DATE VALUES

      for($y=1; $y<13; $y++){
            $sql = "select foreign_details from ae_daily_task where month = '".$y."' and year = '".$year."' and foreign_details like '%".$country[$x]['0']."%'";
            

            $data = "";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $data.=$row['foreign_details'].",";
                  }
                }

            $data = substr($data, 0, -1);
            $data = '['.$data.']';

            $array = json_decode($data, true);
            $sum = 0;
            foreach($array as $values) {
                  $sum+=$values[$country[$x]['0']];
            }
          //  echo "<td>".$sum."</td>";
            $country[$x][$y]=$sum;
            

      }
      $total = 0;
      for($a = 1; $a<13; $a++){
          $total+=$country[$x][$a];
      }
     // echo "<td style='color:red;'><b>".$total."</b></td>";
      $topc[$x]['total'] = $total;

   //   echo "</tr>";

      if($x==63){
        //  echo "<tr style='background-color: #FBF8DE;'><td colspan='14'></td></tr>";
        //  echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL NON-PHILIPPINE RESIDENTS</b></td>";
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 0; $b<64; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
          //  echo "<td style='color:red;'><b>".$ss."</b></td>";
            $nfilR[$c] = $ss;
          } $totalFor = $subtotal;
         // echo "<td style='color:red;'><b>".$subtotal."</b></td>";
      }
     // echo "</tr>";

    }
  //  echo "<tr style='background-color: white;'><td colspan='14'></td></tr>";
  //  echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL OVERSEAS FILIPINO</b></td>";
    for($d=1; $d<13; $d++){
      //  echo "<td>0</td>";
    }
  //  echo "<td style='color:red;'><b>0</td>";
   // echo "</tr>";
  //  echo "<tr style='background-color: white;'><td colspan='14'></td></tr>";
  //  echo "<tr style='background-color: yellow;'><td><b>GRAND TOTAL GUEST ARRIVALS</b></td>";
    for($d=1; $d<13; $d++){
      //  echo "<td>".($filR[$d]+$nfilR[$d])."</td>";
    }
  //  echo "<td style='color:red;'><b>".($RRT+$subtotal)."</td>";
  //  echo "</tr>";
  //  echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL PHILIPPINE RESIDENTS</b></td>";
    for($d=1; $d<13; $d++){
      //  echo "<td>".$filR[$d]."</td>";
    }
  //  echo "<td style='color:red;'><b>".$RRT."</td>";
  //  echo "</tr>";
  //  echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL NON-PHILIPPINE RESIDENTS</b></td>";
          $subtotal = 0;
          for($c=1; $c<13; $c++){
            $ss=0;
            for($b = 0; $b<64; $b++){
              $subtotal+=$country[$b][$c];
              $ss+=$country[$b][$c];
            }
         //   echo "<td>".$ss."</td>";
          }
        //  echo "<td style='color:red;'><b>".$subtotal."</b></td>";
   // echo "</tr>";
  //  echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL OVERSEAS FILIPINO</b></td>";
    for($d=1; $d<13; $d++){
      //  echo "<td>0</td>";
    }
  //  echo "<td style='color:red;'><b>0</td>";
 //   echo "</tr>";
 //   echo "<tr style='background-color: #8CFC0C;'><td><b>TOTAL GUEST WITH UNIDENTIFIED RESIDENCE</b></td>";
    for($d=1; $d<13; $d++){
     //   echo "<td>0</td>";
    }
  //  echo "<td style='color:red;'><b>0</td>";
    $keys = array_column($topc, 'total');
    array_multisort($keys, SORT_DESC, $topc);
    //echo json_encode($topc); echo $totalFor;
?>

