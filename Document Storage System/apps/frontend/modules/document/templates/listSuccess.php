<?php // echo $user -> getFullName().' '.$user -> getEmail(); ?>
<br>
<?php echo count($docs).' مورد یافت شد.' ?>
<?php if (count($docs)): ?>
<br/><br/>
<table id="doc_tabs">
<tr>
<th>نام سند</th>
<th>تاریخ بارگذاری سند</th>
<th>مشاهده کامل سند</th>
<th>ویرایش سند</th>
<th> حذف سند</th>
<th>به اشتراک بگذارید</th>
</tr>

<?php foreach ( $docs as $doc ):?>
 <tr>
  <td ><center><?php echo  $doc -> getPath()  ?></center> </td>
  <td><center><?php echo  $doc ->getCreatedAt()  ?></center> </td>
  <td><center><?php echo link_to(image_tag('/images/page.png',array('title'=>'مشاهده سند')),'document/show?docid='.$doc->getId()) ?></center></td>
  <td><center><?php echo link_to(image_tag('/images/page_edit.png',array('title'=>'ویرایش سند')),'document/show?docid='.$doc->getId()) ?></center></td>
  <td><center><?php echo link_to_remote(image_tag('/images/page_remove.png',array('title'=>'حذف سند')),array('update'=>'list','url'=> 'document/delete?docid='.$doc->getId(),
				'confirm' => __('آیا مطمئن هستید ؟'))) ?></center></td>
  <td><center><?php echo link_to(image_tag('/images/users.png',array('title'=>'به اشتراک بگذارید')),'document/share?docid='.$doc->getId()) ?></center></td>
 </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<br/><br>

<?php echo count($shareds).' مورد در اشتراک دارد.' ?>
<?php if(count($shareds)): ?>
<br/><br/>
<table id="doc_tabs">
<tr>
<th>صاحب سند</th>
<th>نام سند</th>
<th>تاریخ بارگذاری سند</th>
<th>مشاهده کامل سند</th>

<!-- <th>حذف</th>  -->
</tr>

<?php foreach ( $shareds as $shared ):?>
 <tr>
  <td><?php $owner = UserPeer::retrieveByPK($shared->getUserId()); echo $owner->getFullName(); ?></td>
  <td><?php echo  $shared -> getPath()  ?> </td>
  <td><?php echo  $shared ->getCreatedAt()  ?> </td>
  <td><?php echo link_to(image_tag('/images/page.png',array('title'=>'مشاهده سند')),'document/show?docid='.$shared->getId()) ?></td>

 <!--  <td><?php //echo link_to('اینجا را کلیک کنید','document/delete?docid='.$shared->getId()) ?></td>  -->
  
 </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>