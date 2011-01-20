<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('jquery-ui-1.8.5.custom.min.js') ?>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('jquery-ui-1.8.6.custom.css');?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
  	<div class="clearfix m-2 p-2" style="border: 1px solid #d5d5d5; background-color:#fff">
    	<div class="span-4">
			<a href="<?php echo url_for('@default_index?module=default');?>"><img src="<?php echo image_path('logo.png');?>" /></a>
        </div>
        <?php if ($sf_user->isAuthenticated()):?>
		<div class="right">Logat ca: <a href="<?php echo url_for('@default_index?module=account');?>"><?php echo $sf_user->getUsername();?></a></div>
        <div class="span-20 last mb-2">
        	<a href="<?php echo url_for('@default_index?module=default');?>" <?php if ($sf_params->get('module') == 'default' && $sf_params->get('action') == 'index') echo 'class="selected"';?>>Library</a> |
            <a href="<?php echo url_for('@default?module=default&action=newObject');?>" <?php if ($sf_params->get('action') == 'newObject') echo 'class="selected"';?>>Creeaza obiect nou</a> |
            <?php if ($sf_user->hasCredential('Cms')):?>
            <a href="<?php echo url_for('@default_index?module=cms');?>" <?php if ($sf_params->get('module') == 'cms') echo 'class="selected"';?>>CMS</a> |
            <?php endif; ?>
			<?php if ($sf_user->hasCredential('Promovare')):?>
            <a href="<?php echo url_for('@default_index?module=promovare');?>" <?php if ($sf_params->get('module') == 'promovare') echo 'class="selected"';?>>Promovare</a> |
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('Shop')):?>
            <a href="<?php echo url_for('@default_index?module=shops');?>" <?php if ($sf_params->get('module') == 'shops') echo 'class="selected"';?>>Magazine</a> |
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('Status')):?>
            <a href="<?php echo url_for('@default_index?module=filmStatus');?>" <?php if ($sf_params->get('module') == 'filmStatus') echo 'class="selected"';?>>Status Filme</a> |
            <?php endif; ?>
            <?php if ($sf_user->isSuperAdmin()):?>
            <a href="<?php echo url_for('@default_index?module=users');?>" <?php if ($sf_params->get('module') == 'users') echo 'class="selected"';?>>Useri</a> |
            <?php endif;?>
            <?php if ($sf_user->hasCredential('Moderator')):?>
            <a href="<?php echo url_for('@default?module=default&action=moderate');?>" <?php if ($sf_params->get('action') == 'moderate') echo 'class="selected"';?>>Pentru aprobare</a> |
            <?php endif?>
            <a href="<?php echo url_for('@sf_guard_signout');?>">Logout</a> |
        </div>
        <?php endif; ?>
        <div class="span-20 last">
        	<?php if (has_slot('subMenu')) include_slot('subMenu')?>
        </div>
    </div>
    
    <div class="m-2 p-2" style="border: 1px solid #d5d5d5; background-color:#fff">
	    <?php echo $sf_content ?>
    </div>
  </body>
</html>
