<?php // echo $user -> getFullName().' '.$user -> getEmail(); ?>
 	
<center>
<?php if( $doctypeid > 0 ): ?>
<a href="/new repository/web/archive/report.html">گزارش گیری</a>
<?php endif; ?>
<?php if (count($docs)): ?>
<table id="doc_tabs">
<tr>
<th><center>نام سند</center></th>
<th><center>تاریخ بارگذاری سند</center></th>
<th><center>مشاهده کامل سند</center></th>
<th><center>ویرایش سند</center></th>
<th><center>حذف</center></th>
<th><center>به اشتراک بگذارید</center></th>
</tr>

<?php foreach ( $docs as $doc ):?>
 <tr>
  <td><center><?php echo  $doc -> getPath()  ?></center> </td>
  <td><center><?php echo  $doc ->getCreatedAt()  ?></center> </td>
  <td><center><?php echo link_to(image_tag('/images/page.png',array('title'=>'مشاهده سند')),'document/show?docid='.$doc->getId()) ?></center></td>
  <td><center><?php echo link_to(image_tag('/images/page_edit.png',array('title'=>'ویرایش سند')),'document/show?docid='.$doc->getId()) ?></center></td>
  <td><center><?php echo link_to_remote(image_tag('/images/page_remove.png',array('title'=>'حذف سند')),array('update'=>'list','url'=> 'document/delete?docid='.$doc->getId())) ?></center></td>
  <td><center><?php echo link_to(image_tag('/images/users.png',array('title'=>'به اشتراک گذاشتن سند')),'document/share?docid='.$doc->getId()) ?></center></td>
 </tr>
 <?php endforeach; ?>
</table>
<br>
<?php echo count($docs).' سند یافت شد .' ?>
<?php endif; ?>
</center>
<br>