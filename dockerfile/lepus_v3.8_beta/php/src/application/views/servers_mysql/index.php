<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">  
            <h1 class="page-title"><?php echo $this->lang->line('_MySQL'); ?> <?php echo $this->lang->line('list'); ?></h1>
</div>
     
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Servers Configure'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_MySQL'); ?></li>
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<div class="btn-toolbar">
    <a class="btn btn-primary " href="<?php echo site_url('servers_mysql/add') ?>"><i class="icon-plus"></i> <?php echo $this->lang->line('add'); ?></a>
    <a class="btn btn-primary " href="<?php echo site_url('servers_mysql/batch_add') ?>"><i class="icon-plus"></i> <?php echo $this->lang->line('batch_add'); ?></a>
    <a class="btn btn " href="<?php echo site_url('servers_mysql/trash') ?>"><i class="icon-trash"></i> <?php echo $this->lang->line('trash'); ?></a>
  <div class="btn-group"></div>
</div>

<div class="well">

<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="" >
 
 <input type="text" id="host"  name="host" value="<?php echo $setval['host']; ?>" placeholder="<?php echo $this->lang->line('please_input_host'); ?>" class="input-medium" >
 <input type="text" id="tags"  name="tags" value="<?php echo $setval['tags']; ?>" placeholder="<?php echo $this->lang->line('please_input_tags'); ?>" class="input-medium" >
  
  
  <button type="submit" class="btn btn-success"><i class="icon-search"></i> <?php echo $this->lang->line('search'); ?></button>
  <a href="<?php echo site_url('servers_mysql/index') ?>" class="btn btn-warning"><i class="icon-repeat"></i> <?php echo $this->lang->line('reset'); ?></a>

</form>                   
</div>

    <table class="table table-hover table-bordered">
      <thead>
        <tr>
		<th colspan="4"><center><?php echo $this->lang->line('servers'); ?></center></th>
        <th colspan="4"><center><?php echo $this->lang->line('monitoring_switch'); ?></center></th>
		<th colspan="5"><center><?php echo $this->lang->line('alarm_items'); ?></center></th>
        <th colspan="1"></th>
	    </tr>
        <tr style="font-size:12px;">
        <th><?php echo $this->lang->line('id'); ?></th>
        <th><?php echo $this->lang->line('host'); ?></th>
		<th><?php echo $this->lang->line('port'); ?></th>
        <th><?php echo $this->lang->line('tags'); ?></th>
		<th><?php echo $this->lang->line('monitor'); ?></th>
		<th><?php echo $this->lang->line('send_mail'); ?></th>
        <th><?php echo $this->lang->line('send_sms'); ?></th>
        <th><?php echo $this->lang->line('slowquery'); ?></th>
        <th><?php echo $this->lang->line('threads_connected'); ?></th>
		<th><?php echo $this->lang->line('threads_running'); ?></th>
        <th><?php echo $this->lang->line('threads_waits'); ?></th>
        <th><?php echo $this->lang->line('replication'); ?></th>
        <th><?php echo $this->lang->line('delay'); ?></th>
        <th></th>
	</tr>
      </thead>
      <tbody>
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
	    <td><?php echo $item['id'] ?></td>
		<td><?php echo $item['host'] ?></td>
		<td><?php echo $item['port'] ?></td>
        <td><?php echo $item['tags'] ?></td>
        <td><?php echo check_on_off($item['monitor']) ?></td>
        <td><?php echo check_on_off($item['send_mail']) ?></td>
        <td><?php echo check_on_off($item['send_sms']) ?></td>
        <td><?php echo check_on_off($item['slow_query']) ?></td>
        <td><?php echo check_on_off($item['alarm_threads_connected']) ?></td>
        <td><?php echo check_on_off($item['alarm_threads_running']) ?></td>
        <td><?php echo check_on_off($item['alarm_threads_waits']) ?></td>
        <td><?php echo check_on_off($item['alarm_repl_status']) ?></td>
        <td><?php echo check_on_off($item['alarm_repl_delay']) ?></td>
  
        <td><a href="<?php echo site_url('servers_mysql/edit/'.$item['id']) ?>"  title="<?php echo $this->lang->line('edit'); ?>" ><i class="icon-pencil"></i></a>&nbsp;
        <a href="<?php echo site_url('servers_mysql/delete/'.$item['id']) ?>" class="confirm_delete" title="<?php echo $this->lang->line('add_trash'); ?>" ><i class="icon-trash"></i></a>
        </td>
	</tr>
 <?php endforeach;?>
<tr>
<td colspan="14">
<font color="#000000"><?php echo $this->lang->line('total_record'); ?> <?php echo $datacount; ?></font>
</td>
</tr>
 <?php }else{  ?>
<tr>
<td colspan="14">
<font color="red"><?php echo $this->lang->line('no_record'); ?></font>
</td>
</tr>
<?php } ?>      
      </tbody>
    </table>
</div>


<script type="text/javascript">
	$(' .confirm_delete').click(function(){
		return confirm("<?php echo $this->lang->line('add_to_trash_confirm'); ?>");	
	});
</script>