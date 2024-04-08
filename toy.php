<?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	// Retrieve the value of the 'toynum' parameter from the URL query string
	//		i.e., ../toy.php?toynum=0001
	$toy_id = $_GET['toynum'];
	
	function get_toy_manuf(PDO $pdo, string $id) {

		// SQL query to retrieve toy information based on the toy ID
		$sql = "SELECT t.name as toyname, t.price, t.imgSrc , t.description, t.agerange, t.numinstock, m.name as manufname, m.Street, m.City, m.State, m.ZipCode, m.phone, m.contact 
				FROM toy t 
				JOIN manuf m 
				ON t.manid=m.manid
				WHERE t.toynum= :id;";	

		$toy = pdo($pdo, $sql, ['id' => $id])->fetch();		// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in  SQL query.

		// Return the toy information (associative array)
		return $toy;
	}

	// Retrieve info about toy with ID 
	$toy = get_toy_manuf($pdo, $toy_id);


// Closing PHP tag  ?> 


<!DOCTYPE>
<html>

	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<title>Toys R URI</title>
  		<link rel="stylesheet" href="css/style.css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
	</head>

	<body>

		<header>
			<div class="header-left">
				<div class="logo">
					<img src="imgs/logo.png" alt="Toy R URI Logo">
      			</div>

	      		<nav>
	      			<ul>
	      				<li><a href="index.php">Toy Catalog</a></li>
	      				<li><a href="about.php">About</a></li>
			        </ul>
			    </nav>
		   	</div>

		    <div class="header-right">
		    	<ul>
		    		<li><a href="order.php">Check Order</a></li>
		    	</ul>
		    </div>
		</header>

		<main>
			<!-- 
			  -- TO DO: Fill in ALL the placeholders for this toy from the db
  			  -->
			
			<div class="toy-details-container">
				<div class="toy-image">
					<!-- Display image of toy with its name as alt text -->
					<img src="<?= $toy['imgSrc'] ?>" alt="<?= $toy['toyname'] ?>">
				</div>

				<div class="toy-details">

					<!-- Display name of toy -->
  					<h1><?= $toy['toyname'] ?></h1>
	

			        <hr />

			        <h3>Toy Information</h3>

			        <!-- Display description of toy -->
			        <p><strong>Description:</strong> <?= $toy['description'] ?></p>

			        <!-- Display price of toy -->
			        <p><strong>Price:</strong> $ <?= $toy['price'] ?></p>

			        <!-- Display age range of toy -->
			        <p><strong>Age Range:</strong> <?= $toy['agerange'] ?></p>

			        <!-- Display stock of toy -->
			        <p><strong>Number In Stock:</strong> <?= $toy['numinstock'] ?></p>

			        <br />

			        <h3>Manufacturer Information</h3>

			        <!-- Display name of manufacturer -->
			        <p><strong>Name:</strong> <?= $toy['manufname'] ?> </p>

			        <!-- Display address of manufacturer -->
			        <p><strong>Address:</strong> <?= $toy['Street'] ?> <?= $toy['City'] ?> <?= $toy['State'] ?> <?= $toy['ZipCode'] ?> </p>

			        <!-- Display phone of manufacturer -->
			        <p><strong>Phone:</strong> <?= $toy['phone'] ?> </p>

			        <!-- Display contact of manufacturer -->
			        <p><strong>Contact:</strong> <?= $toy['contact'] ?></p>
			    </div>
			</div>
		</main>

	</body>
</html>
