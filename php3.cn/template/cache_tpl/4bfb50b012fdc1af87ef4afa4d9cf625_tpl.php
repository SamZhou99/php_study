<?php defined('PHPNEW_STATIC_TPL') === false && exit('PHPnew CACHE_TPL 7.3.1');?><?php extract($this->templates_assign);?><!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<meta charset="utf-8">
	<title>辣椒-网址导航</title>
	<link rel="stylesheet" rev="stylesheet" href="/template/default/1234.css" type="text/css">
	<link rel="shortcut icon" href="http://www.itouxiao.net/favicon.ico" />
	<link rel="bookmark" href="http://www.itouxiao.net/favicon.ico" />
	<style type="text/css">
		* {
			scrollbar-base-color: #F8F8F8;
			scrollbar-arrow-color: #698CC3;
			font-size: 12px;
			font-family: Verdana;
			font-weight: normal;
			margin: 0px;
			text-decoration: none;
		}

		body {
			margin: 0px;
			padding: 0px;
		}

		frame {
			margin: 0px;
		}

		li,
		ul {
			margin: 0px;
			padding: 0px;
		}

		.link-status {
			font-size: 8px;
			color: red;
		}
	</style>
	<script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function () {
			$('#test_btn').on('click', () => {
				$('#myIframe').on('load', () => {
					console.log('框架加载成功');
				});
				$('#myIframe').on('error', () => {
					console.log('框架加载失败');
				});

				let linkArr = [];
				$('li a').each((index, item) => {
					console.log( $(item).eq(0).attrs() );
					linkArr[index] = $(item).eq(0).attr('href');
				});

				let linkArrIndex = 0;
				let linkObj = linkArr[linkArrIndex];
				$('#myIframe').attr('src', linkObj.attr('href'));
			});
		});
	</script>
</head>

<body>

	<iframe id="myIframe" src="#"></iframe>

	<div class="category">
		<input id="test_btn" type="button" value="AUTO TEST LINK URL" />
		<div class="categoryone"></div>
		<div class="categorytwo"></div>
		<div class="categorythr">
			<?php foreach ($category as $categoryItem) : ?>
			<div class="list">
				<h3 class="title"><?php echo $categoryItem['name']?></h3>
				<ul>
					<?php foreach ($categoryItem['data'] as $linkItem) : $url = $linkItem['url']; $name = $linkItem['name'];?>
					<li><a href="<?php echo $url?>" target="_blank"><?php echo $name?></a><span class="link-status">?</span></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="categoryfor">Copyright &#169; <a href="#">辣椒网址导航</a>
			<span id="poweredakcms">Powered by <a href="#" target="_blank">AKCMS</a></span>
			<br>
			<a href="http://1234.demo.akhtm.com/#">备案号</a>
			<br>
		</div>
		<div style="clear:both;"></div>

	</div>

</body>

</html>