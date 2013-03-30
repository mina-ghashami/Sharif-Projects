<a href="/new repository/web/uploads/<?php echo $docname?>">دانلود سند</a>

<table>
<tr> 
	<td>
		<table id="doc_show">
			<tr><td>نام سند</td><td><?php echo $doc -> getPath() ?> </td></tr>
			<tr><td>صاحب سند</td><td><?php echo $owner -> getFullName() ?></td></tr>
			<tr><td>تاریخ بارگذاری</td><td><?php echo  $doc -> getCreatedAt() ?></td></tr>
			<?php echo $code ?>
			
		</table>
	</td>
	<td>
		<div id="toEdit"></div>
	</td>
</tr>
</table>