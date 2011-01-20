Salut <?php echo $user->getName();?>,<br/><br/>

Acest email iti este trimis pentru ca ai cerut sa iti schimbi parola.<br/><br/>

Pentru a-ti schimba parola trebuie sa dai click <a href="<?php echo url_for('@default_index', true);?>?unique_key=<?php echo $forgot_password->unique_key;?>">AICI</a>.

Acest link este valabil timp de 24 de ore.
