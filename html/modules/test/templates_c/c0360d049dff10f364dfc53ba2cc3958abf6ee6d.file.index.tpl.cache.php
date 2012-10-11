<?php /* Smarty version Smarty-3.0.7, created on 2011-05-31 07:38:06
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128624de49ade88c532-66003892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1306827484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128624de49ade88c532-66003892',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'C:/wamp/www/heartweb//libs/Smarty-3.0.7/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getVariable('name')->value;?>

<br>
<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>

