<div id="mainNavigation">
      <?php $session = session(); ?>
      <!-- <nav role="navigation">
        <div class="py-3 text-center border-bottom">
          <div class="site-logo-container">
               <img src="<?php echo base_url('public/images/WhiteNewSIRlogo.png') ?>" alt="Social Impact Register" class="invert">
          </div>
          
        </div>
      </nav> -->
      <div class="navbar-expand-md">
        <div class="navbar-dark  text-center my-2">
          <button class="navbar-toggler w-75" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <span class="align-middle">Menu</span>
          </button>
        </div>
        <div class="text-center mt-3 collapse   navbar-collapse" id="navbarNavDropdown">
            <div class="text-start">
              <div class="site-logo-container">
                  <img src="<?php echo base_url('public/images/swirlwhite.png') ?>" alt="Social Impact Register" class="invert">
              </div>
              
            </div>
          <ul class="navbar-nav mx-auto ">
            <!-- <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo base_url("/")?>">Home</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo base_url("/catalogue")?>">Catalogue</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Join US</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo base_url("/vcse-join")?>">CSE</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("/business-membership")?>">Business</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("/enablers")?>">Buyer</a></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="https://pluggin.org/login/" target="_blank">Ecosystem</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://pluggin.org/contact/" target="_blank">Contact Us</a>
            </li>
            <?php if (session()->get('loggedIn')) :?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url("/logout")?>">Logout</a>
                </li>
                <?php if (session()->get('isAdmin')) :?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("/admin")?>">Admin</a>
                  </li>
                <?php else:?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/profile')?>">Profile</a>
                  </li>
                <?php endif; ?>
            <?php else:?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url("/login")?>">Login</a>
              </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
</div>
