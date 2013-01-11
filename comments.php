<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once("../include/dbinfo.php");
require_once("../include/functions.php");

$fullpath = $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
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
	$sqlstring = 'SELECT userpageinfo.*,users.directory,users.id tid from userpageinfo,users where users.id=userpageinfo.userid and userpageinfo.userid='.$_COOKIE['vndusernmbr'].' and pagename="'.basename($_SERVER['PHP_SELF']).'"';
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
$pageheading = $row['pageheading'];
$sqlstring = "select imagename from userpageimages where userid=".$tuserid." and userpagename='index.php'";
$temprs = mysql_query($sqlstring) or die('Invalid query: '.$sqlstring);
$imgrow = mysql_fetch_array($temprs);
$mainimage = $imgrow['imagename']
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $sitetitle?></title>
<meta name="keywords" content="<?php echo $keywords?>" />
<meta name="description" content="<?php echo $description?>" />
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
div.inner { margin: 0; background: transparent; padding-left: 0px;padding-top:0px;padding-bottom:0px; border:0; zoom:1;}
div.outer { float: left; margin: 5px; background: #ccc; padding: 0px; }


.entryright{




position:relative;
	height:auto;
	width:400px;
	margin-top:0px;
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












	

;
}

.entry {
	height:100%;
	border:0px solid #ff0000;
width:100%;padding:0px;
}
#cmntimg {
	float:left;
	margin:2px;
	display:inline;
}
#leftcontent p {
	font-size:1em;
	position:relative;
	width:100%;
	height:60px;
	overflow:hidden;
}
#rightcontent p {
	font-size:1em;
	position:relative;
	width:98%;
	height:60px;
	overflow:hidden;
}
.dispname {
	font-size:1.25em;
	font-weight:bold;
}
.post {
	margin-bottom:0px;

}
/* ]]> */
</style><script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "113ae654-c236-4992-9801-43f7a1a952f3"}); </script>
</head>
<body style="">



<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_BE/all.js#xfbml=1&appId=237530569661452";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">

<span id="theme" style="display:none;"><?php echo $theme?></span>
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
	<!-- end #logo -->
			

<div class="entryleft" id="leftframe" style="margin-left:0px;margin-top:0px;margin-bottom:50px;">


<div class="searchfield"style=" margin: 0 auto;text-align: center;

  

"><div id="homeimage">
						<div class="inner" id="dynamicimg2">
							<div style="text-align: center;"><img class="dynamicimg2" id="dynamicimg2" src="images/<?php echo $mainimage?>" border="0" />	<!-- width="390"-->
						</div></div>
					</div>
				</div></div>


<div class="searchfield" style="float:right;margin-top:0px;margin-bottom:20px;padding:15px;">


<div id="rightcontent"style="float:left;height:auto;width: 338px;padding-left:30px;padding-right:20px;padding-top:25px;box-shadow: 0 2px 5px white inset;border:1px solid #ccc;background: transparent;">


<div id="menuspacer"></div>
			<div id="menu">
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
					
					<?php
					if ($_COOKIE['vndlevel'] == "10") {
					?>
					
					<?php
					}
					?>
				    <?php
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
			</div></div></div>
<div class="searchfield"style="float:right;margin-top:0px;margin-bottom:20px;padding:15px;">


<div id="rightcontent"style="float:left;height:40px;width: 338px;padding-left:50px;padding-top:25px;box-shadow: 0 2px 5px white inset;border:1px solid #ccc;background: transparent;"><span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_googleplus_large' displayText='Google +1'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>

</div></div>



















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
					
					<?php
					}
					if ($_COOKIE['vndlevel'] == "10") {
					?>

<?php
if ($_COOKIE['vndlevel'] == "10") {
?>
					<div id="editmodediv">
						<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="openEdit()">Edit Site</span>
					</div>
<?php
}
?>


					<span id="logoutdiv"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:0px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="userLogout();">Logout</a></span>
					<span id="savediv" style="display:none;"><a href="javascript:void(0)" id="savedivlink" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="updateUserpageinfo('comments.php');tsavedisppagetitle=$('#inputlogo').val();">Save</a></span>
					<span id="previewdiv" style="display:none;"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;" onmouseover="omo(this)" onmouseout="omot(this)" onclick="hideEdit()">Preview</a></span>
					<span id="returntoeditdiv" style="display:none;"><a href="javascript:void(0)" style="cursor:pointer;float:right;padding-top:10px;padding-right:10px;color:#ff0000;" onclick="openEdit();">Return to Edit</a></span>
					<?php
					}
					?>
				</ul>
			</div></div>
			<div style="clear: both;"></div>























<div class="searchfield"style="float:left;margin-top:10px;margin-bottom:20px;padding:15px;">


<div style="
box-shadow: 0 2px 5px white inset;

border:1px solid #ccc;
background: transparent;float:left;min-height:290px;min-height:400px;height:auto;width: 1017px;padding-left:50px;padding-top:25px;">



				<div id="disppagetitle" style="position:relative;width:250px;top:0px;display:inline;left:0px;font-weight:bold;font-size:14px;">
					<?php echo $pageheading?>
				</div>






				<?php
				if ($_COOKIE['vndlevel'] == "10") {
				?>
				<div id="editlogo" style="position:relative;width:470px;top:0px;display:none;left:0px;">
					<input type="text" id="inputlogo" name="inputlogo" size="80" row="2" onchange="pageheadingChanged()" value="<?php echo $pageheading?>" />
				</div>
				<?php
				}
				?>
				<div id="editoptions" style="clear: both;text-align:center;visibility:hidden"></div>
				





























<div style="float:right"class="fb-like" data-href="http://bindex.info/<?php echo str_replace(","," ",$sitedirectory)?>" data-layout="box_count" data-width="450" data-show-faces="true" data-action="recommend" data-font="arial"></div>









<div style="float:left" class="fb-comments" data-href="http://bindex.info/<?php echo str_replace(","," ",$sitedirectory)?>" data-num-posts="10" data-width="470"></div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	</div>



</div>












</div>



<div id="footer">
		<p>Copyright (c) www.bindex.info All rights reserved. <span style="margin-left:30px;">Designed by <a href="http://www.alavida.com" target="_blank" style="text-decoration:none;"><span style="color:#000000;">Alavida.com</span></a></span></p>
	</div>













	<!-- end #content -->
	
	

	<!-- end #footer -->
	<!-- end #page -->

</body>
<script language="JavaScript">
	var usebackgroundimage = <?php echo $pagesrow['backgroundimage']?>;
	var backgroundcolor = '<?php echo $pagesrow['backgroundcolor']?>';
	var nextcomment = 8;
	var totalcomments = <?php echo '0' //$nmbrcomments?>;
	if (usebackgroundimage!=1) {
		$('body').css({background:'none'});
		$('body').css("background",'#'+backgroundcolor);
	}
	function getPrev() {
		$('#ajaximg').css({display:"inline"});
		tpgm = '../comments_action.php?t=p';
		if (nextcomment>16)
			nextcomment = nextcomment-16;
		else
			nextcomment = 0;
		$.ajax({
			type: "POST",
			url: tpgm,
			cache: false,
			data:"startwith="+nextcomment+
			"&userid="+$('#ton').val(),
			success: function(html){
				if (html.substr(0,7) == 'Invalid') {
					$("#regerrmessage").html('<font style="color:red;font-weight:bold;">'+html+'</font>');
					$('#regerrmessage').css({display:'inline'})
					$('#ajaximg').css({display:"none"});
					return;
				}
				tdata = html.split('~~');
				tcntr = 1;
				for (i=1;i<=8;i++) {
					$('#comment'+i).html('')
				}
				for (i=0;i<=tdata.length-1;i=i+4) {
					if (tdata[i]=='')
						break;
					ttext = '<img id="cmntimg" src="images/'+tdata[i]+'"><span class="dispname">'+tdata[i+1]+'</span>'+'&nbsp;&nbsp;&nbsp;'+tdata[i+2]+'<br />'+tdata[i+3];
					$('#comment'+tcntr).html(ttext)
					tcntr++;
					if (i>32)
						break;
					if (tcntr>8)
						break;
				}
				nextcomment = nextcomment+8;
				$('#regerrmessage').html('<font style="color:0d3694;font-weight:bold;">Comments</font>');
				setTimeout("$('#regerrmessage').fadeOut()", 5000);
				$('#regerrmessage').css({display:'inline'})
				$('#ajaximg').css({display:"none"});
			}
		});
	}
	function getNext() {
		$('#ajaximg').css({display:"inline"});
		tpgm = '../comments_action.php?t=p';
		$.ajax({
			type: "POST",
			url: tpgm,
			cache: false,
			data:"startwith="+nextcomment+
			"&userid="+$('#ton').val(),
			success: function(html){
				if (html.substr(0,7) == 'Invalid') {
					$("#regerrmessage").html('<font style="color:red;font-weight:bold;">'+html+'</font>');
					$('#regerrmessage').css({display:'inline'})
					$('#ajaximg').css({display:"none"});
					return;
				}
				tdata = html.split('~~');
				tcntr = 1;
				for (i=1;i<=8;i++) {
					$('#comment'+i).html('')
				}
				for (i=0;i<=tdata.length-1;i=i+4) {
					if (tdata[i]=='')
						break;
					ttext = '<img id="cmntimg" src="images/'+tdata[i]+'"><span class="dispname">'+tdata[i+1]+'</span>'+'&nbsp;&nbsp;&nbsp;'+tdata[i+2]+'<br />'+tdata[i+3];
					$('#comment'+tcntr).html(ttext)
					tcntr++;
					if (i>32)
						break;
					if (tcntr>8)
						break;
				}
				nextcomment = nextcomment+8;
				$('#regerrmessage').html('<font style="color:0d3694;font-weight:bold;">Comments</font>');
				setTimeout("$('#regerrmessage').fadeOut()", 5000);
				$('#regerrmessage').css({display:'inline'})
				$('#ajaximg').css({display:"none"});
			}
		});
	}
	<?php
	if ($_COOKIE['vndlevel'] == "10") {
	?>
	function delMessage(trec,tcmntnmbr) {
		$('#ajaximg').css({display:"inline"});
		tpgm = '../comments_action.php?t=d';
		$.ajax({
			type: "POST",
			url: tpgm,
			cache: false,
			data:"id="+trec,
			success: function(html){
				if (html.substr(0,7) == 'Invalid') {
					$("#regerrmessage").html('<font style="color:red;font-weight:bold;">'+html+'</font>');
					$('#regerrmessage').css({display:'inline'})
					$('#ajaximg').css({display:"none"});
					return;
				}
				$('#regerrmessage').html('<font style="color:0d3694;font-weight:bold;">Comment Deleted</font>');
				setTimeout("$('#regerrmessage').fadeOut()", 5000);
				$('#regerrmessage').css({display:'inline'})
				$('#ajaximg').css({display:"none"});
				$('#editcomment'+tcmntnmbr).html('');
				$('#comment'+tcmntnmbr).html('');
			}
		});
	}
	<?php
	}
	?>
	<?php
	if ($_COOKIE['vndlevel'] == "10") {
	?>
	var activesynopsis = '';
	var savecontent1saved = true;
	var savecontent2saved = true;
	var savecontent3saved = true;
	var savecontent4saved = true;
	var savecontent5saved = true;
	var savecontent6saved = true;
	var savecontent7saved = true;
	var savecontent8saved = true;
	var savesitename = '<?php echo $sitedirectory?>';
	var savesiteimage = '../../images/save_gray2.png';
	var savebckgndbtnimage = $('#savesiteheader').css("background-image");
	var savesitemenu = '../../images/save_gray2.png';
	var savesitemenuinfo = 'Show';
	var tsavedisppagetitle = '';

	function openEdit() {
		$('#leftcontent').css({display:'none'});
		$('#disppagetitle').css({display:'none'});
		$('#leftedit').css({display:'inline'});
		$('#rightcontent').css({display:'none'});
		$('#editlogo').css({display:'inline'});
		$('#headerinfo').css({display:'inline'});
		$('#rightedit').css({display:'inline'});
		$('#previewdiv').css({display:"inline"});
		$('#savediv').css({display:"inline"});
		$('#returntoeditdiv').css({display:"none"});
		$('#logoutdiv').css({display:"none"});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=closeEdit()>Exit Edit</span>';
		$('#editmodediv').html(tlink);
		previewmode = false;
		editoractive = true;
	}
	function hideEdit() {
		$('#leftcontent').css({display:'inline'});
		if (tsavedisppagetitle == '') {
			tsavedisppagetitle = $('#disppagetitle').html();
			$('#disppagetitle').html($('#inputlogo').val());
		}
		$('#disppagetitle').html($('#inputlogo').val());
		$('#disppagetitle').css({display:'inline'});
		$('#leftedit').css({display:'none'});
		$('#rightcontent').css({display:'inline'});
		$('#editlogo').css({display:'none'});
		$('#headerinfo').css({display:'none'});
		$('#rightedit').css({display:'none'});
		$('#logoutdiv').css({display:"none"});
		$('#previewdiv').css({display:"none"});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=hideEdit()>Exit Edit</span>';
		$('#editmodediv').html(tlink);
		$('#editmodediv').css({display:'inline'});
		$('#returntoeditdiv').css({display:"inline"});
		$('#savediv').css({display:"none"});
		previewmode = true;
		editoractive = true;
	}
	function closeEdit() {
		$('#leftcontent').css({display:'inline'});
		$('#disppagetitle').css({display:'inline'});
		$('#leftedit').css({display:'none'});
		$('#rightcontent').css({display:'inline'});
		$('#editlogo').css({display:'none'});
		$('#headerinfo').css({display:'none'});
		$('#rightedit').css({display:'none'});
		$('#returntoeditdiv').css({display:"none"});
		$('#savediv').css({display:"none"});
		$('#logoutdiv').css({display:"inline"});
		tlink = '<span style="cursor:pointer;color:#000000;" onmouseover="omo(this)" onmouseout="omot(this)" onclick=openEdit()>Edit Site</span>';
		$('#editmodediv').html(tlink);
		$('#disppagetitle').html(tsavedisppagetitle);
		previewmode = false;
		editoractive = false;
		location.href = "comments.php";
	}
	function pageheadingChanged() {
		$('#savedivlink').css({color:"#ff0000"});
		$('#savedivlink').html('Save');
	}
	<?php
	}
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
	?>
	<?php
	if ($editpage && $previewmode) {
	?>
		$(window).load(function(){
			hideEdit();
			editoractive = true;
			previewmode = true;
		});  
	<?php
	}
	else {
		if ($editpage) {
	?>
			$(window).load(function(){
				openEdit();
				editoractive = true;
				previewmode = false;
			});  
	<?php
		}
	}
	?>
</script> 
</html>
