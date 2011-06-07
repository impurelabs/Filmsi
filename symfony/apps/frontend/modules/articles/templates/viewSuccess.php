<h2>Camera secreta</h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@articles');?>" class="black-link">Camera secreta</a> &raquo;
	<a href="<?php echo url_for('@articles');?><?php echo isset($currentCategory) ? '?c=' . $currentCategory->getId() : '';?>" class="black-link"><?php echo isset($currentCategory) ? $currentCategory->getName() . ' &raquo;' : '';?></a>
	<?php echo $article->getName();?>
</div>

<div class="cell-container6"> <!-- left column start -->
	<div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h4>Camera <span class="black">secreta</span></h4>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
				<?php foreach($categories as $category):?>
					<li <?php if(isset($currentCategory) && $currentCategory->getId() == $category->getId()) echo 'class="active"';?> onclick="location.href='<?php echo isset($currentCategory) && $currentCategory->getId() == $category->getId() ? url_for('@articles') : url_for('@articles') . '?c=' . $category->getId();?>'">
						<?php echo $category->getName();?>
						<span class="filter-cioc"></span>
					</li>
				<?php endforeach;?>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

	<div class="cell spacer-bottom">
		<div class="cell-hd">
			<p class="explanation-xs"><?php echo format_date($article->getPublishDate(), 'D', 'ro');?></p>
			<div class="cell-separator-dotted-bottom innerspacer-bottom-s">
				<a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="bigblue-link"><?php echo $article->getName();?></a>
			</div>

			<div class="inline-block spacer-bottom innerspacer-top-s spacer-right innerspacer-right cell-separator-dotted-right">
				<span class="explanation-xs">Autor: </span><a class="xs-link" href="<?php echo url_for('@articles?u=' . $article->getAuthor()->getId());?>"><?php echo $article->getAuthor()->getName();?></a>
			</div>

			<span class="explanation-xs">Categorii:
				<?php foreach ($article->getCategory() as $articleCategory):?>
					<a href="<?php echo url_for('@articles');?>?c=<?php echo $articleCategory->getId();?>" class="xs-link"><?php echo $articleCategory->getName();?></a>,
				<?php endforeach;?></span>
		</div>
		

		<div class="cell-bd" style="padding: 7px;">
			<?php if ($article->getFilenameIsTall()):?>
				<div class="right spacer-left"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>"><img src="<?php echo filmsiArticlePhotoThumb($article->getFilename());?>" /></a></div>
			<?php else: ?>
				<div class="align-center spacer-bottom-s"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>"><img src="<?php echo filmsiArticlePhotoThumb($article->getFilename());?>" /></a></div>
			<?php endif;?>

			
			<div class="innerspacer-bottom spacer-bottom tinyMce">
				<?php echo $sf_data->getRaw('article')->getContentContent();?>

			</div>

			<div>
				<?php foreach ($article->getPerson() as $articlePerson): ?>
					<a href="<?php echo url_for('@person?id=' . $articlePerson->getId() . '&key=' . $articlePerson->getUrlKey());?>"
					   class="xs-link"><?php echo $articlePerson->getName();?></a>,
				<?php endforeach;?>
				<?php foreach ($article->getFilm() as $articleFilm): ?>
					<a href="<?php echo url_for('@film?id=' . $articleFilm->getId() . '&key=' . $articleFilm->getUrlKey());?>"
					   class="xs-link"><?php echo $articleFilm->getNameRo();?></a>,
				<?php endforeach;?>
				<?php foreach ($article->getCinema() as $articleCinema): ?>
					<a href="<?php echo url_for('@cinema?id=' . $articleCinema->getId() . '&key=' . $articleCinema->getUrlKey());?>"
					   class="xs-link"><?php echo $articleCinema->getName();?></a>,
				<?php endforeach;?>
				<?php foreach ($article->getFestivalEdition() as $articleFestivalEdition): ?>
					<a href="<?php echo url_for('@festivaledition?id=' . $articleFestivalEdition->getId() . '&key=' . $articleFestivalEdition->getUrlKey());?>"
					   class="xs-link"><?php echo $articleFestivalEdition->getName();?></a>,
				<?php endforeach;?>
			</div>

			<div class="clear"></div>

			<div class="cell-separator-dotted-top innerspacer-top spacer-top">
				<span class="st_email" st_title="<?php echo urlencode($article->getName());?>" ></span>
				<span class="st_facebook" st_title="<?php echo urlencode('testare mare');?>"></span>
				<span class="st_twitter" st_title="<?php echo urlencode($article->getName());?>"></span>
				<div class="inline-block"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>#comments"><?php echo $article->getCountComments();?> comentarii</a></div>
			</div>
		</div>
	</div> <!-- article item -->
	
	<div class="cell spacer-bottom">
      <div class="cell-hd">
        <h4>Filmsi <span class="black">a gasit pentru tine</span></h4>
      </div>
      <div class="cell-bd"> 
		<?php foreach($relatedArticles as $relatedArticle):?>
                    <?php if ($relatedArticle->getId() != $article->getId()):?>
			<a href="<?php echo url_for('@article?id=' . $relatedArticle->getId() . '&key=' . $relatedArticle->getUrlKey());?>" class="important-link"><?php echo $relatedArticle->getName();?></a><br /><br />
                    <?php endif; ?>
		<?php endforeach;?>
      </div>
    </div>



	<?php include_partial('comments/formAndList', array(
		'form' => $commentForm,
		'comments' => $comments,
		'action' => url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey())
	));?>

	
	
</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::ARTICLE));?>
</div> <!-- right column end -->