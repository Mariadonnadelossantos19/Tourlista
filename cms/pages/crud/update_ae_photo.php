<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

    //FOR PHOTO

    $name=$_FILES["aephoto"]["name"];
    $id=$_SESSION['id'];
    $path = $_FILES['aephoto']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $save=md5($name.$id).".".$ext;
    if($ext != 'php'){
        echo "Upload: " . $save . "<br />";
        echo "Type: " . $ext . "<br />";
        echo "Size: " . ($_FILES["aephoto"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["aephoto"]["tmp_name"] . "<br />";
  
        move_uploaded_file($_FILES["aephoto"]["tmp_name"],"../../uploads/" . $save);
    }
    else{
        header("Location:../core/register_establishment.php");
    }

    //GET GPS

    function triphoto_getGPS($fileName)
    {
        //get the EXIF all metadata from Images
        $exif = exif_read_data($fileName);
        if(isset($exif["GPSLatitudeRef"])) {
            $LatM = 1; $LongM = 1;
            if($exif["GPSLatitudeRef"] == 'S') {
                $LatM = -1;
            }
            if($exif["GPSLongitudeRef"] == 'W') {
                $LongM = -1;
            }
    
            //get the GPS data
            $gps['LatDegree']=$exif["GPSLatitude"][0];
            $gps['LatMinute']=$exif["GPSLatitude"][1];
            $gps['LatgSeconds']=$exif["GPSLatitude"][2];
            $gps['LongDegree']=$exif["GPSLongitude"][0];
            $gps['LongMinute']=$exif["GPSLongitude"][1];
            $gps['LongSeconds']=$exif["GPSLongitude"][2];
    
            //convert strings to numbers
            foreach($gps as $key => $value){
                $pos = strpos($value, '/');
                if($pos !== false){
                    $temp = explode('/',$value);
                    $gps[$key] = $temp[0] / $temp[1];
                }
            }
    
            //calculate the decimal degree
            $result['latitude']  = $LatM * ($gps['LatDegree'] + ($gps['LatMinute'] / 60) + ($gps['LatgSeconds'] / 3600));
            $result['longitude'] = $LongM * ($gps['LongDegree'] + ($gps['LongMinute'] / 60) + ($gps['LongSeconds'] / 3600));
            $result['datetime']  = $exif["DateTime"];
    
            return $result;
        }
    }
    $ppp = "../../uploads/".$save;
    $gps_data = triphoto_getGPS($ppp);

    $gps = "(".$gps_data['latitude'].", ".$gps_data['longitude'].")";

    //FOR DATA UPLOAD
    if($ext != 'php'){

     include '../../connection/connection.php';
     include '../../connection/logs.php';
     recordLog("Updated AE Photo");
      $sql = "UPDATE accommodation_establishment set
      photo = '".$save."', geolocation = '".$gps."' where ae_id = '".$_POST["ae_id"]."'";

      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/registered_establishment.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);

    }
    else{
        header("Location:../core/register_establishment.php");
    }


?>
