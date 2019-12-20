<?php defined('PHPNEW_STATIC_TPL') === false && exit('PHPnew CACHE_TPL 7.3.1');?><?php extract($this->templates_assign);?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<meta charset="utf-8">
	<title>LINKS</title>
	<style type="text/css">
		body{
			text-align: center;
		}
		.container{
			width: 80%;
		}
		.container li {
			list-style-type: none;
		}

		.container .item-title {
			text-align: left;
			font-size: 2rem;
		}

		.container .item-link {
			margin: 10px;
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
	</style>
</head>

<body>

<div class="container">

<ul>
<?php foreach ($category as $categoryItem) : ?><li>
<div class="item-title"><?php echo $categoryItem['name']?></div>
<div class="item-link"><?php foreach ($categoryItem['data'] as $linkItem) : $url = $linkItem['url']; $name = $linkItem['name'];?>
<a href="<?php echo $url?>" target="_blank"><?php echo $name?></a>
<?php endforeach; ?></div>
</li>
<?php endforeach; ?>
</ul>

</div>

</body>

</html>