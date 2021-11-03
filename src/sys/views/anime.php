<?php $this->includes('navbar'); ?>
<div class="anime-container anime-fadebottom">
  <img class="anime-poster" src="https://media.kitsu.io/anime/poster_images/3936/large.jpg" alt="macDonald">
  <div class="anime-contents">
    <h1 class="anime-title">Fullmetal Alchemist: Brotherhood</h1>
    <div class="anime-icons">
      <div><i class="fas fa-thumbs-up"></i></div>
      <div class="outline">16</div>
      <div class="fill">HD</div>
      <div class="fill">5.1</div>
    </div>
    <div class="anime-tags"></div>
    <div class="anime-description">
      O anime segue a história dos irmãos Elric, que recorrem à alquimia – tão minuciosamente estudada pelo pais dos meninos – para tentar trazer sua mãe de volta à vida. 
      Entretanto os irmãos acabam não cumprindo uma das leis fundamentais da alquimia, a tal da TROCA EQUIVALENTE.
    </div>
    <div class="anime-buttons">
      <buttons class="anime-button"><i class="far fa-clock"></i> <?php echo lang("watch_later"); ?></butons>
    </div>
    <div class="anime-buttons">
      <buttons class="anime-button"><i class="far fa-check-circle"></i> <?php echo lang("already_watched"); ?> </butons>
    </div>
  </div>
</div>
<div class="bg-black">
  <?php $this->includes('similar'); ?>
  <?php $this->includes('recommended'); ?>
</div>