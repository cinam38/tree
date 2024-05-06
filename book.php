<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Title -->
	<title>Assignment</title>

    <!-- Bootstra CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	
	<!-- ================Header Start================ -->
	<header>
		<!-- Navigation Start -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="images/logo.png" alt="">
					<span>Oasis Petcare</span>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav m-auto mb-2 mb-lg-0">

						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="index.php">Home</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" href="book.php">Book Now</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="about.php">About Us</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="contact.php">Contat Us</a>
						</li>
					</ul>
					
					<form class="d-flex">
						<a class="login-btn" href="login.php">Login</a>
					</form>

				</div>
			</div>
		</nav>
		<!-- Navigation End -->
	</header>
	<!-- ================Header End================ -->

	<!-- ================Main Start================ -->
	<!-- Banner Section Start -->
	<section>
		<div class="book-now">
			<div class="container">
				<div class="page-title">
					<h1>Booking Now!</h1>
				</div>
				<div class="row book-now-bg">
					<div class="col-lg-6">
						<div class="book-now-left-area">
							<h1>Give your pet a dream vacation!</h1>
							<p>Our pet hotel is the ideai place to stay for your furry friend! We'll make sure their vacation will be just as great as yours!</p>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="book-now-right-area">
							<div class="book-now-form">
								<div class="title">
									<h1>Booking your pet's stay!</h1>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sapiente.</p>
								</div>
								<form method="POST" action="submit.php">

									<div class="row g-3 align-items-center">
										<div class="col-auto">
											<label for="check-in" class="form-label">Check In</label>
											<input type="date" id="check_in" class="form-control" name="checkin" required>
										</div>
			
										<div class="col-auto">
											<label for="check-out" class="form-label">Check Out</label>
											<input type="date" id="check_out" class="form-control" name="checkout" required>
										</div>
									</div>

									<div class="mb-3">
										<label for="Location" class="form-label">Location</label>
										<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="location" required>
											<option value="" disabled selected>Select Your Location</option>
											<option value="Eastern Region">Eastern Region</option>
											<option value="Central Region">Central Region</option>
											<option value="Southern Region">Southern Region</option>
											<option value="Western Region">Western Region</option>
											<option value="Northern Region">Northern Region</option>
										</select>
									</div>

									<div class="form-floating mb-3">
										<textarea class="textarea" placeholder="Commnets" id="textarea"  name="comments" required></textarea>

									</div>

									<div class="mb-3">
										<label for="Location" class="form-label">Who's joining us?</label>
										<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="width: 75%" name="pet_type" required>
											<option value="" disabled selected>Select Your Pet Type</option>
											<option value="Cats">Cats </option>
											<option value="Dogs">Dogs</option>
											<option value="Birds">Birds</option>
											<option value="Hamster">Hamster</option>
										</select>

										<div class="counter">
											<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
											<input type="text" id="number" value="0" name="count" />
											<div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
										</div>
									</div>                    

                                   <div class="buttons-flex">
                                   	<button type="reset" class="btn btn-primary">Cancel</button>
                                   	<button type="submit" class="btn btn-primary">Confirm</button>
                                   </div>

								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- Banner Section End -->
	<!-- ================Main End================ -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
    	function increaseValue() {
    		var value = parseInt(document.getElementById('number').value, 10);
    		value = isNaN(value) ? 0 : value;
    		value++;
    		document.getElementById('number').value = value;
    	}

    	function decreaseValue() {
    		var value = parseInt(document.getElementById('number').value, 10);
    		value = isNaN(value) ? 0 : value;
    		value < 1 ? value = 1 : '';
    		value--;
    		document.getElementById('number').value = value;
    	}
    </script>

</body>
</html>