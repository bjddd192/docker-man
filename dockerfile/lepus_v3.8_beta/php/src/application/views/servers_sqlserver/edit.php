<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="header">  
            <h1 class="page-title"><?php echo $this->lang->line('_SQLServer'); ?> <?php echo $this->lang->line('edit'); ?></h1>
</div>
     
<ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_Servers Configure'); ?></li><span class="divider">/</span></li>
            <li class="active"><?php echo $this->lang->line('_SQLServer'); ?></li>
</ul>

<div class="container-fluid">
<div class="row-fluid">

<form name="form" class="form-horizontal" method="post" action="<?php echo site_url('servers_sqlserver/edit') ?>" >
<input type="hidden" name="submit" value="edit"/> 
<input type='hidden'  name='id' value=<?php echo $record['id'] ?> />
<div class="btn-toolbar">
    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> <?php echo $this->lang->line('save'); ?></button>
    <a class="btn btn " href="<?php echo site_url('servers_sqlserver/index') ?>"><i class="icon-list"></i> <?php echo $this->lang->line('list'); ?></a>
  <div class="btn-group"></div>
</div>

<?php if ($error_code!==0) { ?>
<div class="alert alert-error">
<button type="button" class="close" data-dismiss="alert">×</button>
<?php echo validation_errors(); ?>
</div>
<?php } ?>

<div class="well">
   
   <div class="control-group">
    <label class="control-label" for="">*<?php echo $this->lang->line('host'); ?></label>
    <div class="controls">
      <input type="text" id=""  name="host" value="<?php echo $record['host']; ?>" >
      <span class="help-inline"></span>
    </div>
   </div>
   
   <div class="control-group">
    <label class="control-label" for="">*<?php echo $this->lang->line('port'); ?></label>
    <div class="controls">
      <input type="text" id=""  name="port" value="<?php echo $record['port']; ?>" >
      <span class="help-inline"></span>
    </div>
   </div>

    <div class="control-group">
        <label class="control-label" for="">*<?php echo $this->lang->line('username'); ?></label>
        <div class="controls">
            <input type="text" id=""  name="username" value="<?php echo $record['username']; ?>" >
            <span class="help-inline"></span>
        </div>
    </div>
   
   <div class="control-group">
    <label class="control-label" for=""><?php echo $this->lang->line('password'); ?></label>
    <div class="controls">
      <input type="password" id=""  name="password" value="<?php echo $record['password']; ?>" >
      <span class="help-inline"></span>
    </div>
   </div>
   
   <div class="control-group">
    <label class="control-label" for="">*<?php echo $this->lang->line('tags'); ?></label>
    <div class="controls">
      <input type="text" id=""  name="tags" value="<?php echo $record['tags']; ?>" >
      <span class="help-inline"></span>
    </div>
   </div>
   
   <hr />
   
    <div class="control-group">
    <label class="control-label" for=""><?php echo $this->lang->line('monitor'); ?></label>
    <div class="controls">
        <select name="monitor" id="monitor" class="input-small">
         <option value="1"  <?php echo set_selected(1,$record['monitor']) ?>><?php echo $this->lang->line('on'); ?></option>
         <option value="0"  <?php echo set_selected(0,$record['monitor']) ?>><?php echo $this->lang->line('off'); ?></option>
        </select>
    </div>
   </div>
    <div class="control-group">
    <label class="control-label" for=""><?php echo $this->lang->line('send_mail'); ?></label>
    <div class="controls">
        <select name="send_mail" id="send_mail" class="input-small">
         <option value="1"  <?php echo set_selected(1,$record['send_mail']) ?>><?php echo $this->lang->line('on'); ?></option>
         <option value="0"  <?php echo set_selected(0,$record['send_mail']) ?>><?php echo $this->lang->line('off'); ?></option>
        </select>
         &nbsp;&nbsp;<?php echo $this->lang->line('alarm_mail_to_list'); ?>
        <div class="input-prepend">
            <span class="add-on">@</span>
            <input type="text" id="send_mail_to_list"  class="input-xlarge" placeholder="<?php echo $this->lang->line('many_people_separation'); ?>" name="send_mail_to_list" value="<?php echo $record['send_mail_to_list']; ?>" >
        </div>
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for=""><?php echo $this->lang->line('send_sms'); ?></label>
    <div class="controls">
        <select name="send_sms" id="send_sms" class="input-small">
         <option value="1"  <?php echo set_selected(1,$record['send_sms']) ?>><?php echo $this->lang->line('on'); ?></option>
         <option value="0"  <?php echo set_selected(0,$record['send_sms']) ?>><?php echo $this->lang->line('off'); ?></option>
        </select>
         &nbsp;&nbsp;<?php echo $this->lang->line('alarm_sms_to_list'); ?>
        <div class="input-prepend">
            <span class="add-on">@</span>
            <input type="text" id="send_sms_to_list"  class="input-xlarge" placeholder="<?php echo $this->lang->line('many_people_separation'); ?>" name="send_sms_to_list" value="<?php echo $record['send_sms_to_list']; ?>" >
        </div>
    </div>
   </div>


    <div class="control-group">
        <label class="control-label" for=""><?php echo $this->lang->line('processes'); ?> <?php echo $this->lang->line('alarm'); ?></label>
        <div class="controls">
            <select name="alarm_processes" id="alarm_processes" class="input-small">
                <option value="1" <?php echo set_selected(1,$record['alarm_processes']) ?> ><?php echo $this->lang->line('on'); ?></option>
                <option value="0" <?php echo set_selected(0,$record['alarm_processes']) ?> ><?php echo $this->lang->line('off'); ?></option>
            </select>
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_warning'); ?>&nbsp;<input type="text" id="threshold_warning_processes" class="input-small" placeholder="" name="threshold_warning_processes" value="<?php echo $record['threshold_warning_processes']; ?>" >
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_critical'); ?>&nbsp;<input type="text" id="threshold_critical_processes" class="input-small" placeholder="" name="threshold_critical_processes" value="<?php echo $record['threshold_critical_processes']; ?>" >
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for=""><?php echo $this->lang->line('processes_running'); ?> <?php echo $this->lang->line('alarm'); ?></label>
        <div class="controls">
            <select name="alarm_processes_running" id="alarm_processes_running" class="input-small">
                <option value="1" <?php echo set_selected(1,$record['alarm_processes_running']) ?> ><?php echo $this->lang->line('on'); ?></option>
                <option value="0" <?php echo set_selected(0,$record['alarm_processes_running']) ?> ><?php echo $this->lang->line('off'); ?></option>
            </select>
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_warning'); ?>&nbsp;<input type="text" id="threshold_warning_processes_running" class="input-small" placeholder="" name="threshold_warning_processes_running" value="<?php echo $record['threshold_warning_processes_running']; ?>" >
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_critical'); ?>&nbsp;<input type="text" id="threshold_critical_processes_running" class="input-small" placeholder="" name="threshold_critical_processes_running" value="<?php echo $record['threshold_critical_processes_running']; ?>" >
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for=""><?php echo $this->lang->line('processes_waits'); ?> <?php echo $this->lang->line('alarm'); ?></label>
        <div class="controls">
            <select name="alarm_processes_waits" id="alarm_processes_waits" class="input-small">
                <option value="1" <?php echo set_selected(1,$record['alarm_processes_waits']) ?> ><?php echo $this->lang->line('on'); ?></option>
                <option value="0" <?php echo set_selected(0,$record['alarm_processes_waits']) ?> ><?php echo $this->lang->line('off'); ?></option>
            </select>
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_warning'); ?>&nbsp;<input type="text" id="threshold_warning_processes_waits" class="input-small" placeholder="" name="threshold_warning_processes_waits" value="<?php echo $record['threshold_warning_processes_waits']; ?>" >
            &nbsp;&nbsp;<?php echo $this->lang->line('threshold_critical'); ?>&nbsp;<input type="text" id="threshold_critical_processes_waits" class="input-small" placeholder="" name="threshold_critical_processes_waits" value="<?php echo $record['threshold_critical_processes_waits']; ?>" >
        </div>
    </div>


</div>


</form>

