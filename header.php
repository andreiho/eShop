<header id="header">
  <div class="header_top">
    <div class="container">
      <?php if($general->userLoggedIn()) { ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="brand">
            <ul class="nav nav-pills">
              <li><a href="/views/users/home.php">eShop for Customers</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="user-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="/views/users/home.php">hello, <b><?php echo $user['user_name'];?></b></a></li>
              <li><a href="/logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } else if($general->vendorLoggedIn()) { ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="brand">
            <ul class="nav nav-pills">
              <li><a href="/views/vendors/home.php">eShop for Partners</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="user-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="/views/vendors/home.php">hello, <b><?php echo $vendor['vendor_name'];?></b></a></li>
              <li><a href="/logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } else if($general->adminLoggedIn()) { ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="brand">
            <ul class="nav nav-pills">
              <li><a href="/admin/home.php">eShop admin panel</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="user-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="/admin/home.php">hello, <b>admin</b></a></li>
              <li><a href="/logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="brand">
            <ul class="nav nav-pills">
              <li><a href="/">welcome to eShop</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="user-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="/views/users/get-started.php">are you a <b>customer</b>?</a></li>
              <li><a href="/views/vendors/login.php">are you a <b>partner</b>?</a></li>
              <li><a href="/admin">are you <b>admin</b>?</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="logo pull-left">
            <a href="/">E-SHOP</a>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="/">Products</a></li>
              <li><a href="/partners.php">Partners</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <form action="/search.php" method="get" id="searchForm">
              <div class="input-group input-group-sm search">
                  <input type="text" class="form-control" placeholder="Search" name="q">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>