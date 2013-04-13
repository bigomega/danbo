<?php
  session_start();

  if (isset($_SESSION['logged'])) {
    

  } else {
    header('location: ./login.php');
    exit();
  }
?>
<link rel="shortcut icon" type="image/png" href="./favicon.png">
<title>Danbo - Your Profile</title>
<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
}
span{
	font-size: 20px;
}
img.profile_image{
	width: 80px;
}
.span8.offset2{
  padding-left: 20px;
  padding-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
}
h3{
  border-bottom: 1px solid #ccc;
}
.uname{
  text-transform: capitalize;
  font-size: 40px;
  font-weight:400;
}
.btn-danger{
  margin-right: 10px;
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="./index.php">Danbo</a>
    <ul class="nav">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random Set</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="./about.php">About</a></li>
      <li class="active"><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span8 offset2">
			<h3>
        Profile 
        <small> 
          <a href="javascript:void(0)" id="edit">
            edit image
          </a>
        </small>
        <div class="pull-right">
          <button class="btn btn-danger" onclick="window.location='./oauth/logout.php';">Logout</button>
        </div>
      </h3>
			<div class="row-fluid">
				<div class="span12">
					<img src="<?php echo $_SESSION["uimage"]; ?>" class="profile_image">
          <span class="uname"><?php echo $_SESSION["user"]; ?></span>
          <br><br>
          <div class="buttonDiv hide">
            <select class="span2" name="src">
              <option>Facebook</option>
              <option>Twitter</option>
              <option selected="selected">Default</option>
            </select> image
          </div>
          <br>
          <input type="text" value="" style="display:none" name="url">
					<button class="btn btn-primary hide save">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $("#edit").click(function(){
    $(".buttonDiv").removeClass('hide');
    $("button").removeClass('hide');
  });
  $("select").change(function(){
    str = $('option:selected').html();
    if(str!="Default"){
      $("input[name=url]").css('display','block');
    } else {
      $("input[name=url]").css('display','none');
    }
  });
  $(".save").click(function(){
    window.location = "./oauth/edit.php?type="+$('option:selected').html()+"&id="+$("input[name=url]").val();
  });
</script>