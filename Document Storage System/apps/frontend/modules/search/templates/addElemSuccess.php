
  <td style="border: 1px solid red;"> 
	<?php echo $name." "; ?>
  </td>
<td> 
	
	<?php echo input_tag($case.'_input','') ?>
	<br /><br />
	  شامل 
	<?php echo radiobutton_tag($case.'_radio','contains',true) ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  همه لغت
	<?php echo radiobutton_tag($case.'_radio','wholeWord',false) ?>
	&nbsp;&nbsp;&nbsp;&nbsp;
	
	
  </td>