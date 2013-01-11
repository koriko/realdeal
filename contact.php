<?php
require_once("../include/dbinfo.php");
require_once("../include/functions.php");

$dirname = strrchr(dirname($_SERVER["SCRIPT_NAME"]),'/');
$path = pathinfo($_SERVER["SCRIPT_NAME"]);
$pathname = $path[dirname];
$dirname = substr($dirname,1,strlen($dirname));
if ($_COOKIE['vndlevel'] == "10")
	$sqlstring = "select * from config where userid=".$_COOKIE['vndusernmbr'];
else
	$sqlstring = "select * from config where mainsitename like '%".$pathname."/'";
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$pagesrow = mysql_fetch_array($temprs);
//if (isset($_GET['e']))
//	$editpage=true;
//else
$editpage=false;
if (isset($_GET['p']))
	$previewmode=false;
else
	$previewmode=false;

if ($_COOKIE['vndlevel'] == "10") {
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid,datetime registrationdate from userpageinfo,users where users.id=userpageinfo.userid and userpageinfo.userid='.$_COOKIE['vndusernmbr'].' and pagename="'.basename($_SERVER['PHP_SELF']).'"';
	$filedir = strrchr(dirname($_SERVER["SCRIPT_NAME"]),'/');
	$filedir = substr($filedir,1,strlen($filedir)-1);
}
else {
	$dirname = strrchr(dirname($_SERVER["SCRIPT_NAME"]),'/');
	$dirname = substr($dirname,1,strlen($dirname));
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid from userpageinfo,users where directory="'.$dirname.'" and users.id=userpageinfo.userid and pagename="'.basename($_SERVER['PHP_SELF']).'"';
}
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$row = mysql_fetch_array($temprs);
$keywords = $row['keywords'];
$description = $row['description'];
$sitedirectory = $row['directory'];
$sitetitle = $row['sitetitle'];
$background = $row['theme'];
$theme = $row['theme'];
$tuserid = $row['tid'];
$regdate = $row['registrationdate'];
$sqlstring = "select imagename from userpageimages where userid=".$tuserid." and userpagename='index.php'";
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$imgrow = mysql_fetch_array($temprs);
$mainimage = $imgrow['imagename'];
if ($mainimage=="")
	$mainimage = 'nu.png';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("../include/dbinfo.php");

$dirname = strrchr(dirname($_SERVER["SCRIPT_NAME"]),'/');
$path = pathinfo($_SERVER["SCRIPT_NAME"]);
$pathname = $path[dirname];
$dirname = substr($dirname,1,strlen($dirname));
if ($_COOKIE['vndlevel'] == "10")
	$sqlstring = "select * from config where userid=".$_COOKIE['vndusernmbr'];
else
	$sqlstring = "select * from config where mainsitename like '%".$pathname."/'";
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$pagesrow = mysql_fetch_array($temprs);
$backgroundimage = $pagesrow['backgroundimage'];
$backgroundcolor = $pagesrow['backgroundcolor'];

//if (isset($_GET['e']))
//	$editpage=true;
//else
$editpage=false;
if (isset($_GET['p']))
	$previewmode=false;
else
	$previewmode=false;

if ($_COOKIE['vndlevel'] == "10") {
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid from userpageinfo,users where users.id=userpageinfo.userid and userpageinfo.userid='.$_COOKIE['vndusernmbr'];
}
else {
	$dirname = strrchr(dirname($_SERVER["SCRIPT_NAME"]),'/');
	$dirname = substr($dirname,1,strlen($dirname));
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid from userpageinfo,users where directory="'.$dirname.'" and users.id=userpageinfo.userid';
}
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$row = mysql_fetch_array($temprs);
$keywords = $row['keywords'];
$description = $row['description'];
$sitedirectory = $row['directory'];
$sitedirectory = str_ireplace("-"," ",$sitedirectory);
$sitetitle = $row['sitetitle'];
$background = $row['theme'];
$theme = $row['theme'];
$tuserid = $row['tid'];
$sqlstring = "select userprofile.*,email from userprofile,users where users.id=userprofile.useridnmbr and useridnmbr=".$tuserid;
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$userrow = mysql_fetch_array($temprs);
$id = $userrow['useridnmbr'];
$company = $userrow['company'];
$country = $userrow['country'];
$provincestate = $userrow['provincestate'];
$city = $userrow['city'];
$streetaddress = $userrow['streetaddress'];
$postalcode = $userrow['postalcode'];
$phone = $userrow['phone'];
$fax = $userrow['fax'];
$website = $userrow['website'];
$email = $userrow['email'];
$maprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$maprow = mysql_fetch_array($maprs);
$address = $maprow['streetaddress'].", ".$maprow['city'].", ".$maprow['country'];
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $sitetitle?></title>
<meta name="keywords" content="<?php echo $keywords?>" />
<meta name="description" content="<?php echo $description?>" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/curvedcorners.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="../js/cookies.js"></script>
<?php
if ($_COOKIE['vndlevel'] == "10") {
?>
<script type="text/javascript" src="../js/vind.js"></script>
<?php
}
else {
?>
<script type="text/javascript" src="../js/vindjs.js"></script>
<?php
}
?>
<style type="text/css" media="all">
/* <![CDATA[ */
div.inner { margin: 0; background: #fff; padding-left: 0px;padding-top:0px;padding-bottom:0px; border:0; zoom:1;}
div.outer { float: left; margin: 5px; background: #ccc; padding: 0px; }

#dispcontactinfo {
	position:relative;
	padding-top:10px;
	 box-shadow: 0 1px 1px white inset;
	float:right;
	margin-top:20px;
	margin-right:30px;
	font-size:14px;
	font-weight:bold;
	        width:248px;
	
border:1px solid #cccccc;
padding-left:35px;
}
#contactdiv {
	margin-right:60px;
	position:relative;
	
padding-right:0px;
	float:right;
	margin-top:20px;
	
	font-size:14px;
	font-weight:bold;
	        width:255px;
	border-left:1px solid #cccccc;
border-bottom:1px solid #cccccc;

}
#contactdiv p {
	position:relative;
	margin-right:5px;
	left:0px;float:right;
	border-bottom:0px solid #000000;
}
#profile {
	position:relative;
	
	display:none;
	margin-left:0px;
	width:250px;
	height:410px;
	margin-top:5px;
	padding-top:5px;
	background-color:transparent;
float:right;margin-right:45px;
}


.entryright {	
	float:right;
	margin-right:5px;
	width:auto;
	height:410px;
	margin-top:5px;
	padding-top:5px;
	background-color:transparent;
	
padding-left:0px;
}
#leftframe {
	float:left;
}
#rightcontent{
position:relative;
	height:500px;
	width:1055px;
	margin-top:10px;
margin-right:0px;
margin-bottom:5px;
overflow:hidden;
	padding-top:35px;
padding-left:15px;

	
	float:right;
	
box-shadow: 0 1px 1px white inset;

border-right:1px solid #cccccc;
border-top:1px solid #cccccc;
	

background:transparent;

}
.sendbtn {
	font-size:12px;
	display:inline;
float:left;
}
/* ]]> */
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;
  var map;
  var query = "<?php echo $address?>";
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var myOptions = {
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    codeAddress();
  }
 
  function codeAddress() {
    var address = query;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
</script> 
<style type="text/css"> 
#map_canvas {
	position:relative;
	top:0px;
	width:700px;
	height:500px;
	float:left;
}

#message {
     position:relative;
	top:0px;
     left:0px;
     width:100%;
     text-align:left;
     float:center;
}
</style> 
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "113ae654-c236-4992-9801-43f7a1a952f3"}); </script>
</head>
<body onload="initialize()">
<div id="wrapper">

<span id="theme" style="display:none;"><?php echo $theme?></span>
<div style="clear: both;height:0px;">&nbsp;</div>
<div id="headerinfo" style="display:none">
</div>
<div id="page">
	<div id="content">
			<div id="logo">
			<div id="menuspacy" style="width:1124px;margin: 0 auto;"><div class="sitenamecontainer">	
<h1><span style="margin-top:10px;float:left;font-family:Impact; 
    text-shadow: 0 2px 2px #F5F5F5;color:#696969;
	
	font-size:58px;
	
	
	text-decoration:none;"><?php echo str_replace("-"," ",$sitedirectory)?></span>
			
</div>



</div></div>










				</h1>
			</div></div>


		<div class="post">
			
			<div class="entry">


<div class="entryleft" id="leftframe" style="height:auto;margin-bottom:50px;">

					<div class="searchfield"style=" margin: 0 auto;text-align: center;

  

"><div id="homeimage">
						<div class="inner" id="dynamicimg2">
							<div style="text-align: center;"><img class="dynamicimg2" id="dynamicimg2" src="images/<?php echo $mainimage?>" border="0" />	<!-- width="390"-->
						</div></div>
					</div>
				</div></div>
				
<div class="searchfield" style="float:right;margin-top:0px;margin-bottom:20px;padding:15px;">


<div id="rightcontent"style="margin-top:0px;float:left;height:auto;width: 338px;padding-left:30px;padding-right:20px;padding-top:25px;box-shadow: 0 2px 5px white inset;border:1px solid #ccc;background: transparent;">
<div id="menuspacer"></div>
			<div id="menu"><div id="menuspacy" style="width:auto;margin: 0 auto;">
				<ul>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('index.php')>Home</a><div id="menudivider">|</div></li>
					<?php if ($pagesrow['infopage']=='Show') {
					?>
				
					<?php
					}
					if ($pagesrow['gallerypage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('gallery.php')>Gallery</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['commentspage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('comments.php')>Social</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['contactpage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('contact.php')>Contact</a><div id="menudivider">|</div></li>
					<li><span id="usermsg" style="padding-left:50px;display:none;color:#0000ff;font-size:14px;font-weight:bold;"></span>
						<span id="updatemsg" style="padding-left:50px;display:none;color:#0000ff;font-size:14px;font-weight:bold;"></span>
						<img src='../images/ajax-loader.gif' id='ajaximg' style='display:none' />
						<img src='../images/ajax-loader.gif' id='ajaximg2' style='display:none' />
					</li><?php
if ($_COOKIE['vndlevel'] == "10") {
?>
					


<?php
}
?>
					<?php
					}
					if ($_COOKIE['vndlevel'] == "10") {
					?>
					
					<?php
					}
					?>
				</ul>
			</div>
			<!--<div id="confirmarea">Are you sure you want to leave this page?</div>-->
			<?php
			$sqlstring = "select * from userpageimages,users where users.directory='".$sitedirectory."' and userpageimages.userid=users.id and userpagename='gallery.php' and albumnmbr=1 order by imageposition";
			$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
			$imgrow = mysql_fetch_array($temprs);
			$mainimage = $imgrow['imagename'];
			$imagealbum = $imgrow['imagealbum'];
			
			$nmbrfotos = 57;
			?>
			<!--<div id="editoptions" style="clear: both;text-align:center;visibility:hidden">spacer</div>
			 end #menu --></div></div></div>


			<div class="searchfield"style="float:right;margin-top:-2px;margin-bottom:20px;padding:15px;">


<div id="rightcontent"style="float:left;height:40px;width: 338px;padding-left:50px;padding-top:25px;box-shadow: 0 2px 5px white inset;border:1px solid #ccc;background: transparent;"><span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_googleplus_large' displayText='Google +1'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>

</div></div>	
<div id="menuspacer"></div>
			<div id="menu"style="border-bottom: 0px solid #C0C0C0;
    border-top: 0px solid #C0C0C0;
    box-shadow: 0 0px 0px white inset;width:auto;">
				<ul>
					
					<?php if ($pagesrow['infopage']=='Show') {
					?>
				
					<?php
					}
					if ($pagesrow['gallerypage']=='Show') {
					?>
					
					<?php
					}
					if ($pagesrow['commentspage']=='Show') {
					?>
					
					<?php
					}
					if ($pagesrow['contactpage']=='Show') {
					?>
					
					
						<span id="updatemsg" style="padding-left:50px;display:none;color:#0000ff;font-size:14px;font-weight:bold;"></span>
						<img src='../images/ajax-loader.gif' id='ajaximg' style='display:none' />
						<img src='../images/ajax-loader.gif' id='ajaximg2' style='display:none' />
					</li><?php
if ($_COOKIE['vndlevel'] == "10") {
?>
					

<div id="editmodediv">
						<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=openProfile('profile','e')>Edit Site</span>
					</div>
<?php
}
?>
					<?php
					}
					if ($_COOKIE['vndlevel'] == "10") {
					?>
					<span id="logoutdiv"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:0px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="userLogout();">Logout</a></span>
					<span id="savediv" style="display:none;"><a href="javascript:void(0)" id="savedivlink" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)">Save</a></span>
					<span id="previewdiv" style="display:none;"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="hideProfile('profile');">Preview</a></span>
					<span id="returntoeditdiv" style="display:none;"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;color:#ff0000;" onclick="openProfile('profile','r');">Return to Edit</a></span>
					<?php
					}
					?>
				</ul>
			</div></div>
			<div id="editoptions" style="clear:both;text-align:center;visibility:hidden"></div>
			<!-- end #menu -->			



	<div class="entryright">
				<div class="searchfield">	<div id="rightcontent">


					
						<div id="map_canvas"></div> 
					

						<div id="dispcontactinfo">
							<p style="line-height:100%;" id="dispcompanycountry"><br /><?php echo $company?></p>
							<p style="line-height:100%" id="dispstreetaddress"><?php echo $streetaddress?>
							<p style="line-height:50%" id="disppostalcode"><?php echo $postalcode?></p>
							<p style="line-height:50%" id="dispcity"><?php echo $city?></p>
							<p style="line-height:50%" id="dispcountry"><?php echo $country?></p>
							<p style="line-height:50%" id="dispprovincestate"><?php echo $provincestate?></p>
							<p style="line-height:50%" id="dispphone"> <?php echo $phone?></p>
							<p style="line-height:50%" id="dispfax"> <?php echo $fax?></p>
							<p style="line-height:100%" id="dispwebsite"> <?php echo $website?></p>
						</div>
						<div id="contactdiv">
							<p><input type="text" name="contactname" id="contactname" size="34" maxlength="40" onfocus="txtFieldfocus('contactname','Name')" onblur="txtFieldblur('contactname','Name')" value="Name" style="border-radius:2px;"/></p>
							<p><input type="text" name="contactemail" id="contactemail" size="34" maxlength="50" onfocus="txtFieldfocus('contactemail','Email')" onblur="txtFieldblur('contactemail','Email')" value="Email" style="border-radius:2px;"/></p>
							<p><textarea name="contactmessage" id="contactmessage" cols="25" rows="4"  onfocus="txtFieldfocus('contactmessage','Message')" onblur="txtFieldblur('contactmessage','Message')"style="border-radius:2px;">Message</textarea></p>
							<p style="text-align:center;">
								<input type="button" name="sendmessage" class="sendbtn" id="sendmessage" onclick="sendMessage();" value="Send Your Message"style="background-color: #6891E7;
    background-image: -moz-linear-gradient(center top , #6891E7 0pt, #304EA6 100%);
    border-color: #304EA6 #304EA6 #000000;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.45) inset;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.45);border-radius: 3px 3px 3px 3px;
    cursor: pointer;
    font-size: 11px;
    font-weight: normal;
    height: 2.95em;
    outline: 0 none;
    padding: 0 0.91em;
    vertical-align: middle;
   color:#fff;
    word-wrap: normal;margin-top:10px;margin-left:10px;" /> 
								



<button style="background-color: #6891E7;
    background-image: -moz-linear-gradient(center top , #6891E7 0pt, #304EA6 100%);
    border-color: #304EA6 #304EA6 #000000;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.45) inset;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.45);border-radius: 3px 3px 3px 3px;
    cursor: pointer;
    font-size: 11px;
    font-weight: normal;
    height: 2.95em;
    outline: 0 none;
    padding: 0 0.91em;
    vertical-align: middle;
   color:#fff;
    word-wrap: normal;margin-top:10px;margin-left:10px;"name="clearform" class="sendbtn" id="clearform">Clear Form</button>
							</p>
						</div>
						<div id="profile">
							<?php
							if ($_COOKIE['vndlevel'] == "10") {
							?>
							<table width="80%" align="left" style="font-size:12px;">
								<tr>
									<td align="right">Business Name:</td><td><input type="text" name="businessname" id="businessname" style="width:80%;" size="35" maxlength="40" onchange="dataChanged()" value="<?php echo $company?>" /></td>
								</tr>
								<tr>
									<td align="right">Street Address:</td><td><input type="text" name="streetaddress" id="streetaddress" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $streetaddress?>" /></td>
								</tr>
								<tr>
									<td align="right">Postal Code:</td><td><input type="text" name="postalcode" id="postalcode" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $postalcode?>" /></td>
								</tr>
								<tr>
									<td align="right">City:</td><td><input type="text" name="city" id="city" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $city?>" /></td>
								</tr>
								<tr>
									<td align="right">Country:</td><td>
									<!--<input type="text" name="country" id="country" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $country?>" />-->
									<select id='country' name='country' onchange="dataChanged()">
										<option value="">Select Country</option>
									<?php
									$sqlstring = "select * from country_list order by country";
									$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
									while ($row = mysql_fetch_array($temprs)) {
										if ($country==$row['countrycode'])
											$selected = 'selected';
										else
											$selected = '';
										echo '<option value="'.$row['countrycode'].'"'.$selected.'>'.$row['country'].'</option>';
									}
									?>
									</select>
									</td>
								</tr>
								<tr>
									<td align="right">Province/State:</td><td><input type="text" name="provincestate" id="provincestate" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $provincestate?>" /></td>
								</tr>
								<tr>
									<td align="right">Phone:</td><td><input type="text" name="phone" id="phone" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $phone?>" /></td>
								</tr>
								<tr>
									<td align="right">Fax:</td><td><input type="text" name="fax" id="fax" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $fax?>" /></td>
								</tr>
								<tr>
									<td align="right">Website:</td><td><input type="text" name="website" id="website" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $website?>" /></td>
								</tr>
								<tr>
									<td align="right">Email:</td><td><input type="text" name="emailadress" id="emailaddress" style="width:80%;" size="35" maxlength="50" onchange="dataChanged()" value="<?php echo $email?>" /></td>
								</tr>
							</table>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
	</div><!-- end #content -->
	<div id="footer">
		<p>Copyright (c) www.bindex.info All rights reserved. <span style="margin-left:30px;">Designed by <a href="http://www.alavida.com" target="_blank" style="text-decoration:none;"><span style="color:#000000;">Alavida.com</span></a></span></p>
	</div><!-- end #footer -->
	</div><!-- end #page -->
</div><!-- end #wrapper -->
</body>

<script type="text/javascript" src="../js/jquery.corner.js"></script>
<script type="text/javascript"> 
	var usebackgroundimage = <?php echo $backgroundimage?>;
	var backgroundcolor = '<?php echo $backgroundcolor?>';
	if (usebackgroundimage!=1) {
		$('body').css({background:'none'});
		$('body').css("background",'#'+backgroundcolor);
	}
	<?php
	if ($_COOKIE['vndlevel'] == "10") {
	?>
	var savesitename = '<?php echo $sitedirectory?>';
	var savesiteimage = '../../images/save_gray2.png';
	var savebckgndbtnimage = $('#savesiteheader').css("background-image");
	var savesitemenu = '../../images/save_gray2.png';
	var savesitemenuinfo = 'Show';
	var tsavedispcompanycountry = $('#dispcompanycountry').html();
	var tsavedispstreetaddress = $('#dispstreetaddress').html();
	var tsavedispphone = $('#dispphone').html();
	var tsavedispfax = $('#dispfax').html();
	var tsavedispwebsite = $('#dispwebsite').html();
	var tsavecompany = "<?php echo $company?>";
	var tsavecountry = "<?php echo $country?>";
	var tsaveprovincestate = "<?php echo $provincestate?>";
	var tsavecity = "<?php echo $city?>";
	var tsavestreetaddress = "<?php echo $streetaddress?>";
	var tsavepostalcode = "<?php echo $postalcode?>";
	var tsavephone = "<?php echo $phone?>";
	var tsavefax = "<?php echo $fax?>";
	var tsavewebsite = "<?php echo $website?>";
	var tsaveemail = "<?php echo $email?>";
	<?php
	}
	?>
	
	$('#clearform').click(function() {
		$('#contactname').val('Name');
		$('#contactemail').val('Email');
		$('#contactmessage').val('Message');
	});
	<?php
	if ($_COOKIE['vndlevel'] == "10") {
	?>
	$('#savediv').click(function() {
		$('#ajaximg2').css({display:"inline"});
		tpgm = "../saveprofile.php";
		$.ajax({
			type: "POST",
			url: tpgm,
			cache: false,
			data:"businessname="+$('#businessname').val()+
			"&country="+$('#country').val()+
			"&provincestate="+$('#provincestate').val()+
			"&city="+$('#city').val()+
			"&postalcode="+$('#postalcode').val()+
			"&streetaddress="+$('#streetaddress').val()+
			"&phone="+$('#phone').val()+
			"&fax="+$('#fax').val()+
			"&website="+$('#website').val()+
			"&emailadress="+$('#emailadress').val(),
			success: function(html){
				if (html.substr(0,7) == 'Invalid') {
					$("#updatemsg").html('Error Saving Your Contact Information');
					$('#ajaximg2').css({display:"none"});
					return;
				}
				$('#updatemsg').html(html);
				$('#updatemsg').css({display:"inline"});
				setTimeout("$('#updatemsg').fadeOut()", 5000);
				tsavedispcompanycountry = $('#dispcompanycountry').html();
				tsavedispstreetaddress = $('#dispstreetaddress').html();
				tsavedispphone = $('#dispphone').html();
				tsavedispfax = $('#dispfax').html();
				tsavedispwebsite = $('#dispwebsite').html();
				tsavecompany = $('#businessname').val();
				tsavecountry = $('#country').val();
				tsaveprovincestate = $('#provincestate').val();
				tsavecity = $('#city').val();
				tsavestreetaddress = $('#streetaddress').val();
				tsavepostalcode = $('#postalcode').val();
				tsavephone = $('#phone').val();
				tsavefax = $('#fax').val();
				tsavewebsite = $('#website').val();
				tsaveemail = $('#emailadress').val();

				$('#dispcompanycountry').html('<br />'+$('#businessname').val());
				$('#dispstreetaddress').html($('#streetaddress').val());
				$('#dispphone').html($('#phone').val());
				$('#dispfax').html($('#fax').val());
				$('#dispwebsite').html($('#website').val());
				$('#dispcompany').html($('#businessname').val());
				$('#dispcountry').html($('#country').val());
				$('#dispprovincestate').html($('#provincestate').val());
				$('#dispcity').html($('#city').val());
				$('#disppostalcode').html($('#postalcode').val());
				$('#dispemail').html($('#emailadress').val());
				savecolor = '';
				$('#savedivlink').css("color","#727272");
				$('#savedivlink').html('Save');
				changessaved = 99;
				$('#ajaximg2').css({display:"none"});
				location.href = "contact.php";
			}
		});
	});
	<?php
	}
	?>
	function txtFieldfocus(tname,tvalue) {
		if ($('#'+tname).val()==tvalue) {
			$('#'+tname).val('');
		}
	}
	function txtFieldblur(tname,tvalue) {
		if ($('#'+tname).val()=='') {
			$('#'+tname).val(tvalue);
		}
	}
	function dataChanged() {
		$('#savedivlink').css({color:"#ff0000"});
		$('#savedivlink').html('Save');
	}
	function sendMessage() {
		$('#ajaximg').css({display:"inline"});
		tpgm = "../sendmessage.php";
		$.ajax({
			type: "POST",
			url: tpgm,
			cache: false,
			data:"contactname="+$('#contactname').val()+
			"&contactemail="+$('#contactemail').val()+
			"&contactemessage="+$('#contactmessage').val(),
			success: function(html){
				if (html.substr(0,7) == 'Invalid') {
					$("#usermsg").html('<span style="cursor:pointer;"><font style="color:red;font-weight:bold;">Forgot Password?</font></span>');
					$("#usermsg").html('Invalid User ID, '+$(".usermsg").html());
					$('#ajaximg').css({display:"none"});
					return;
				}
				$('#usermsg').html(html);
				$('#usermsg').css({display:"inline"});
				setTimeout("$('#usermsg').fadeOut()", 5000);
				$('#ajaximg').css({display:"none"});
			}
		});
	};
	<?php
	if ($_COOKIE['vndlevel'] == "10") {
	?>
	function openProfile(tname,ttype) {
		$('#'+tname).css({display:"block"});
		$('#contactdiv').css({display:"none"});
		$('#savediv').css({display:"inline"});
		$('#headerinfo').css({display:'none'});
		$('#dispcontactinfo').css({display:'none'});
		$('#logoutdiv').css({display:"none"});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=closeProfile("profile")>Exit Edit</span>';
		$('#editmodediv').html(tlink);
		$('#returntoeditdiv').css({display:"none"});
		$('#previewdiv').css({display:"inline"});
		if (ttype=='e') {
			tsavedispcompanycountry = $('#dispcompanycountry').html();
			tsavedispstreetaddress = $('#dispstreetaddress').html();
			tsavedispphone = $('#dispphone').html();
			tsavedispfax = $('#dispfax').html();
			tsavedispwebsite = $('#dispwebsite').html();
			$('#businessname').val(tsavecompany);
			$('#country').val(tsavecountry);
			$('#provincestate').val(tsaveprovincestate);
			$('#city').val(tsavecity);
			$('#streetaddress').val(tsavestreetaddress);
			$('#postalcode').val(tsavepostalcode);
			$('#phone').val(tsavephone);
			$('#fax').val(tsavefax);
			$('#website').val(tsavewebsite);
			$('#emailadress').val(tsaveemail);
		}
		previewmode = false;
		editoractive = true;
	}
	function hideProfile(tname) {
		$('#'+tname).css({display:"none"});
		$('#contactdiv').css({display:"block"});
		$('#savediv').css({display:"inline"});
		$('#headerinfo').css({display:'none'});
		$('#logoutdiv').css({display:"none"});
		$('#dispcontactinfo').css({display:'block'});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=closeProfile("profile")>Exit Edit</span>';
		$('#editmodediv').html(tlink);
		$('#returntoeditdiv').css({display:"inline"});
		$('#previewdiv').css({display:"none"});
		$('#savediv').css({display:"none"});
		$('#dispcompanycountry').html($('#businessname').val());
		$('#dispcountry').html($('#country').val());
		$('#dispstreetaddress').html($('#streetaddress').val());
		$('#dispcity').html($('#city').val());
		$('#dispprovincestate').html($('#provincestate').val());
		$('#disppostalcode').html($('#postalcode').val());
		$('#dispphone').html($('#phone').val());
		$('#dispfax').html($('#fax').val());
		$('#dispwebsite').html($('#website').val());
		previewmode = true;
		editoractive = true;
	}
	function closeProfile(tname) {
		$('#'+tname).css({display:"none"});
		$('#contactdiv').css({display:"block"});
		$('#savediv').css({display:"none"});
		$('#headerinfo').css({display:'none'});
		$('#dispcontactinfo').css({display:'block'});
		$('#logoutdiv').css({display:"none"});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=openProfile("profile","e")>Edit Site</span>';
		$('#editmodediv').html(tlink);
		$('#returntoeditdiv').css({display:"none"});
		$('#previewdiv').css({display:"none"});
		$('#logoutdiv').css({display:"inline"});
		previewmode = false;
		editoractive = false;
	}
	<?php
	}
	?>
</script>
<script language="JavaScript">
	 <?php
	 if ($_COOKIE['vndfullname'] != "") {
	 ?>
	$('#loginSystem').css({display:"none"});
	$('#loginmenu').css({display:"none"});
	$('#loginMsg').css({display:"inline"});
	$('#sitename').html('<?php echo $sitedirectory?>');
	$('#keywords').val('<?php echo $keywords?>');
	$('#sitetitle').val('<?php echo $sitetitle?>');
	$('#description').val('<?php echo $description?>');

	 <?php
	 }
	 else {
	 ?>
	$('#ulmenu').css({display:"none"});
	$('#loginMsg').css({display:"none"});
	$('#loginSystem').css({display:"none"});
	<?php
	}
	if ($editpage && $previewmode) {
	?>
		$(window).load(function() {
			hideProfile('profile');
			editoractive = true;
			previewmode = false;
		});  
	<?php
	}
	else {
		if ($editpage) {
	?>
			$(window).load(function(){
				openProfile('profile');
				editoractive = true;
				previewmode = false;
			});  
	<?php
		}
	}
	$tdirectory = str_ireplace(" ","-",$sitedirectory);
	?>
	createCookie('vndsite', "<?php echo $tdirectory ?>", 1)

</script> 
</html>