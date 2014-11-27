<?php
require_once("config.php");
require_once("functions.php");
?>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<title> CPSC 304 - Tables </title>

	<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
</script>
</head>
<body>
	<div class="tabs">
		<ul class="tab-links">
			<li class="active"><a href="#tab1">Tab #1</a></li>
			<li><a href="#tab2">Tab #2</a></li>
			<li><a href="#tab3">Tab #3</a></li>
			<li><a href="#tab4">Tab #4</a></li>
		</ul>

		<div class="tab-content">
			<div id="tab1" class="tab active">
				<?php
				drawtable("item");
				?>
			</div>

			<div id="tab2" class="tab">
				<p>Tab #2 content goes here!</p>
				<p>Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis. In hac habitasse platea dictumst. Ut euismod tempus hendrerit. Morbi ut adipiscing nisi. Etiam rutrum sodales gravida! Aliquam tellus orci, iaculis vel.</p>
			</div>

			<div id="tab3" class="tab">
				<p>Tab #3 content goes here!</p>
				<p>Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum ri.</p>
			</div>

			<div id="tab4" class="tab">
				<p>Tab #4 content goes here!</p>
				<p>Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis. In hac habitasse platea dictumst. Ut euismod tempus hendrerit. Morbi ut adipiscing nisi. Etiam rutrum sodales gravida! Aliquam tellus orci, iaculis vel.</p>
			</div>
		</div>
	</div>
</body>
</html>