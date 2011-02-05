id,Cod IMDB,Nume,In productie,In cinema,Pe DVD,Pe Bluray,Online,Tv
<?php foreach($films as $film): ?>
"<?php echo $film->getId();?>","<?php echo $film->getImdb();?>","<?php echo $film->getName();?>","<?php echo $film->getStatusInProduction() ? 'da' : 'nu'; ?>","<?php echo filmsiStatusCinemaExplained($film); ?>","<?php echo filmsiStatusDvdExplained($film); ?>","<?php echo filmsiStatusBlurayExplained($film); ?>","<?php echo filmsiStatusOnlineExplained($film); ?>","<?php echo filmsiStatusTvExplained($film); ?>"
<?php endforeach ?>