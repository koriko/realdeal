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

if (isset($_GET['e']))
	$editpage=true;
else
	$editpage=false;
if (isset($_GET['p']))
	$previewmode=true;
else
	$previewmode=false;

if ($_COOKIE['vndlevel'] == "10")
     $sqlstring = "select mapspage from config where userid=".$_COOKIE['vndusernmbr'];
else
     $sqlstring = "select mapspage,userid from config where mainsitename='".$pathname."/'";
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$row = mysql_fetch_array($temprs);
if ($row['mapspage']=='Hide') {
     header( 'Location: index.php' ) ;
}
if ($_COOKIE['vndlevel'] == "10")
     $sqlstring = 'SELECT userpageinfo.*,users.directory from userpageinfo,users where users.id=userpageinfo.userid and userpageinfo.userid='.$_COOKIE['vndusernmbr'].' and pagename="'.basename($_SERVER['PHP_SELF']).'"';
else
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid from userpageinfo,users where directory="'.$dirname.'" and users.id=userpageinfo.userid and pagename="'.basename($_SERVER['PHP_SELF']).'"';
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$row = mysql_fetch_array($temprs);
$keywords = $row['keywords'];
$description = $row['description'];
$sitedirectory = $row['directory'];
$sitetitle = $row['sitetitle'];
$theme = $row['theme'];
$sqlstring = "select streetaddress,city,provincestate,country from userprofile,users where users.id=userprofile.useridnmbr and users.directory='".$row['directory']."'";
$maprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$maprow = mysql_fetch_array($maprs);
$address = $maprow['streetaddress'].", ".$maprow['city'].", ".$maprow['country'];
?>
<!DOCTYPE html> 
<html> 
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $sitetitle?></title>
<meta name="keywords" content="<?php echo $keywords?>" />
<meta name="description" content="<?php echo $description?>" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
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
	top:3px;
	height:400px;
	width:600px;
	margin-left:auto;
	margin-right:auto;
}
#mapcontainer {
	position:relative;
	top:10px;
	width:750px;
	height:406px;
	border:3px solid #000000;
	left:120px;
     z-index:0;
}
#message {
     position:relative;
	top:0px;
     left:0px;
     width:100%;
     text-align:center;
     float:center;
}
</style> 
</head> 
<body onload="initialize()"> 
<div id="wrapper">
<br /><br />
<div id="headerinfo">
    <form name="headerinfoform" id="headerinfoform">
    <p style="display:none">Site Name: <span id="sitename" name="sitename" style="font-weight:bold;font-size:12px;"></span>
    </p>
<?php
if ($_COOKIE['vndlevel'] == "10") {
?>
    <p>Theme <select class="swfselect" id="themes" name="themes">
		<option value="0">Select Theme</option>
		<option value="grayblack.css">Gray and Black</option>
		<option value="redyellow.css">Red and Yellow</option>
		<option value="bluewhite.css">Blue and White</option>
		<option value="oranges.css">Oranges</option>
	</select>
	</p>
	<p>Keywords 6 maximum
		<textarea class="mceNoEditor" name="keywords" class="swftextarea" id="keywords" onfocus="fieldFocus('keywords','Keywords')" onblur="fieldBlur('keywords','Keywords')" cols="20" rows="3" /></textarea>
	</p>
	<p>Site Title
		<textarea class="mceNoEditor" name="sitetitle" class="swftextarea" id="sitetitle" onfocus="fieldFocus('sitetitle','Site Title')" onblur="fieldBlur('sitetitle','Site Title')" cols="20" rows="2" /></textarea>
	</p>
	<p>Site Description
		<textarea class="mceNoEditor" name="description" class="swftextarea" id="description" onfocus="fieldFocus('description','Description')" onblur="fieldBlur('description','Description')" cols="20" rows="3" /></textarea>
	</p>
	<div style="position:relative;top:0px">
		<span class="savemodediv" id="savesiteheader" onmouseover="omo(this)" onmouseout="omot(this)" onclick=updateUserpageinfo('<?php echo $sitedirectory?>/map.php')></span>
	</div>
	</form>
<?php
}
?>
</div>
<div style="clear: both;height:8px;"></div>
<div id="page">
	<div id="content">
               <div id="logo">
				<h1><span style="font-family:Impact;font-size:36px;"><?php echo str_replace("-"," ",$sitedirectory)?></span>
                    </h1>
               </div><!-- end #logo -->
		<div class="post">
			<div id="menuspacer">
			</div>
			<div class="entry">
                    <div id="menuspacer"></div>
                    <div id="menu" style="z-index:999;">
				<ul>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('index.php')>Home</a><div id="menudivider">|</div></li>
					<?php if ($pagesrow['infopage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('info.php')>Info</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['gallerypage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('gallery.php')>Gallery</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['commentspage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('comments.php')>Comments</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['mapspage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('map.php')>Map</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($pagesrow['contactpage']=='Show') {
					?>
					<li><a href="javascript:void(0)" style="cursor:pointer;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=getPage('contact.php')>Contact</a><div id="menudivider">|</div></li>
					<?php
					}
					if ($_COOKIE['vndlevel'] == "10") {
					?>
					<span id="logoutdiv"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="userLogout();">Logout</a></span>
					<?php
					}
					?>
				</ul>
                    </div>
                    <div style="clear: both;">&nbsp;</div>
                    <div id="message"><?php echo $address?></div>
                    <div id="mapcontainer">
                         <div id="map_canvas"></div> 
                    </div>
                    <div style="clear: both;">&nbsp;</div>
               </div>
		</div>
	</div>
	<!-- end #content -->
	<div style="clear: both;">&nbsp;</div>
     <div id="footer">
          <p>Copyright (c) info goes here. All rights reserved.</p>
     </div>
     <!-- end #footer -->
</div><!-- end #page -->
</div>
<script type="text/javascript">
	var usebackgroundimage = <?php echo $pagesrow['backgroundimage']?>;
	var backgroundcolor = '<?php echo $pagesrow['backgroundcolor']?>';
	if (usebackgroundimage!=1) {
		$('body').css({background:'none'});
		$('body').css("background",'#'+backgroundcolor);
	}
	var savesitename = '<?php echo $sitedirectory?>';
	var savesiteimage = '../../images/save_gray2.png';
	var savebckgndbtnimage = '../../images/save_gray2.png';
	var savesitemenu = '../../images/save_gray2.png';
	var savesitemenuinfo = 'Show';
<?php
	if ($editpage && $previewmode) {
	?>
		$(window).load(function() {
			//hideProfile('profile');
			editoractive = true;
			previewmode = true;
		});  
	<?php
	}
	else {
		if ($editpage) {
	?>
			$(window).load(function(){
				//openProfile('profile');
				editoractive = true;
				previewmode = false;
			});  
	<?php
		}
	}
?>
</script>
</body>
</html>
