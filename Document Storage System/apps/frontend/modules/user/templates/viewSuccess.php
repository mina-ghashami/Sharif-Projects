<?php use_helper('I18N','Javascript'); ?>
<br>
<center>
<?php if(!count($docs)): echo $user->getFullName()." صاحب هیچ سندی نیست "?><?php endif; ?>

<?php if (count($docs)): ?>
<?php echo $user->getFullName()." صاحب ".count($docs)." سند است: " ?>
<table >
<tr>
<td><center>نام سند</center></td>
<td>تاریخ بارگذاری سند</td>
<td>مشاهده کامل سند</td>
<td>ویرایش سند</td>
<td> حذف سند</td>
<td>به اشتراک بگذارید</td>
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
<br /><br />

<?php if(count($shareds)): ?><?php echo " و ".count($shareds)."  سند در اشتراک دارد: " ?><?php endif; ?>
<?php if(!count($shareds)): ?><?php echo "و هیچ سندی در اشتراک ندارد." ?><?php endif; ?>

<?php if(count($shareds)): ?>
<br/>
<table >
<tr>
<td>نام سند</td>
<td>صاحب سند</td>
<td>تاریخ بارگذاری سند</td>
<td>مشاهده کامل سند</td>
</tr>

<?php foreach ( $shareds as $shared ):?>
 <tr>
  <td><center><?php echo  $shared -> getPath()  ?></center> </td>
  <td><center><?php $owner = UserPeer::retrieveByPK($shared->getUserId()); echo $owner->getFullName(); ?></center></td>
  <td><center><?php echo  $shared ->getCreatedAt()  ?></center> </td>
  <td><center><?php echo link_to(image_tag('/images/page.png',array('title'=>'مشاهده سند')),'document/show?docid='.$shared->getId()) ?></center></td>
  
 </tr>
<?php endforeach; ?>
</table>
</center>
<?php endif; ?>

  
         
 
 



