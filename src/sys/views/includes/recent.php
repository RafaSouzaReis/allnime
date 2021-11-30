<?php if ($this->existAssign('recent')) { ?>
<div class="poster-row">
  <h2><?php echo lang("recent"); ?></h2>
  <div class="row-posters" id="recent-list">
    <button class="row-btn" onClick="turnLeft('recent-list')"><span><i class="fas fa-chevron-left"></i></span></button>
    <?php foreach ($this->getAssign('recent') as $result) { ?>
    <a class="row-poster" href="anime?id=<?php echo $result->getId(); ?>">
      <img src="<?php echo $result->getPicture(); ?>" alt="Capa <?php echo $result->getName(); ?>">
    </a>
    <?php } ?>
    <button class="row-btn row-btn-right" onClick="turnRight('recent-list')"><span><i
          class="fas fa-chevron-right"></i></span></button>
  </div>
</div>
<?php } ?>