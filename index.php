<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<title>Solar Power Estimator</title>
</head>

<body>
	<div id="app">

		<div>
			<h1>Soli Calc</h1>
            <?php
                if (!isset($_POST['calculateButton']))
                {
            ?>
                <form method="POST">
				<div class="form">
					<div id="display">
					
					</div>

					<div class="name-input">
						<input type="text" name="name" placeholder="Name of Electronic" required/>
					</div>
					<div class="quantity-watt">
						<input type="number" name="quantity" size="30" placeholder="Quantity" required/>
                        <input type="number" name="watt" placeholder="Power Consumption in Watts" required/><br>
                        <input type = 'number' name = 'average_rate' width = '5' placeholder = "Rate (Hrs)" required />
                        <input type = 'number' name = 'average_days' width = '5' placeholder = "Days (365 used)" required />
						<button id="addButton">Add</button>
					</div>

					<div id="calculate">
						<button name = 'calculateButton' id="calculateButton">Calculate</button>
					</div>
				</div>
			</form>
            <?php 
                }else {
                    /**
                     * From : https://www.naijatechguide.com/2017/03/lumos-smart-solar-system-specs-price.html
                     * MTN yellow box has 
                     * 300Wh rating and costs N46720 per annum
                     * So with 24 hours power supply in a year
                     * we have 
                     * (24hours * 365day * 300Wh) / 1000  = N46720
                     * ==> 2628Kwh = N46720.00
                     * 1 Kwh = (N46720 / 2628) = N17.78 === N18.00 / kwh
                     */

                    // echo "Name : ".$_POST['name']."<br>";
                    // echo "Quantity : ".$_POST['quantity']."<br>";
                    // echo "Wattage : ".$_POST['watt']."<br>";
                    // echo "Average Rate : ".$_POST['average_rate']."<br>";

                    //let one kilowatt cost N100 
                    //$consumption = $_post['watt'] * $_POST['days'] * $_POST['hours']
                    $consumption = ($_POST['watt'] * 365 * $_POST['average_rate']) / 1000;
                    $appliance_consumption = 17.78 * $consumption;
                    echo $_POST['name'] . " is using N" . $appliance_consumption . " per year, ". $appliance_consumption / 12 ." per month";
                    
            ?>
                    <form method="POST">
				<div class="form">
					<div id="display">
					
					</div>

					<div class="name-input">
						<input type="text" name="name" placeholder="Name of Electronic" required/>
					</div>
					<div class="quantity-watt">
						<input type="number" name="quantity" size="30" placeholder="Quantity" required/>
                        <input type="number" name="watt" placeholder="Power Consumption in Watts" required/><br>
                        <input type = 'number' name = 'average_rate' placeholder = "Ave. Hours of Usage" required />
						<button id="addButton">Add</button>
					</div>

					<div id="calculate">
						<button name = 'calculateButton' id="calculateButton">Calculate</button>
					</div>
				</div>
            </form>

            <?php 
                }
            ?>

			
		</div>


		<!-- <form method="post" action="/database/validate.php"></form> -->
	</div>
	<script src="index.js"></script>
</body>

</html>

