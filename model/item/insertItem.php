<?php
	//require_once('../../inc/config/constants.php');
	//require_once('../../inc/config/db.php');
	require_once('../../inc/style.html');

	$initialStock = 0;
	$baseImageFolder = '../../data/item_images/';
	$itemImageFolder = '';

	if(isset($_POST['submit'])){
		$productID = htmlentities($_POST['itemDetailsProductID']);
		$itemNumber = htmlentities($_POST['itemDetailsItemNumber']);
		$itemName = htmlentities($_POST['itemDetailsItemName']);
		$quantity = htmlentities($_POST['itemDetailsQuantity']);
		$unitPrice = htmlentities($_POST['itemDetailsUnitPrice']);
		$status = htmlentities($_POST['itemDetailsStatus']);
		$description = htmlentities($_POST['itemDetailsDescription']);
		$fullName = htmlentities($_POST['vendorDetailsVendorFullName']);
		$email = htmlentities($_POST['vendorDetailsVendorEmail']);
		$mobile = htmlentities($_POST['vendorDetailsVendorMobile']);
		$address = htmlentities($_POST['vendorDetailsVendorAddress']);
		$city = htmlentities($_POST['vendorDetailsVendorCity']);
		$district = htmlentities($_POST['vendorDetailsVendorDistrict']);

		// Check if mandatory fields are not empty
		if(!empty($itemNumber) && !empty($itemName) && isset($quantity) && isset($unitPrice)){

			// Sanitize item number
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

			// Validate item quantity. It has to be a number
			if(filter_var($quantity, FILTER_VALIDATE_INT) === 0 || filter_var($quantity, FILTER_VALIDATE_INT)){
				// Valid quantity
			} else {
				// Quantity is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				exit();
			}

			// Validate unit price. It has to be a number or floating point value
			if(filter_var($unitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($unitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid float (unit price)
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				exit();
			}

			// Create image folder for uploading images
			$itemImageFolder = $baseImageFolder . $itemNumber;
			if(is_dir($itemImageFolder)){
				// Folder already exist. Hence, do nothing
			} else {
				// Folder does not exist, Hence, create it
				mkdir($itemImageFolder);
			}


			if(isset($fullName) && isset($mobile) && isset($address)){
					// Validate mobile number
				if(filter_var($mobile, FILTER_VALIDATE_INT) === 0 || filter_var($mobile, FILTER_VALIDATE_INT))
				{
						// Valid mobile number
				} else
					{
					// Mobile is wrong
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number.</div>';
						exit();
					}

						// Check if mobile phone is empty
					if($mobile == ''){
							// Mobile phone  is empty
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter mobile phone number.</div>';
							exit();
						}
							// Validate email only if it's provided by user
							if(!empty($email)) {
								if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
									// Email is not valid
									echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email.</div>';
									exit();
								}
							}

							// Validate address
							if($address == '')
							{
								// Address  is empty
								echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address.</div>';
									exit();
							}
			}

			// Calculate the stock values
			$dbconnect = mysqli_connect('localhost','root','','cse_inventory');
			$stockSql = mysqli_query($dbconnect, 'SELECT stock FROM item WHERE itemNumber=  $itemNumber');

			if($stockSql > 0){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item already exists in DB. Please click the <strong>Update</strong> button to update the details. Or use a different Item Number.</div>';
			exit();
		}
			 else {
					// Item does not exist, therefore, you can add it to DB as a new item
			$sql = mysqli_query($dbconnect, "insert into item(productID, itemNumber, itemName, stock, unitPrice, status, description, fullName, email, mobile, address, city, district) VALUES ('','$itemNumber', '$itemName', '$quantity','$unitPrice','$status','$description', '$fullName', '$email','$mobile', '$address', '$city','$district')");

			if($sql){
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item added to database.</div>';
					exit();
				}else{
					echo "Error, please try again!";
			}
		}
}

		 else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}

?>
