<!--Navbar -->
<style media="screen">
  .navbar.navbar-dark .breadcrumb .nav-item.active>.nav-link,
  .navbar.navbar-dark .navbar-nav .nav-item.active>.nav-link {
    color: var(--main-color);
  }

  .dropdown .dropdown-menu .dropdown-item:hover {
    background-color: var(--main-color);
  }

  .navbar.navbar-dark .breadcrumb .nav-item .nav-link,
  .navbar.navbar-dark .navbar-nav .nav-item .nav-link {
    color: #fff;
    -webkit-transition: .35s;
    -o-transition: .35s;
    transition: .35s;
  }

  .navbar.navbar-dark .breadcrumb .nav-item .nav-link,
  .navbar.navbar-dark .navbar-nav .nav-item .nav-link:hover {
    color: var(--main-color);
    -webkit-transition: .35s;
    -o-transition: .35s;
    transition: .35s;
  }

  .navbar.navbar-dark .navbar-nav .nav-item.active>.nav-link:hover {
    color: var(--main-color);
  }

  .navbar-toggler {
    background-color: var(--main-color) !important;
  }

  a.bg-exit:focus,
  a.bg-exit:hover,
  button.bg-exit:focus,
  button.bg-exit:hover {
    background-color: var(--main-color) !important;
  }

  .navtop-color {
    background-color: #4c5256 !important;
  }

  .nav-link.rbsm:hover,
  .nav-link.lbsm:hover {
    color: rgb(173, 173, 173) !important;
  }

  .ctb,
  .rbsm,
  .lbsm {
    font-size: 15px;
  }

  .fixed-top-2 {
    margin-top: 38px;
  }

  .navbar {
    z-index: 1001;
  }

  .dropdown-menu {
    position: absolute;
    top: 73px;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: .5rem 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 0px solid rgba(0, 0, 0, .15);
    border-radius: .0rem;
  }

  #nav_top,
  #nav_menu {
    -webkit-transition: all 0.25s ease;
    -moz-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
  }

  #menutwo_nav>li.nav-item>a {
    font-size: 15px;
    font-weight: 600;
  }

  .navbar-collapse.collapse::-webkit-scrollbar {
    width: 5px;
    height: 3px;
  }

  /* Track */
  .navbar-collapse.collapse::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  /* Handle */
  .navbar-collapse.collapse::-webkit-scrollbar-thumb {
    background: #888;
  }

  /* Handle on hover */
  .navbar-collapse.collapse::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  .cpr-right {
    text-align: right;
  }

  .cpr-left {
    text-align: left;
  }

  .spaafwe {
    margin: 0px 5px 0px 5px;
  }

  .hsmall {
    display: block;
  }

  .ssmall {
    display: none;
  }

  .dark-color {
    background-color: #444 !important;
  }

  .darken-color {
    background-color: #666 !important;
  }

  @media (max-width: 575.98px) {

    .ctb,
    .rbsm,
    .lbsm {
      font-size: 5px;
    }

    .fixed-top-2 {
      margin-top: 31px;
    }

    .spaafwe {
      margin: 0px 0px 0px 0px;
    }

    .hsmall {
      display: none;
    }

    .ssmall {
      display: block;
    }
  }

  @media (max-width: 767.98px) {
    .cpr-right {
      text-align: center;
    }

    .cpr-left {
      text-align: center;
    }

  }


  @media (max-width: 991.98px) {
    .dropdown-menu {
      top: 100%;
    }

    .navbar-collapse.collapse {
      max-height: 250px;
      overflow-y: auto;
    }


  }

  @media (max-width: 1199.98px) {}
</style>
<nav class="navbar navbar-dark navtop-color z-depth-2 animated fadeIn" id="nav_top" style="padding: .2rem;">
  <div class="container">
    <!-- <div class="collapse navbar-collapse" id="basicExampleNav"> -->
    <ul class="navbar-nav nav-flex-icons w-100">

      <?php if (isset($_SESSION['id'])) { ?>
        <li class="nav-item hsmall">
          <a class="nav-link waves-effect waves-light text-white rbsm">
            <i class="fas fa-coins"></i> ????????????????????? <span id="point_nav"><?php echo number_format(get_credit(), 2); ?></span> ?????????
          </a>
        </li>
        <li class="nav-item spaafwe hsmall">
          <span class="nav-link waves-effect waves-light text-white lbsm"> | </span>
        </li>
        <li class="nav-item hsmall">
          <a href="<?php echo base_url() . "/profile/mailbox"; ?>" class="nav-link waves-effect waves-light text-white lbsm">
            <i class="fas fa-envelope"></i> ?????????????????????????????????
          </a>
        </li>
        <li class="nav-item ml-auto">
          <?php
          $q = dd_q("SELECT * FROM user_tb WHERE u_id  = ?", [$_SESSION['id']]);
          $row = $q->fetch(PDO::FETCH_ASSOC);
          ?>
          <a href="<?php echo base_url() . "/profile"; ?>" class="nav-link waves-effect waves-light text-white lbsm">
            ?????????????????????
            <?php if ($row['u_type'] == "w") { ?>
              <i class="fas fa-user-circle"></i>
            <?php } else { ?>
              <img src="<?php echo $row['u_img']; ?>" alt="profile" class="rounded-circle img-fluid ml-1" width="25px" height="25px">
            <?php } ?>
          </a>

        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/contact" class="nav-link waves-effect waves-light text-white ctb">
            ??????????????????????????? <i class="far fa-comment-dots"></i>
          </a>
        </li>

        <li class="nav-item ml-auto">
          <a href="<?php echo base_url() . "/register"; ?>" class="nav-link waves-effect waves-light text-white rbsm">
            <i class="fas fa-user-plus"></i> ?????????????????????????????????
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="<?php echo base_url() . "/login"; ?>" class="nav-link waves-effect waves-light text-white lbsm">
            <i class="fas fa-sign-in-alt"></i> ?????????????????????????????????
          </a>
        </li>
      <?php } ?>
    </ul>


    <!-- </div> -->
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark darken-color animated fadeIn" id="nav_menu">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>/">
      <img src="<?php echo base_url(); ?>/img/logo/lognav.png" class="d-inline-block align-top img-fluid pt-3 pb-3" alt="mdb logo" width="260px">
    </a>
    <button class="navbar-toggler bg-exit" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav mr-auto" id="menutwo_nav">
        <li class="nav-item mr-2">
          <a class="nav-link" href="<?php echo base_url(); ?>/">?????????????????????
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="<?php echo base_url(); ?>/csgogame">??????????????????????????????</a>
        </li>
        <li class="nav-item dropdown mr-2">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">????????????????????????</a>
          <div class="dropdown-menu dropdown-server z-depth-2" aria-labelledby="navbarDropdownMenuLink-333">
            <a class="dropdown-item" href="<?php echo base_url(); ?>/payment/gift">???????????????????????? Truewallet</a>
          </div>
        </li>
        <li class="nav-item dropdown mr-2">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-222" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">?????????????????????</a>
          <div class="dropdown-menu dropdown-server z-depth-2" aria-labelledby="navbarDropdownMenuLink-222">
            <?php
            $q = dd_q("SELECT * FROM type_tb WHERE t_type  = ?", [0]);
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <a class="dropdown-item" href="<?php echo base_url(); ?>/shop/<?php echo $row['t_id']; ?>/1"><?php echo $row['t_name']; ?></a>
            <?php } ?>
          </div>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="<?php echo base_url(); ?>/code/2/1">??????????????????????????????</a>
        </li>
        <li class="nav-item dropdown mr-2">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-444" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">????????????????????????????????????</a>
          <div class="dropdown-menu dropdown-server z-depth-2" aria-labelledby="navbarDropdownMenuLink-444">
            <?php
            $q = dd_q("SELECT * FROM cardtype_tb");
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <a class="dropdown-item" href="<?php echo base_url(); ?>/card/<?php echo $row['ct_name']; ?>"><?php echo $row['ct_displayname']; ?></a>
            <?php } ?>

          </div>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="<?php echo base_url(); ?>/contact">??????????????????</a>
        </li>

        <?php if (isset($_SESSION['id'])) { ?>
          <li class="nav-item mr-2 ssmall">
            <a class="nav-link" href="<?php echo base_url(); ?>/"><i class="fas fa-coins"></i> ????????????????????? <span id="point_nav"><?php echo number_format(get_credit(), 2); ?></span> ?????????</a>
          </li>
          <li class="nav-item mr-2 ssmall">
            <a class="nav-link" href="<?php echo base_url(); ?>/profile/mailbox"><i class="fas fa-envelope"></i> ?????????????????????????????????</a>
          </li>
          <li class="nav-item mr-2 ssmall">
            <a class="nav-link" href="<?php echo base_url(); ?>/logout"><i class="fas fa-sign-out-alt"></i> ??????????????????????????????</a>
          </li>
        <?php } ?>
      </ul>

    </div>
  </div>
</nav>
<!--/.Navbar -->