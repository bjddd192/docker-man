<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">
            
            <h1 class="page-title"><?php echo $this->lang->line('_Oracle'); ?> <?php echo $this->lang->line('_Health Monitor'); ?></h1>
</div>
        
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Oracle Monitor'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Health Monitor'); ?></li>
            <span class="right"><?php echo $this->lang->line('the_latest_acquisition_time'); ?>:<?php if(!empty($datalist)){ echo $datalist[0]['create_time'];} else {echo $this->lang->line('the_monitoring_process_is_not_started');} ?></span>
</ul>

<div class="container-fluid">
<div class="row-fluid">
 
<script src="lib/bootstrap/js/bootstrap-switch.js"></script>
<link href="lib/bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>
                    
<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="<?php echo site_url('lp_oracle/index') ?>" >
 
  <input type="text" id="host"  name="host" value="" placeholder="<?php echo $this->lang->line('please_input_host'); ?>" class="input-medium" >
  <input type="text" id="tags"  name="tags" value="" placeholder="<?php echo $this->lang->line('please_input_tags'); ?>" class="input-medium" >
  
  
  <select name="session_total" class="input-small" style="width: 120px;">
  <option value=""><?php echo $this->lang->line('session_total'); ?></option>
  <option value="50" <?php if($setval['session_total']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['session_total']=='100') echo "selected"; ?> >> 100</option>
  <option value="300" <?php if($setval['session_total']=='300') echo "selected"; ?> >> 300</option>
  <option value="500" <?php if($setval['session_total']=='500') echo "selected"; ?> >> 500</option>
  <option value="1000" <?php if($setval['session_total']=='1000') echo "selected"; ?> >> 1000</option>
  <option value="2000" <?php if($setval['session_total']=='2000') echo "selected"; ?> >> 2000</option>
  <option value="3000" <?php if($setval['session_total']=='3000') echo "selected"; ?> >> 3000</option>
  <option value="5000" <?php if($setval['session_total']=='5000') echo "selected"; ?> >> 5000</option>
  </select>
  <select name="session_actives" class="input-small" style="width: 120px;">
  <option value=""><?php echo $this->lang->line('session_actives'); ?></option>
  <option value="5" <?php if($setval['session_actives']=='5') echo "selected"; ?> >> 5</option>
  <option value="10" <?php if($setval['session_actives']=='10') echo "selected"; ?> >> 10</option>
  <option value="20" <?php if($setval['session_actives']=='20') echo "selected"; ?> >> 20</option>
  <option value="30" <?php if($setval['session_actives']=='30') echo "selected"; ?> >> 30</option>
  <option value="50" <?php if($setval['session_actives']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['session_actives']=='100') echo "selected"; ?> >> 100</option>
  </select>
  
  <select name="order" class="input-small" style="width: 100px;">
  <option value=""><?php echo $this->lang->line('sort'); ?></option>
  <option value="id" <?php if($setval['order']=='id') echo "selected"; ?> ><?php echo $this->lang->line('default'); ?></option>
  <option value="host" <?php if($setval['order']=='host') echo "selected"; ?> ><?php echo $this->lang->line('host'); ?></option>
  <option value="tags" <?php if($setval['order']=='tags') echo "selected"; ?> ><?php echo $this->lang->line('tags'); ?></option>
  </select>
  
  <select name="order_type" class="input-small" style="width: 70px;">
  <option value="asc" <?php if($setval['order_type']=='asc') echo "selected"; ?> ><?php echo $this->lang->line('asc'); ?></option>
  <option value="desc" <?php if($setval['order_type']=='desc') echo "selected"; ?> ><?php echo $this->lang->line('desc'); ?></option>
  </select>

  <button type="submit" class="btn btn-success"><i class="icon-search"></i> <?php echo $this->lang->line('search'); ?></button>
  <a href="<?php echo site_url('lp_oracle/index') ?>" class="btn btn-warning"><i class="icon-repeat"></i> <?php echo $this->lang->line('reset'); ?></a>
  <button id="refresh" class="btn btn-info"><i class="icon-refresh"></i> <?php echo $this->lang->line('refresh'); ?></button>
</form>                
</div>


<div class="well">
    <table class="table table-hover table-condensed ">
      <thead>
        <tr style="font-size: 12px;">
		<th colspan="3"><center><?php echo $this->lang->line('servers'); ?></center></th>
        <th colspan="3"><center><?php echo $this->lang->line('instance'); ?></center></th>
        <th colspan="2"><center><?php echo $this->lang->line('basic_info'); ?></center></th>
		<th colspan="3"><center><?php echo $this->lang->line('session'); ?></center></th>
        
        <th ></th>
	   </tr>
        <tr style="font-size: 12px;">
        <th><?php echo $this->lang->line('host'); ?></th> 
        <th><?php echo $this->lang->line('tags'); ?></th> 
		<th><?php echo $this->lang->line('connected'); ?></th>
        <th><?php echo $this->lang->line('name'); ?></th>
        <th><?php echo $this->lang->line('role'); ?></th>
        <th><?php echo $this->lang->line('status'); ?></th>
        <th><?php echo $this->lang->line('uptime'); ?></th>
		<th><?php echo $this->lang->line('version'); ?></th>
		<th><?php echo $this->lang->line('session_total'); ?></th>
        <th><?php echo $this->lang->line('session_actives'); ?></th>
        <th><?php echo $this->lang->line('session_waits'); ?></th>
        <th><?php echo $this->lang->line('chart'); ?></th>
	    </tr>
      </thead>
      <tbody>
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <td><?php echo $item['host'] ?>:<?php echo $item['port'] ?></td>
		<td><?php echo $item['tags'] ?></td>
		<td><?php if($item['connect']=='1'){ ?> <span class="label label-success"><?php echo $this->lang->line('success'); ?></span> <?php }else{  ?><span class="label label-important"><?php echo $this->lang->line('failure'); ?></span> <?php } ?></td>
        <td><?php echo check_value($item['instance_name']) ?></td>
        <td><?php echo check_value($item['database_role']) ?></td>
        <td><?php echo check_value($item['open_mode']) ?></td>
        <td><?php echo check_value($item['uptime']) ?></td>
        <td><?php echo check_value($item['version']) ?></td>
        <td><?php echo check_connections(check_value($item['session_total'])) ?></td>
        <td><?php echo check_active(check_value($item['session_actives'])) ?></td>
        <td><?php echo check_active(check_value($item['session_waits'])) ?></td>
   
        <td><?php if($item['connect']=='1'){ ?><a href="<?php echo site_url('lp_oracle/chart/'.$item['server_id']) ?>"><img src="./images/chart.gif"/></a> <?php }else{  ?>--- <?php } ?></td>
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

