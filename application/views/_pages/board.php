
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
				<div class="card text-center">
				  <div class="card-header">
						<img src="../assets/img/postit_113x113.png" alt="Postit User Avatar" class="img-thumbnail" style="width: 100px; height: 100px;border-radius:50%;">
						<h5 class="blog-title">
		        	<? echo $viewed_blogger_data[0]['first_name'] . " " . $viewed_blogger_data[0]['last_name']; ?>
		        </h5>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">
							<p class="lead blog-description">
			        	<? echo $viewed_blogger_data[0]['tagline']; ?>
			        </p>
						</h4>
				    <p class="card-text">
							<ul class="list-unstyled text-center">
								<li>
									<div class="btn-group" role="group" aria-label="Social Media Links">
										<a href="<? echo $viewed_blogger_data[0]['facebook_url']; ?>" class="btn btn-sm btn-outline-primary" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a>
										<a href="<? echo $viewed_blogger_data[0]['instagram_url']; ?>" class="btn btn-sm btn-outline-primary" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a>
										<a href="<? echo $viewed_blogger_data[0]['twitter_url']; ?>" class="btn btn-sm btn-outline-primary" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
									</div>
								</li>
							</ul>
						</p>
				  </div>
				  <div class="card-footer">
						<ul class="list-unstyled text-center">
            <? if($isLoggedIn): ?>
             <? if('@'.$currUser!=$viewed_blogger_data[0]['uname']): ?>
							 <li>
								 <div class="btn-group uol" role="group" aria-label="User Operation Links">
									 <a href="<? echo $viewed_blogger_data[0]['facebook_url']; ?>" class="btn btn-sm btn-outline-default" target="_blank"><i class="fa fa-user-plus" aria-hidden="true"></i>Send Buddy Request</a>
									 <a href="<? echo $viewed_blogger_data[0]['instagram_url']; ?>" class="btn btn-sm btn-outline-default" target="_blank"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>Send Open Letter</a>
								 </div>
							 </li>
					 		<? else: ?>
								<li>
									<div class="btn-group user-stats" role="group" aria-label="User Stats">
 									 <a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-handshake-o" aria-hidden="true"></i>0</a>
									 <a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-heart-o" aria-hidden="true"></i>
										 <? echo number_format($user_likes_count); ?>
									 </a>
 									 <a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><? echo number_format(count($user_post_count)); ?></a>
 								 </div>
							 </li>
               <? endif; ?>
						 <? endif; ?>
 					 </ul>
				  </div>
				</div>
      </div>
    </div>
    <div class="container blog-body">
      <div class="row">
        <div class="col-sm-12 blog-main">
          <? if(!empty($posts_data[0]['post_warning'])): ?>
          	<? echo $posts_data[0]['post_warning']; ?>
          <? else: ?>
          		<? $counter = 0; ?>
          	<? foreach($posts_data as $row): ?>

          	  <div class="blog-post">
          	  		<div class="float-right">
          	  			<div class="menu">
          	  				<a href="#!" onclick="specifyPost(<?php echo $posts_data[0]['user_id'] . "," . $row['id'] ?>)" class="blog-post-menu" data-toggle="modal" data-target="#operations-modal">
          	  					<i class="fa fa-angle-down" aria-hidden="true"></i>
          	  				</a>
          	  			</div> <!-- ./dropdown -->
          	  		</div> <!-- ./float-right -->
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
      </div><!-- /.row -->
    </div><!-- /.container -->

		<div id="snackbar">We cannot post a unfilled adventure.</div>
		<div id="snackbar-success">Success! I'm about to reload the page in a bit.</div>
