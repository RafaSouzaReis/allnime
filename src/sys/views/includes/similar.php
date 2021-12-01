<?php if ($this->existAssign('similar')) { ?>
<div class="poster-row">
  <h2><?php echo lang("similar"); ?></h2>
  <div class="row-posters" id="similar-list">
    <button class="row-btn" onClick="turnLeft('similar-list')"><span><i class="fas fa-chevron-left"></i></span></button>
    <?php foreach ($this->getAssign('similar') as $result) { ?>
    <a class="row-poster" href="<?php if ($result->isAnime()) echo 'anime'; else echo 'manga'; ?>?id=<?php echo $result->getId(); ?>">
      <img src="<?php echo $result->getPicture(); ?>" alt="Capa <?php echo $result->getName(); ?>">
    </a>
    <?php } ?>
    <button class="row-btn row-btn-right" onClick="turnRight('similar-list')"><span><i
          class="fas fa-chevron-right"></i></span></button>
  </div>
</div>
<?php } ?>