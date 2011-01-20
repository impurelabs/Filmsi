id,Nume,Email,Username,Permisiuni,Status
<?php foreach($users as $user): ?>
"<?php echo $user->getId();?>","<?php echo $user->getName();?>","<?php echo $user->getEmailAddress();?>","<?php echo $user->getUsername(); ?>","<?php foreach ($user->getPermissions() as $permission) echo $permission->getName() . ', '; ?>","<?php echo $user->getIsActive() == true ? 'da' : 'nu'; ?>"
<?php endforeach ?>