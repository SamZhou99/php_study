<?php defined('PHPNEW_STATIC_TPL') === false && exit('PHPnew CACHE_TPL 7.3.1');?><?php extract($this->templates_assign);?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<meta charset="utf-8">
	<title>辣椒-网址导航</title>
	<link rel="stylesheet" href="/template/default/style.css" />
	<link rel="shortcut icon" href="http://www.itouxiao.net/favicon.ico"/>
	<link rel="bookmark" href="http://www.itouxiao.net/favicon.ico"/>
	<script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){
			alert(1);
		});
	</script>
</head>

<body>

<div class="container">
<input id="test_btn" type="button" value="TEST" />
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