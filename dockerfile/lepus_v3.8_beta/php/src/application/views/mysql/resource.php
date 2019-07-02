<div class="header">
            
            <h1 class="page-title"><?php echo $this->lang->line('mysql'); ?> <?php echo $this->lang->line('_Resource Monitor'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_MySQL Monitor'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Resource Monitor'); ?></li>
            <span class="right"><?php echo $this->lang->line('the_latest_acquisition_time'); ?>:<?php if(!empty($datalist)){ echo $datalist[0]['create_time'];} else {echo $this->lang->line('the_monitoring_process_is_not_started');} ?></span>
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<script src="lib/bootstrap/js/bootstrap-switch.js"></script>
<link href="lib/bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>
                    
<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="" >
  <input type="text" id="host"  name="host" value="" placeholder="<?php echo $this->lang->line('please_input_host'); ?>" class="input-medium" >
  <input type="text" id="tags"  name="tags" value="" placeholder="<?php echo $this->lang->line('please_input_tags'); ?>" class="input-medium" >
  
  <select name="order" class="input-small" style="width: 180px;">
  <option value=""><?php echo $this->lang->line('sort'); ?></option>
  <option value="id" <?php if($setval['order']=='id') echo "selected"; ?> ><?php echo $this->lang->line('default'); ?></option>
  <option value="host" <?php if($setval['order']=='host') echo "selected"; ?> ><?php echo $this->lang->line('host'); ?></option>
  <option value="tags" <?php if($setval['order']=='tags') echo "selected"; ?> ><?php echo $this->lang->line('tags'); ?></option>
  <option value="max_connections" <?php if($setval['order']=='max_connections') echo "selected"; ?> ><?php echo $this->lang->line('max_connections'); ?></option>
   <option value="threads_connected" <?php if($setval['order']=='threads_connected') echo "selected"; ?> ><?php echo $this->lang->line('threads_connected'); ?></option>
  <option value="max_connect_errors" <?php if($setval['order']=='max_connect_errors') echo "selected"; ?> ><?php echo $this->lang->line('max_connect_errors'); ?></option>
  <option value="open_files_limit" <?php if($setval['order']=='open_files_limit') echo "selected"; ?> ><?php echo $this->lang->line('open_files_limit'); ?></option>
  <option value="open_files" <?php if($setval['order']=='open_files') echo "selected"; ?> ><?php echo $this->lang->line('open_files'); ?></option>
  <option value="table_open_cache" <?php if($setval['order']=='table_open_cache') echo "selected"; ?> ><?php echo $this->lang->line('table_open_cache'); ?></option>
  <option value="open_tables" <?php if($setval['order']=='open_tables') echo "selected"; ?> ><?php echo $this->lang->line('open_tables'); ?></option>

  </select>
  <select name="order_type" class="input-small" style="width: 70px;">
  <option value="asc" <?php if($setval['order_type']=='asc') echo "selected"; ?> ><?php echo $this->lang->line('asc'); ?></option>
  <option value="desc" <?php if($setval['order_type']=='desc') echo "selected"; ?> ><?php echo $this->lang->line('desc'); ?></option>
  </select>

  <button type="submit" class="btn btn-success"><i class="icon-search"></i> <?php echo $this->lang->line('search'); ?></button>
  <a href="<?php echo site_url('lp_mysql/key_cache') ?>" class="btn btn-warning"><i class="icon-repeat"></i> <?php echo $this->lang->line('reset'); ?></a>
  <button id="refresh" class="btn btn-info"><i class="icon-refresh"></i> <?php echo $this->lang->line('refresh'); ?></button>
</form>                
</div>


<div class="well">
    <table class="table table-hover table-condensed ">
      <thead>
       <tr style="font-size: 12px;">
		<th colspan="2"><center><?php echo $this->lang->line('servers'); ?></center></th>
		<th colspan="3"><center><?php echo $this->lang->line('connections_r'); ?></center></th>
		<th colspan="2"><center><?php echo $this->lang->line('files_r'); ?></center></th>
		<th colspan="2"><center><?php echo $this->lang->line('tables_r'); ?></center></th>
	   </tr>
        <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('host'); ?></th> 
        <th><?php echo $this->lang->line('tags'); ?></th>
		    <th><?php echo $this->lang->line('max_connections'); ?></th>
        <th><?php echo $this->lang->line('threads_connected'); ?></th>
        <th><?php echo $this->lang->line('max_connect_errors'); ?></th>
		    <th><?php echo $this->lang->line('open_files_limit'); ?></th>
        <th><?php echo $this->lang->line('open_files'); ?></th>
        <th><?php echo $this->lang->line('table_open_cache'); ?></th>
        <th><?php echo $this->lang->line('open_tables'); ?></th>
        <th><?php echo $this->lang->line('chart'); ?></th>
	    </tr>
      </thead>
      <tbody>
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <td><?php echo $item['host'] ?>:<?php echo $item['port'] ?></td>
        <td><?php echo $item['tags'] ?></td>
	      <td><?php echo $item['max_connections'] ?></td>
        <td><?php echo $item['threads_connected'] ?></td>
        <td><?php echo $item['max_connect_errors'] ?></td>
        <td><?php echo $item['open_files_limit'] ?></td>
        <td><?php echo $item['open_files'] ?></td>
        <td><?php echo $item['table_open_cache'] ?></td>
        <td><?php echo $item['open_tables'] ?></td>
        <td><a href="<?php echo site_url('lp_mysql/chart/'.$item['server_id']) ?>"><img src="./images/chart.gif"/></a></td>
    </tr>
 <?php endforeach;?>
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
    $('#refresh').click(function(){
        document.location.reload(); 
    })
 </script>

