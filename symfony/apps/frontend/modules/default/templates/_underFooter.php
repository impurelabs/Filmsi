<div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">La cinema</p>
		<?php foreach($filmsNowInCinema as $filmNowInCinema):?>
			<a href="<?php echo url_for('@film?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>"><?php echo $filmNowInCinema->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">In curand la cinema</p>
		<?php foreach($filmsSoonInCinema as $filmSoonInCinema):?>
			<a href="<?php echo url_for('@film?id=' . $filmSoonInCinema->getId() . '&key=' . $filmSoonInCinema->getUrlKey());?>"><?php echo $filmSoonInCinema->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">Pe DVD & Bluray</p>
		<?php foreach($filmsNowDbo as $filmNowDbo):?>
			<a href="<?php echo url_for('@film?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>"><?php echo $filmNowDbo->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">In curand pe DVD & Bluray</p>
		<?php foreach($filmsSoonDbo as $filmSoonDbo):?>
			<a href="<?php echo url_for('@film?id=' . $filmSoonDbo->getId() . '&key=' . $filmSoonDbo->getUrlKey());?>"><?php echo $filmSoonDbo->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">La Tv Azi</p>
		<?php foreach($filmsNowTv as $filmNowTv):?>
			<a href="<?php echo url_for('@film?id=' . $filmNowTv->getId() . '&key=' . $filmNowTv->getUrlKey());?>"><?php echo $filmNowTv->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">La Tv Maine</p>
		<?php foreach($filmsTomorrowTv as $filmTomorrowTv):?>
			<a href="<?php echo url_for('@film?id=' . $filmTomorrowTv->getId() . '&key=' . $filmTomorrowTv->getUrlKey());?>"><?php echo $filmTomorrowTv->getNameRo();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">Actori</p>
		<?php foreach($actors as $actor):?>
			<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>"><?php echo $actor->getName();?></a><br />
		<?php endforeach;?>
	</div>
	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px; vertical-align: top">
		<p class="bigstrong spacer-bottom">Stiri</p>
		<?php foreach($stires as $stire):?>
			<a href="<?php echo url_for('@person?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>"><?php echo $stire->getName();?></a><br />
		<?php endforeach;?>
	</div>

</div>