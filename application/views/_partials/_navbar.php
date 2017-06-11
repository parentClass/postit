
<div class="blog-masthead">
    <div class="container">
      <nav class="nav blog-nav">
        <? if($isLoggedIn): ?>
          <li class="nav-item dropdown">
            <a href="../blog/<? echo $currUser; ?>" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <? echo "@" . $currUser; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a href="../blog/<? echo $currUser; ?>" class="dropdown-item dropdown-header" style="text-align:center;">
                <? echo $logged_blogger_data[0]['first_name'] . " " . $logged_blogger_data[0]['last_name'] ?><br/>
                View Profile
              </a>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#search-modal">
                <i class="fa fa-search" aria-hidden="true"></i>
                Search
              </a>
            <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#createPostModal">
                <i class="fa fa-bandcamp" aria-hidden="true"></i>
                New Post
              </a>
            <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#buddyRequestModal">
                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                Buddy Request
              </a>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#openLetterModal">
                <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                Open Letters
              </a>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#notifModal">
                <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                Bookmarked Post
              </a>
              <a href="#!" class="dropdown-item" data-toggle="modal" data-target="#notifModal">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
                Notifications
              </a>
            <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                Need help?
              </a>
              <a href="#!" class="dropdown-item">
                <i class="fa fa-flag" aria-hidden="true"></i>
                Send a report
              </a>
              <a href="#!" class="dropdown-item">
                <i class="fa fa-coffee" aria-hidden="true"></i>
                Support developer
              </a>
            <div class="dropdown-divider"></div>
              <a href="logout" class="dropdown-item">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Sign out
              </a>
            </div>
          </li>
          <? else: ?>
            <li class="nav-item dropdown">
              <a href="../gates" class="nav-link">Sign in!</a>
            </li>
        <? endif; ?>
      </nav>
    </div>
  </div>
