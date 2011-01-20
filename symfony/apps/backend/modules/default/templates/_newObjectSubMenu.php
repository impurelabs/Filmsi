<?php if($sf_user->hasCredential('Article')): ?>
<a href="<?php echo url_for('@default?module=articles&action=newObject');?>" <?php if ($sf_params->get('module') == 'articles') echo 'class="selected"';?>>Articole</a> |
<?php endif;?>
<?php if($sf_user->hasCredential('Stire')): ?>
<a href="<?php echo url_for('@default?module=stires&action=newObject');?>" <?php if ($sf_params->get('module') == 'stires') echo 'class="selected"';?>>Stiri</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('Person')): ?>
<a href="<?php echo url_for('@default?module=persons&action=newObject');?>" <?php if ($sf_params->get('module') == 'persons') echo 'class="selected"';?>>Persoane</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('Film')): ?>
<a href="<?php echo url_for('@default?module=films&action=newObject');?>" <?php if ($sf_params->get('module') == 'films') echo 'class="selected"';?>>Filme</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('Cinema')): ?>
<a href="<?php echo url_for('@default?module=cinemas&action=newObject');?>" <?php if ($sf_params->get('module') == 'cinemas') echo 'class="selected"';?>>Cinematografe</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('Festival')): ?>
<a href="<?php echo url_for('@default?module=festivalEditions&action=newObject');?>" <?php if ($sf_params->get('module') == 'festivalEditions') echo 'class="selected"';?>>Editii Festival</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('PhotoAlbum')): ?>
<a href="<?php echo url_for('@default?module=photos&action=newObject');?>" <?php if ($sf_params->get('module') == 'photos') echo 'class="selected"';?>>Albume Foto</a> | 
<?php endif;?>
<?php if($sf_user->hasCredential('VideoAlbum')): ?>
<a href="<?php echo url_for('@default?module=videos&action=newObject');?>" <?php if ($sf_params->get('module') == 'videos') echo 'class="selected"';?>>Albume Video</a> | 
<?php endif; ?>