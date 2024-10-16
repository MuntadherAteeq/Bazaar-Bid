<div class="row">
<header>
      <div id="header-container">
		<a style="text-decoration: none;" href="index.php">
			<div id="logo-container">
			  <div>
				<div class="box">
				  <img src="assets/logo.svg" alt="logo" class="img" />
				  <div id="logo-title">Bazaar-Bid</div>
				</div>
			  </div>
			</div>
		</a>
        <div id="buttons-contaner">
		<?php
if (isset( $_SESSION['user'])) {
				?>
					<form method="post" action="user.php">
						<input name="logout"  class="primary-button red-background" value="Logout" type="submit" />
					</form>
				<?php } ?>
		  <?php
if (!isset($_SESSION['user'])) {
				?>
					<?php
					require 'login_signup.php';
					?>
				<?php } ?>
        </div>
      </div>
    </header>

	<div class="row clearfix" style="margin-top:40px;">
		<div class="col-md-12 col-xs-12 column">
			<ul class="nav nav-pills navbar-static-top">

				<li>
					<a href="index.php">Home</a>
				</li>
				
				
				<?php
if (isset( $_SESSION['user'])) {
				?>
				<li>
					<?php
					require 'view/submit_ad.php';
					?>
				</li>
				<?php } ?>
				
								
				<li class="pull-right"> . </li>


				
 <li class="pull-right"> . </li>

				<li class="pull-right">
					<form method="get" action="products.php">
						<input name="srch" type="text" class="form-control" placeholder="Search for...">
						<input type="submit" style="display: none;" name="search" />
					</form>

				</li>
				
			</ul>
		</div>
	</div>
