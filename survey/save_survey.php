<?php
    include '../connection/connection.php';
    date_default_timezone_set('Asia/Manila');

      $sql = "INSERT INTO ae_survey 
      (
        residence,
        province,
        citymun,
        country,
        num_of_nights,
        purpose,
        other_purpose,
        num_of_traveler,
        traveling_with,
        currency,
        amount,
        num_pep_exp,
        age,
        gender,
        ta1,
        ta1_rating,
        ta2,
        ta2_rating,
        ta3,
        ta3_rating,
        ta4,
        ta4_rating,
        ta5,
        ta5_rating,
        ta6,
        ta6_rating,
        ae_id,
        date_submitted,
        time_submitted
      )
      VALUES 
      (
        '".$_POST["residence"]."',
        '".$_POST["province"]."',
        '".$_POST["citymun"]."',
        '".$_POST["country"]."',
        '".$_POST["num_of_nights"]."',
        '".$_POST["purpose"]."',
        '".$_POST["other_purpose"]."',
        '".$_POST["num_of_traveler"]."',
        '".$_POST["traveling_with"]."',
        '".$_POST["currency"]."',
        '".$_POST["amount"]."',
        '".$_POST["num_pep_exp"]."',
        '".$_POST["age"]."',
        '".$_POST["gender"]."',
        '".$_POST["ta1"]."',
        '".$_POST["ta1_rating"]."',
        '".$_POST["ta2"]."',
        '".$_POST["ta2_rating"]."',
        '".$_POST["ta3"]."',
        '".$_POST["ta3_rating"]."',
        '".$_POST["ta4"]."',
        '".$_POST["ta4_rating"]."',
        '".$_POST["ta5"]."',
        '".$_POST["ta5_rating"]."',
        '".$_POST["ta6"]."',
        '".$_POST["ta6_rating"]."',
        '".$_POST["ae_id"]."',
        '".date("Y-m-d")."',
        '".date("H:i:s")."'
      )";
      if (mysqli_query($conn, $sql)) {

        header('Location: ../survey/?s=1&id='.$_POST["ae_id"]);
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
