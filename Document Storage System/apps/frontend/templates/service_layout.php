<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />

</head>

<body >
	<center>
		<?php echo image_tag('banner.jpg', array('id' => "banner")) ?>
		<div id="content_service_index">
			<?php echo $sf_data->getRaw('sf_content') ?>
		</div>
	</center>
</body>
</html>
