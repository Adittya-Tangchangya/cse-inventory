	<!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <div class="container">
      <a href="https://juniv.edu/"><img src="data\item_images\JU logo.png" alt="Jahangirnagar University" height="55" width="55"></a>
      <a class="navbar-brand" style="padding-left: 380px; font-size: 30px" href="<?php echo ROOT_URL; ?>">CSE Inventory System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

			<li class="nav-item">
				<span class="nav-link">Welcome <?php echo $_SESSION['fullName']; ?></span>
            </li>
			<li class="nav-item">
				<span class="nav-link"> | </span>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="model/login/logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
