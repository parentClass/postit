
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
          		<div class="dropdown-divider"></div>
          			<a href="#!" class="dropdown-item" data-toggle="modal" data-target="#createPostModal">
          				<i class="fa fa-bandcamp" aria-hidden="true"></i>
          				New Post
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
    <div class="blog-header">
      <div class="container">
      	<? if($this->session->flashdata('success_msg')): ?>
      		<div class="alert alert-success" role="alert">
      			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
      			</button>
      			<strong>
      				<? echo $this->session->flashdata('success_msg'); ?>
      			</strong>
      		</div>
      	<? elseif($logged_blogger_data[0]['isNew']==1 && $this->session->flashdata('error_post')): ?>
      		<div class="alert alert-danger" role="alert">
      			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
      			</button>
      			<strong>
      				<? echo $this->session->flashdata('error_post'); ?>
      			</strong>
      		</div>
      	<? endif; ?>
        <h5 class="blog-title">
        	<? echo $viewed_blogger_data[0]['first_name'] . " " . $viewed_blogger_data[0]['last_name']; ?>
        </h5>
        <p class="lead blog-description">
        	<? echo $viewed_blogger_data[0]['tagline']; ?>
        </p>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
          <? if(!empty($posts_data[0]['post_warning'])): ?>
          	<? echo $posts_data[0]['post_warning']; ?>
          <? else: ?>
          		<? $counter = 0; ?>
          	<? foreach($posts_data as $row): ?>

          	  <div class="blog-post">
          	  	<? if('@'.$currUser==$viewed_blogger_data[0]['uname']): ?>
          	  		<div class="float-right">
          	  			<div class="dropdown">
          	  				<a href="#!" class="dropdown-toggle blog-post-menu" id="dropdownMenuLink"
          	  						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	  					<i class="fa fa-angle-down" aria-hidden="true"></i>
          	  				</a>
          	  				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          	  					<a href="#!" class="dropdown-item" onclick="firstStepUpdatePost(<? echo $posts_data[0]['user_id'] . "," . $row['id'] ?>)">
          	  						<i class="fa fa-pencil" aria-hidden="true"></i>
          	  						 Update Post
          	  					</a>
          	  					<a href="../blog/deletePost/<? echo $posts_data[0]['user_id'] . "/" . $row['id'] ?>" class="dropdown-item">
          	  						<i class="fa fa-scissors" aria-hidden="true"></i>
          	  						 Delete Post
          	  					</a>
          	  				</div>
          	  			</div> <!-- ./dropdown -->
          	  		</div> <!-- ./float-right -->
          	  	<? endif; ?>
          	  		<h2 class="blog-post-title">
          	  			<? echo $row['post_title']; ?>
          	  		</h2>
          	  		<p class="blog-post-meta">
          	  			<small>
          	  				<? echo date('M j Y g:i A', strtotime($row['post_date'])); ?> by <? echo $viewed_blogger_data[0]['uname']; ?>
          	  			</small><br/>
          	  			<? for($i=0; $i<count($posts_data[$counter]['post_tags']); $i++): ?>
							<span class="badge badge-<? echo strtolower($posts_data[$counter]['post_tags'][$i]['tag_name']);  ?>">
	          	  				<? echo stripcslashes($posts_data[$counter]['post_tags'][$i]['tag_emoji']) . " " . $posts_data[$counter]['post_tags'][$i]['tag_name']; ?>
		          	  		</span>
          	  			<? endfor; ?>
      	  				<? $counter++; ?>
          	  		</p>
          	  		<p>
          	  			<? echo $row['post_body']; ?>
	          	  		<div class="blog-menu-items float-right">
	          	  			<a href="#!" class="blog-post-menu">
	          	  				<i class="fa fa-heart-o" aria-hidden="true"></i>
	          	  			</a>
	          	  			<span class="text-muted">
	          	  				<? echo number_format($row['post_likes']); ?>
	          	  			</span>
	          	  		</div>
          	  		</p>
          	  	 </div><!-- ./blog-post -->
          	<? endforeach; ?>
          <? endif; ?>
        </div><!-- /.blog-main -->
        <div class="col-sm-3 offset-sm-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>For all the visitors and readers. How are you today?</p>
          </div>
          <? if($isLoggedIn): ?>
          	<? if('@'.$currUser==$viewed_blogger_data[0]['uname']): ?>
          		<div class="sidebar-module">
          			<h4>Navigations</h4>
          			<ol class="list-unstyled">
          				<li>
          					<a href="#!">
          						<i class="fa fa-handshake-o" aria-hidden="true"></i>
          						Buddy Request
          						<span class="badge badge-default">2</span>
          					</a>
          				</li>
          				<li>
          					<a href="#!">
          						<i class="fa fa-envelope-open-o" aria-hidden="true"></i>
          						Open Letters
          						<span class="badge badge-default">3</span>
          					</a>
          				</li>
          				<li>
          					<a href="#!">
          						<i class="fa fa-bell-o" aria-hidden="true"></i>
          						Notifications
          						<span class="badge badge-default">5</span>
          					</a>
          				</li>
          			</ol>
          		</div>
          	<? endif; ?>
      	  <? endif;?>
          <div class="sidebar-module">
            <h4>Social Media</h4>
            <ol class="list-unstyled">
              <li><a href="<? echo $viewed_blogger_data[0]['facebook_url']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
              <li><a href="<? echo $viewed_blogger_data[0]['twitter_url']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
              <li><a href="<? echo $viewed_blogger_data[0]['instagram_url']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a></li>
            </ol>
          </div>
          <div class="sidebar-module sidebar-module-inset">
            <h4>Postcards</h4>
            <p>For all the visitors and readers. How are you today?</p>
          </div>
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div><!-- /.container -->
