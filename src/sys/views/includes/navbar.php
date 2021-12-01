<nav class="navbar navbar-expand-lg justify-content-center navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">
      <img src="assets/img/logo.svg" alt="" height="28">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if ($this->getTemplate() == "home") echo "active"; ?>" aria-current="page"
            href="./"><?php echo lang("home"); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($this->getTemplate() == "animes") echo "active"; ?>" aria-current="page"
            href="./animes"><?php echo lang("animes"); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($this->getTemplate() == "mangas") echo "active"; ?>" aria-current="page"
            href="./mangas"><?php echo lang("mangas"); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($this->getTemplate() == "about") echo "active"; ?>" aria-current="page"
            href="./about"><?php echo lang("about_us"); ?></a>
        </li>
      </ul>
      <ul class="navbar-nav me-auto">
        <li class="nav-item dropdown">
          <div class="input-group mx-auto form-inline">
            <span class="input-group-text">
              <i class="fas fa-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" id="search-bar-input" />
          </div>
          <ul class="dropdown-menu dropdown-menu-lg-end" id="search-bar-dropdown">
            <li>
              <h6 class="dropdown-header"><?php echo lang("search_results"); ?></h6>
            </li>
            <li id="search-bar-no-results"><span class="dropdown-item"><?php echo lang("no_results"); ?></span></li>
            <div id="search-bar-results">
            </div>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if ($this->existAssign('logged') && $this->getAssign('logged') == true) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <?php echo $this->getAssign('account')->getUsername(); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./logout">Logout</a></li>
          </ul>
        </li>
        <?php } else { ?>
        <a class="btn btn-green" href="./login"><i class="fas fa-user"></i> <?php echo lang("login"); ?></a>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>