<?php use_helper('I18N'); ?>
<table >
	<tr>
		<th class = "th"> نام نوع سند </th>
		<th class = "th"> مشاهده نوع سند </th>
		<th class = "th"> ویرایش نوع سند </th>
		<th class = "th"> حذف نوع سند </th>
	</tr>
	<?php foreach ($res as $r): ?>
		<tr>
			<td class="td_show" ><?php echo $r->getName() ?></td>
			<td class="td_show"><?php echo link_to(image_tag('/images/note_accept.png',
			 array('title'=>'مشاهده')),'design/editForm?id='.$r->getId()) ?>
			 </td>
			<td class="td_show"><?php echo link_to(image_tag('/images/note_edit.png',
			 array('title'=>'ویرایش')),'design/editForm?id='.$r->getId()) ?>
			 </td>
			<td class="td_show">
			<?php echo link_to(image_tag('/images/note_remove.png', array('alt' => __('حذف'), 'title' => __('حذف'))), 
				'type/delete?id='.$r->getId(), array (
			  'post' => true,
			  'confirm' => __('آیا مطمئن هستید ؟'),
			)) ?>
			</td>
			
		</tr>
	<?php endforeach; ?>
	<tr>
		<td></td>
		<td id="footer"><center><?php echo $size."  نتیجه " ?></center></td>
		<td ></td>
		<td></td>
	</tr>
</table>