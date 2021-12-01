<?php if ($this->existAssign('watchAgain')) { ?>
<div class="poster-row">
  <h2><?php echo lang("watch_again"); ?></h2>
  <div class="row-posters" id="watchAgain-list">
    <button class="row-btn" onClick="turnLeft('watchAgain-list')"><span><i class="fas fa-chevron-left"></i></span></button>
    <?php foreach ($this->getAssign('watchAgain') as $result) { ?>
    <a class="row-poster" href="<?php if ($result->isAnime()) echo 'anime'; else echo 'manga'; ?>?id=<?php echo $result->getId(); ?>">
      <img src="<?php echo $result->getPicture(); ?>" alt="Capa <?php echo $result->getName(); ?>" loading="lazy">
    </a>
    <?php } ?>
    <button class="row-btn row-btn-right" onClick="turnRight('watchAgain-list')"><span><i
          class="fas fa-chevron-right"></i></span></button>
  </div>
</div>
<?php } ?>