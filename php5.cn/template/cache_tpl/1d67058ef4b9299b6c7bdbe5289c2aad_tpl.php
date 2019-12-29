<?php defined('PHPNEW_STATIC_TPL') === false && exit('PHPnew CACHE_TPL 7.3.1');?><?php extract($this->templates_assign);?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<meta charset="utf-8">
	<title>LINKS</title>
	<style type="text/css">
		body{
			text-align: center;
			background-color: #333333;
			margin: 0px;
			padding: 0px;
		}
		.container{
			width: 98%;
		}
		.container li {
			list-style-type: none;
			background-color: #FFFFFF;
			padding: 10px;
			margin: 10px;
			border-radius: 10px;
		}

		.container .item-title {
			text-align: left;
			font-size: 2rem;
			border-bottom-style:solid;
			/* border-bottom-color: #EE33EE; */
			border-bottom-color: #333333;
			margin-bottom: 10px;
		}

		.container .item-link {
			overflow: hidden;
		}

		.container .item-link a {
			font-size: 1.2rem;
			margin: 0.5px;
			padding: 10px;
			width: 200px;
			background-color: #EEEEEE;
			display: block;
			float: left;
		}

		/* 原本的链接样式 */
		.container .item-link a:link {
			color: #333333;
			background-color: #EEEEEE;
			text-decoration-line: none;
		}

		/* 点击后的样式 */
		.container .item-link a:visited {
			color: #BBBBBB;
			background-color: #EFEFEF;
		}

		/* 鼠标经过的样式 */
		.container .item-link a:hover {
			color: #AAFF11;
			background-color: #FF0099;
			animation: myfirst 1s;
			-moz-animation: myfirst 1s;
			-webkit-animation: myfirst 1s;
			-o-animation: myfirst 1s;
		}

		/* 鼠标按下样式 */
		.container .item-link a:active,
		.container .item-link a:focus {
			background-color: #990033;
		}

		@keyframes myfirst {
			from {
				background: #EEEEEE;
			}

			to {
				background: #FF0099;
			}
		}

		.link-status{
			float: right;
		}
	</style>
	<script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){
			alert(1);
		});
	</script>
</head>

<body>

<div class="container">
<input class="inputbutton" type="button" value="TEST" onclick="linkCheck()" />
<ul>
<?php foreach ($category as $categoryItem) : ?>
<li>
<div class="item-title"><?php echo $categoryItem['name']?></div>
<div class="item-link">
	<?php foreach ($categoryItem['data'] as $linkItem) : $url = $linkItem['url']; $name = $linkItem['name'];?>
	<a href="<?php echo $url?>" target="_blank"><?php echo $name?><span class="link-status">?</span></a>
	<?php endforeach; ?>
</div>
</li>
<?php endforeach; ?>
</ul>

</div>

</body>

</html>