<?php
  if (isset($_GET['logged'])) {
    header('location: ./profile.php');
    exit();
  }
?>
<link rel="shortcut icon" type="image/png" href="./favicon.png">
<title>Danbo - the ultra Knowledge tester</title>
<link href='bootstrap.css' rel='stylesheet'>
<script src='jquery.js'></script>
<script src='jquery-ui.js'></script>
<script src='bootstrap.js'></script>
<style type="text/css">
.navbar-inner{
	border-radius: 0px;
}
.row-fluid{
	margin-bottom: 20px;
}
.brand img{
	width: 30px;
	position: relative;
	top: -2px;
	margin-right: 5px;
}
.brand:hover{
	text-shadow: 0px 0px 5px;
}
form{
	border: 1px solid #ccc;
	padding-left: 20px;
	padding-top: 20px;
	border-radius: 10px;
}
h4{
	border-bottom: 1px solid #ccc;
	padding-bottom: 5px;
}
#strength{
	background-color: #fff;
	border-radius: 15px;
	padding-top: 6px;
	padding-left: 10px;
	margin-right: 10px;
}
</style>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="./index.php">
    	<img src="./danbo.png">
    	Danbo
    </a>
    <ul class="nav">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./score.php">Scores</a></li>
      <li><a href="./random.php">Random</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="./about.php">About</a></li>
      <li><a href="./profile.php">Profile</a></li>
    </ul>
  </div>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6 offset3">
			<h3>Please login/register to continue</h3>
			<form action="./oauth/" method="POST" id="form1">
				<div class="row-fluid">
					<div class="span2 offset1">
						User Name:
					</div>
					<input type="text" class="input span6" name="user" />
				</div>
				<div class="row-fluid">
					<div class="span2 offset1">
						Password: 
					</div>
					<input type="password" class="input span6" name="pass" />
					<div class="span3 pull-right">
						<a href="javascript:alert('sorry!!!\nno can do babydoll')">forgot password?</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span2 offset4">
						<input type="submit" name="login" value="Login" class="btn btn-inverse">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10 offset2">
						or <a href="javascript:void(0);" class="registerLogin">Register here</a> if you are new
					</div>
				</div>
			</form>
			<form action="./oauth/create.php" method="POST" class="hide" id="form2">
				<div class="row-fluid">
					<div class="span2 offset1">
						User Name:
					</div>
					<input type="text" class="input span6" name="user" id="user2"/>
					<div class="span3 pull-right" id="userPresent">
						...
					</div>
				</div>
				<div class="row-fluid">
					<div class="span2 offset1">
						Password: 
					</div>
					<input type="password" class="input span6" name="pass" id="pass2"/>
					<div class="span3 pull-right" id="strength">
						...
					</div>
				</div>
				<div class="row-fluid">
					<div class="span2 offset1">
						Confirm Password: 
					</div>
					<input type="password" class="input span6" name="pass-confirm" id="cpass2"/>
					<div class="span3 pull-right" id="match">
						...
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4 offset4">
						<input type="submit" name="login" value="Register" class="btn btn-inverse">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10 offset2">
						or <a href="javascript:void(0);" class="registerLogin">Login here</a> if you are already a member
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.brand').mouseover(function(){
	$('.brand img').attr('src','./danbo_flash.png');
});
$('.brand').mouseout(function(){
	$('.brand img').attr('src','./danbo.png');
});

$(".registerLogin").click(function(){
	$("#form1").slideToggle(500);
	$("#form2").slideToggle(500);
});

$("#pass2,#cpass2").keyup(function(){
	var a = $("#pass2").val();
	var b = $("#cpass2").val();
	if(a=="" || a!=b){$("#match").html('<span style="color:red">passwords dont match</span>')}
	else{$("#match").html('<span style="color:green">passwords match</span>')}
});

$("#pass2").keyup(function(){
	var val = $("#pass2").val();
	var str = 0;
	if(/^[a-zA-Z0-9- ]*$/.test(val) == false)
		str += 1; //special char
	if(val.match(/\d+/g) != null)
		str += 1; //number
	if(val.match(/[A-Z]/) != null)
		str +=1; //capitals
	if(val.length < 5)
		str = 0;
	if(val.length > 15)
		str = 2
	if(val.length > 20)
		str = 3

	if(str == 0)
		$("#strength").html("Weak").animate({backgroundColor: "rgba(255,0,0,0.5)"},500);
	else if(str == 1)
		$("#strength").html("Medium").animate({backgroundColor: "rgba(255,150,0,0.5)"},500);
	else if(str == 2)
		$("#strength").html("Medium").animate({backgroundColor: "rgba(255,255,0,0.5)"},500);
	else if(str == 3)
		$("#strength").html("Strong").animate({backgroundColor: "rgba(0,255,0,0.5)"},500);
});

$("#user2").keyup(function(){
	$.ajax({
		url: "./oauth/user.php",
		type: "GET",
		data: {name: $(this).val()},
		dataType: "json",
		success: function(response){
			if(response.avail)
				$("#userPresent").html("<span style='color:green'>Username Available</span>");
			else
				$("#userPresent").html("<span style='color:red'>Username Taken</span>");
		},
		error: function(response){
			$("#userPresent").html("<span style='color:rgb(0, 194, 243)'>network error</span>");
		}
	});
});
</script>