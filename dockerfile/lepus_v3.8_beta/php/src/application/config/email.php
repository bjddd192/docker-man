<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['mailtype'] = 'html';
$config['protocol'] = 'smtp';
$config['smtp_host'] = getenv('SMTP_HOST');
$config['smtp_port'] = getenv('SMTP_PORT');
$config['smtp_user'] = getenv('SMTP_USER');
$config['smtp_pass'] = getenv('SMTP_PASS');
$config['smtp_timeout'] = getenv('SMTP_TIMEOUT');


/*
$config['mailtype'] = 'html';
$config['protocol'] = 'smtp';
$config['smtp_host'] = '10.1.0.175';
$config['smtp_port'] = '25';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_timeout'] = '10';
*/