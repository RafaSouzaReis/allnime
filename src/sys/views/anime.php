<?php $this->includes('navbar'); ?>
<div class="anime-container anime-fadebottom">
  <img class="anime-poster" src="<?php echo $this->getAssign('anime')->getPicture(); ?>"
    alt="Capa <?php echo $this->getAssign('anime')->getName(); ?>">
  <div class="anime-contents">
    <h1 class="anime-title"><?php echo $this->getAssign('anime')->getName(); ?></h1>
    <div class="anime-icons">
      <div class="outline">
        <?php
        switch ($this->getAssign('anime')->getAgeGroup()) {
          case 0:
            echo "P";
            break;
          case 1:
            echo "PG";
            break;
          case 2:
            echo "R";
            break;
          case 3:
            echo "R18";
            break;
        }
        ?></div>
      <?php foreach ($this->getAssign('genres') as $result) { ?>
      <div class="fill"><?php echo $result->getFullName(); ?></div>
      <?php } ?>
    </div>
    <div class="anime-tags"></div>
    <div class="anime-description"><?php echo $this->getAssign('anime')->getDescription(); ?></div>
    <?php if ($this->existAssign('logged') && $this->getAssign('logged') == true) { ?>
    <div class="anime-buttons">
      <?php if ($this->getAssign('alreadyWatched') == false) { ?>
      <form method="post" style="display: inline-block;">
        <input type="hidden" name="watchLater" id="watchLater"
          value="<?php if ($this->getAssign('watchLater')) echo '0'; else echo '1'; ?>" />
        <button type="submit" class="anime-button <?php if ($this->getAssign('watchLater')) echo 'active'; ?>">
          <i
            class="<?php if ($this->getAssign('watchLater')) echo 'fas'; else echo 'far'; ?> fa-clock"></i>&nbsp;<?php echo lang("watch_later"); ?>
        </button>
      </form>
      <?php } ?>
      <form method="post" style="display: inline-block;">
        <input type="hidden" name="alreadyWatched" id="alreadyWatched"
          value="<?php if ($this->getAssign('alreadyWatched')) echo '0'; else echo '1'; ?>" />
        <button type="submit" class="anime-button <?php if ($this->getAssign('alreadyWatched')) echo 'active'; ?>">
          <i
            class="<?php if ($this->getAssign('alreadyWatched')) echo 'fas'; else echo 'far'; ?> fa-check-circle"></i>&nbsp;<?php echo lang("already_watched"); ?>
        </button>
      </form>
    </div>
    <?php } ?>
  </div>
</div>
<div class="bg-black">
  <?php $this->includes('similar'); ?>
  <?php $this->includes('recommended'); ?>
</div>