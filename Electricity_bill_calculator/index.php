<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="Assignment_2_273760.css">
	<title>Calculate Electricity Bill</title>
</head>

<div class="container" align="center">

<?php
$result_str1 = $units = '';
$result_str2 = $result = '';
	if (isset($_POST['currentreading']) && isset($_POST['previousreading'])){
		$currentreading=$_POST['currentreading'];
		$previousreading=$_POST['previousreading'];
    if (!empty($currentreading) && !empty($currentreading))  {
        $units=$currentreading-$previousreading;
		$result = calculate_bill($units);
        $result_str1 = $units . 'kWh';
		$result_str2 = 'RM' . $result;
    }
	
}
/**
 * To calculate electricity bill as per unit cost
 */
function calculate_bill($units) {
    $unit_cost_first = 0.218;
    $unit_cost_second = 0.334;
    $unit_cost_third = 0.516;

    if($units <= 200) {
        $bill = $units * $unit_cost_first;
    }
    else if($units > 200 && $units <= 300) {
        $temp = 200 * $unit_cost_first;
        $remaining_units = $units - 200;
        $bill = $temp + ($remaining_units * $unit_cost_second);
    }
    else {
        $temp = (200 * $unit_cost_first) + (100 * $unit_cost_second);
        $remaining_units = $units - 300;
        $bill = $temp + ($remaining_units * $unit_cost_third);
    }
    return number_format((float)$bill, 2, '.', '');
}

?>

<body>
<div class="content">
		<h1>Electricity Bill Calculator</h1>

		<form action="" method="post" id="content">
            	<label for="currentreading">Current Reading :</label>
				<input type="number" value="<?=$currentreading?>" name="currentreading" id="currentreading" placeholder="in kWh" /> <br><br>
				<label for="previousreading">Previous Reading :</label>
				<input type="number" value="<?=$previousreading?>" name="previousreading" id="previousreading" placeholder="in kWh" /><br><br>
            	<input type="reset" class= "button" value="Reset" id="reset" name="reset">
				<input type="submit" class="button" name="unit-submit" id="unit-submit" value="Calculate" />
		</form>
</div>

	<div class="result">
        <p>KWh used   :
			<span id="result_str1">
				<?=$result_str1 ?>
            </span>
		</p>
        <p>Amount to be paid   : 
            <span id="result_str2">
                <?=$result_str2 ?> 
            </span>
        </p>
	</div>
</body>
</html>