<a href="<?php echo url_for('@default_index?module=categories');?>" <?php if ($sf_params->get('module') == 'categories') echo 'class="selected"';?>>Categorii Articole</a> |
<a href="<?php echo url_for('@default_index?module=genres');?>" <?php if ($sf_params->get('module') == 'genres') echo 'class="selected"';?>>Genuri Film</a> |
<a href="<?php echo url_for('@default_index?module=services');?>" <?php if ($sf_params->get('module') == 'services') echo 'class="selected"';?>>Facilitati Cinema</a> |
<a href="<?php echo url_for('@default_index?module=festivals');?>" <?php if ($sf_params->get('module') == 'festivals') echo 'class="selected"';?>>Festivaluri</a> | 
<a href="<?php echo url_for('@default_index?module=boxoffice');?>" <?php if ($sf_params->get('module') == 'boxoffice') echo 'class="selected"';?>>Box Office</a> | 
<a href="<?php echo url_for('@default_index?module=content');?>" <?php if ($sf_params->get('module') == 'content') echo 'class="selected"';?>>Continut</a>