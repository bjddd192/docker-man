<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">  
            <h1 class="page-title"><?php echo $this->lang->line('_OS'); ?> <?php echo $this->lang->line('trash'); ?></h1>
</div>
     
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Servers Configure'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_OS'); ?></li>
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<div class="btn-toolbar">
    <a class="btn btn " href="<?php echo site_url('servers_os/index') ?>"><i class="icon-list"></i> <?php echo $this->lang->line('list'); ?></a>
  <div class="btn-group"></div>
</div>

<div class="well">


    <table class="table table-hover table-bordered">
      <thead>
        <tr>
		<th colspan="2"><center><?php echo $this->lang->line('servers'); ?></center></th>
        <th colspan="3"><center><?php echo $this->lang->line('monitoring_switch'); ?></center></th>
		<th colspan="6"><center><?php echo $this->lang->line('alarm_items'); ?></center></th>
        <th colspan="1"></th>
	    </tr>
        <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('host'); ?></th>
        <th><?php echo $this->lang->line('tags'); ?></th>
		<th><?php echo $this->lang->line('monitor'); ?></th>
		<th><?php echo $this->lang->line('send_mail'); ?></th>
        <th><?php echo $this->lang->line('send_sms'); ?></th>
        <th><?php echo $this->lang->line('process'); ?></th>
		<th><?php echo $this->lang->line('load'); ?></th>
		<th><?php echo $this->lang->line('cpu'); ?></th>
		<th><?php echo $this->lang->line('network'); ?></th>
		<th><?php echo $this->lang->line('disk'); ?></th>
		<th><?php echo $this->lang->line('memory'); ?></th>
        <th></th>
	</tr>
      </thead>
      <tbody>
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
		<td><?php echo $item['host'] ?></td>
        <td><?php echo $item['tags'] ?></td>
        <td><?php echo check_on_off($item['monitor']) ?></td>
        <td><?php echo check_on_off($item['send_mail']) ?></td>
        <td><?php echo check_on_off($item['send_sms']) ?></td>
        <td><?php echo check_on_off($item['alarm_os_process']) ?></td>
		<td><?php echo check_on_off($item['alarm_os_load']) ?></td>
		<td><?php echo check_on_off($item['alarm_os_cpu']) ?></td>
		<td><?php echo check_on_off($item['alarm_os_network']) ?></td>
		<td><?php echo check_on_off($item['alarm_os_disk']) ?></td>
		<td><?php echo check_on_off($item['alarm_os_memory']) ?></td>
       <td><a href="<?php echo site_url('servers_os/recover/'.$item['id']) ?>" title="<?php echo $this->lang->line('recover'); ?>"><i class="icon-repeat"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('servers_os/forever_delete/'.$item['id']) ?>" class="confirm_delete" title="<?php echo $this->lang->line('forever_delete'); ?>" ><i class="icon-remove"></i></a></td>
        </td>
	</tr>
 <?php endforeach;?>
<tr>
<td colspan="12">
<font color="#000000"><?php echo $this->lang->line('total_record'); ?> <?php echo $datacount; ?></font>
</td>
</tr>
 <?php }else{  ?>
<tr>
<td colspan="12">
<font color="red"><?php echo $this->lang->line('no_record'); ?></font>
</td>
</tr>
<?php } ?>      
      </tbody>
    </table>
</div>


<script type="text/javascript">
	$(' .confirm_delete').click(function(){
		return confirm("<?php echo $this->lang->line('forever_delete_confirm'); ?>");	
	});
</script>