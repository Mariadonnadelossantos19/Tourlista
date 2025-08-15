<?php error_reporting(E_ERROR | E_PARSE); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Advanced Tourist Statistics Survey</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language = "javascript">
        function resCheck(x){
            if(x=="Outside the City / Municipality"){
                document.getElementById("province").style.display = "block";
                document.getElementById("citymun").style.display = "block";
                document.getElementById("country").style.display = "none";

            }
            else if(x=="Foreign Country"){
                document.getElementById("country").style.display = "block";
                document.getElementById("province").style.display = "none";
                document.getElementById("citymun").style.display = "none";

            }
            else{
                document.getElementById("country").style.display = "none";
                document.getElementById("province").style.display = "none";
                document.getElementById("citymun").style.display = "none";

            }
        }
        function purCheck(x){
            if(x=="Others"){
                document.getElementById("other_purpose").style.display = "block";

            }
            else{
                document.getElementById("other_purpose").style.display = "none";

            }
        }
        function showCityMun(province_c){
        $.ajax({
          type: "GET",
          url: "loadCityMun.php",
          cache: false,
          data: {province_c},
          success: function(data){
            $("#citymunData").html(data);
          }
        });
      }

    </script>

<style type="text/css">
#deceased{
    background-color:#FFF3F5;
	padding-top:10px;
	margin-bottom:10px;
}
.remove_field{
	float:right;	
	cursor:pointer;
	position : absolute;
}
.remove_field:hover{
	text-decoration:none;
}
</style>
  </head>
  <body style="background: url('../images/bg.png')">
  <div class="container"> <br />
      <div style="background: #D6EAF8;" class="jumbotron primary">
      <h1 style="text-align: center;">Advanced Tourist Statistics Survey</h1><hr />
    <p>
    <?php
            include '../connection/connection.php';
            $sql = "Select * from accommodation_establishment where ae_id = '".$_GET['id']."'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<b>Accommodation Establishment: </b><u>".$row['ae_name']."</u><br /><b>Located at: </b><u>".$row['complete_address']."</u>";
                }
            }else{
                echo "Please enter Accommodation Establishment ID to proceed in the survey.
                <form><input type='number' name='id' placeholder='Enter AE ID Number' min='1' /> <input class='btn btn-primary' type='submit' /></form>";
            }
    ?>


    </p>
  </div>

<?php 

if($_GET['s']=='1'){
    echo '
        <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"><b>Success!</b></h4>
        <p>We received your response. Thank you for dedicating your time in answering the Advanced Tourist Statistics Survey!</p>
        </div>';

}
?>

<div class="panel panel-primary" style="margin:20px;">
	<div class="panel-heading">
        	<h3 class="panel-title">Please answer by selecting / filling-up the required information in the survey form.</h3>
	</div>
<div class="panel-body">
<form action="save_survey.php" method="post">
<input name="ae_id" type="hidden" value="<?= $_GET['id']; ?>" />
<div class="col-md-12 col-sm-12">
	<div class="form-group col-md-6 col-sm-6">
            <label for="name">Where is your residence?</label>
            <select class="form-control input-sm" name="residence" onchange="resCheck(this.value)" required>
		<option value="In this City / Municipality">In this City / Municipality</option>
		<option value="Outside the City / Municipality">Outside the City / Municipality</option>
		<option value="Foreign Country">Foreign Country</option>
	      </select>
    </div>
    <div class="form-group col-md-3 col-sm-3" style="display:none;" id="province">
            <label for="name">Province</label>
            <select class="form-control input-sm" name="province" onchange="showCityMun(this.value)">
        <?php
            include '../connection/connection.php';
            $sql = "Select province_c, province_m from province order by province_m asc";
            $result = mysqli_query($conn, $sql);
            echo  "<option value=''>-Select Province-</option>";
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option class="form-control" value="'.$row["province_c"].'">'.$row["province_m"].'</option>';
                }
            }
            ?>
	      </select>
    </div>
    <div class="form-group col-md-3 col-sm-3" style="display:none;" id="citymun" >
            <label for="name">City/Municipality</label>
            <select class="form-control input-sm" name="citymun" id="citymunData">
            <option value=''>-Select City / Municipality-</option>
	      </select>
    </div>
    <div class="form-group col-md-6 col-sm-6" style="display:none;" id="country">
            <label for="name">Country</label>
            <select class="form-control input-sm" name="country">
            <?php
            include '../connection/connection.php';
            $sql = "Select country_id, country from country order by country asc";
            $result = mysqli_query($conn, $sql);
            echo  "<option value=''>-Select Country-</option>";
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option class="form-control" value="'.$row["country_id"].'">'.$row["country"].'</option>';
                }
            }
            ?>
	      </select>
    </div>
</div>
<div class="col-md-12 col-sm-12">

    <div class="form-group col-md-12 col-sm-12">
            <label for="email">How many night(s) did you spend or are you going to stay in this city/municipality?</label>
            <input type="number" name="num_of_nights" class="form-control input-sm" min="1" max="365" placeholder="Enter Number of Days" required>
    </div>

    <div class="form-group col-md-6 col-sm-6">
            <label for="mobile">What is your main purpose for this travel/visit?
</label>
        <select class="form-control input-sm" name="purpose" onchange="purCheck(this.value)" required>
            <option value="Pleasure / Vacation">Pleasure / Vacation</option>
            <option value="Business / Professional Work">Business / Professional Work </option>
            <option value="Visit Friends and Relatives">Visit Friends and Relatives</option>
            <option value="Meeting, Incentive, Convention, Exhibition">Meeting, Incentive, Convention, Exhibition</option>
            <option value="Others">Others: Pls. specify: </option>
	    </select>
    </div>

	<div id="other_purpose" class="form-group col-md-6 col-sm-6" style="display: none;">
	      <label for="address">Purpose:</label>
	      <input type="text" name="other_purpose" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Purpose of Travel">
	</div>
	
	<div class="form-group col-md-6 col-sm-6">
            <label for="city">Including yourself, how many person(s) are traveling with you?</label>
            <input type="number" name="num_of_traveler" class="form-control input-sm" min="1" max="1000" placeholder="Enter Number of Person Traveling" required>
    </div>
	
	<div class="form-group col-md-6 col-sm-6">
            <label for="state">Who are you traveling with?</label>
            <select class="form-control input-sm" name="traveling_with" required>
            <option value="Alone">Alone</option>
            <option value="Business Colleague">Business Colleague</option>
            <option value="Family">Family</option>
            <option value="Friends">Friends</option>
            <option value="Others">Others</option>
	    </select>
    </div>

	<div class="form-group col-md-6 col-sm-6">
            <label for="country">How much have you spent here in the city / municipality?</label>
            <div class="form-group col-md-6 col-sm-6">
            <input type="text" name="currency" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Currency (PhP, Dollar)" required>
</div>
<div class="form-group col-md-6 col-sm-6">
            <input type="number" name="amount" class="form-control input-sm" min = '1' placeholder="Amount" required>
</div>
        </div>

	<div class="form-group col-md-6 col-sm-6">
            <label for="pincode">How many person(s) are included in the expense you stated?</label>
            <input type="number" name="num_pep_exp" class="form-control input-sm" min = '1' placeholder="Enter Number of Person (include yourself)" required>
        </div>

        <div class="form-group col-md-6 col-sm-6">
            <label for="country">Basic information about your personal profile</label>
            <div class="form-group col-md-6 col-sm-6">
            <input type="number" name="age" class="form-control input-sm" min = '10' max = '100' placeholder="Age" required>
</div>
<div class="form-group col-md-6 col-sm-6">
<select class="form-control input-sm" name="gender" required>
            <option value="">-Select Gender-</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Not Specified</option>
	    </select>
</div>
        </div>
</div>
<div class="col-md-12 col-sm-12" id="deceased">
<label for="name">What attractions did you visit during your stay here in the city/municipality?
Please rate the attractions in a scale of 1 - 4, 4 being the highest</label>
<table class="table col-md-12 col-sm-12">
<thead>
    <tr style="text-align: center;">
    <th style="width: 5%;">#</th>
    <th style="width: 85%;">Tourist Attraction (s)</th>
    <th style="width: 10%;">Rating</th></tr>
</thead>
    <tr>
        <td>	
            1
        </td>
        <td>	
            <input type="text" name="ta1" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta1_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>
    <tr>
        <td>	
            2
        </td>
        <td>	
            <input type="text" name="ta2" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta2_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>
    <tr>
        <td>	
            3
        </td>
        <td>	
            <input type="text" name="ta3" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta3_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>
    <tr>
        <td>	
            4
        </td>
        <td>	
            <input type="text" name="ta4" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta4_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>
    <tr>
        <td>	
            5
        </td>
        <td>	
            <input type="text" name="ta5" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta5_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>
    <tr>
        <td>	
            6
        </td>
        <td>	
            <input type="text" name="ta6" class="form-control input-sm" pattern="[^()/><\][\\\x22;|]+" placeholder="Enter Tourist Attraction">
        </td>
        <td>
            <input type="number" name="ta6_rating" class="form-control input-sm" min='1' max='4' placeholder="">
        </td>

    </tr>

</table>

</div>
<div class="col-md-12 col-sm-12">
    <div>
        <small style="text-align: justify;">
        <b>Privacy Notice: </b> Thank you for dedicating your time to answer this form. This form will be used to review and assess the tourism statistics in the region. Data provided will be handled and treated with utmost confidentiality (in compliance with provisions of Sec 13 and 16 of RA 10173 – Data Privacy Act of 2012) and shall only be used for the purposes of this survey.
        </small>
    </div> <br />
	<div class="form-group col-md-6 col-sm-6 pull-center" >
			<input type="submit" class="btn btn-primary" value="Submit Survey" <?php if($_GET['id']==""){echo "disabled";} ?> />
	</div>
</div>
</div>
</form>
</div>
</body>
</html>