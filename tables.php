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
<body>
	<dl class="tabs" data-tab>
		<dd class="active"><a href="#panel1">customer</a></dd>
		<dd><a href="#panel2">hassong</a></dd>
		<dd><a href="#panel3">item</a></dd>
		<dd><a href="#panel4">leadsinger</a></dd>
		<dd><a href="#panel5">order</a></dd>
		<dd><a href="#panel6">purchaseitem</a></dd>
		<dd><a href="#panel7">returnitem</a></dd>
		<dd><a href="#panel8">return</a></dd>
	</dl>
	<div class="tabs-content">
		<div class="content active" id="panel1">
			<?php
			drawtable("customer");
			?>
		</div>
		<div class="content" id="panel2">
			<p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel3">
			<p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel4">
			<p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel5">
			<p>This is the first panel of the basic tab example. This is the first panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel6">
			<p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel7">
			<p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
		</div>
		<div class="content" id="panel8">
			<p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
		</div>
	</body>
	</html>