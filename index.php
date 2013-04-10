<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="#">Danbo</a>
    <ul class="nav">
      <li class="active"><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random Set</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span8 offset2">
			<h1>Start Here</h1>
			<hr>
			<div class="row-fluid">
				<div class="span12">
					<form class="form-search">
						<div class="input-append span12">
							<input type="text" class="span6 offset2 search-query" placeholder="Java, Mango, etc...">
							<button type="submit" class="btn">Search</button>
						</div>
					</form>
				</div>
			</div>
			<hr>
		</div>
	</div>
</div>