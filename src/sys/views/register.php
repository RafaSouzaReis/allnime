<div class="container d-table h-100 login-container">
  <div class="d-table-cell align-middle">
    <div>
      <a class="btn text-white" href="./"><i class="fas fa-arrow-left fa-2x"></i></a>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-7 col-lg-7">
        <div style="position: relative; height: 100%;">
          <div
            style="margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
            <div class="brand text-center mb-3">
              <a href="./">
                <img src="assets/img/logo.svg" alt="Logo" height="50" loading="lazy" />
              </a>
            </div>
            <h4>
              <h4><?php echo lang("slogan"); ?></h4>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-5 col-lg-5 d-table">
        <div class="login-card">
          <div class="card-body text-center">
            <?php if ($this->getAssign('showBubble')) { ?>
            <div class="info-bubble show <?php echo $this->getAssign('bubbleType'); ?>" role="alert">
              <?php echo $this->getAssign('bubbleContent'); ?></div>
            <?php } ?>
            <?php if ($this->getAssign('showForm')) { ?>
            <h3 class="card-title" style="margin-bottom: 20px;"><?php echo lang("register"); ?></h3>
            <form data-form-type="register" action="./register" method="post">
              <div class="mb-3">
                <input class="form-control" type="username" name="username"
                  placeholder="<?php echo lang("username"); ?>" autoComplete="current-username"
                  data-form-type="username" pattern="^[a-zA-Z0-9]([._-](?![._-])|[a-zA-Z0-9]){3,18}[a-zA-Z0-9]$" required />
              </div>
              <div class="mb-3">
                <input class="form-control" type="email" name="email" aria-describedby="emailHelp" placeholder="E-mail"
                  autoComplete="email" data-form-type="email" required />
              </div>
              <div class="mb-3">
                <input class="form-control" type="password" name="password" autoComplete="current-password"
                  data-form-type="password" placeholder="<?php echo lang("password"); ?>" required />
              </div>
              <button class="btn btn-block btn-green my-1 w-100" type="submit">
                <?php echo lang("signin"); ?>
              </button>
            </form>
            <a href="./forgot-password" class="btn btn-block my-1 w-100 btn-lighter">
              <?php echo lang("forgot_password"); ?>
            </a>
            <?php } ?>
            <hr />
            <a href="./login" class="btn btn-darkgrey btn-block w-100">
              Login
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>