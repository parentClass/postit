
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
							<? $isRequester=0; ?>
							<? foreach($buddy_requests as $row): ?>
							 <? if($row['requester'] == $viewed_blogger_data[0]['uname']): ?>
								 <? $isRequester += 1; ?>
							 <? else: ?>
								 <? $isRequester += 0; ?>
							 <? endif;?>
							<? endforeach;?>

             <? if('@'.$currUser!=$viewed_blogger_data[0]['uname']): ?>
							 <li>
								 <div class="btn-group uol" role="group" aria-label="User Operation Links">
									 <? if($isRequester>=1 && $isBuddy != 1): ?>
									 <a href="#!" onclick="acceptBuddy(<? echo $logged_blogger_data[0]['user_id'] . "," . $viewed_blogger_data[0]['user_id']?>)" class="btn btn-sm btn-outline-default btn-accept-<? echo $row['requester_uid'];?>">
										 <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
										 Accept Buddy Request
									 </a>
								 <? elseif(empty($buddy_status) && $isBuddy != 1): ?>
											<a href="#!" onclick="sendBuddyRequest(<? echo $logged_blogger_data[0]['user_id'] . "," . $viewed_blogger_data[0]['user_id']?>)" class="btn btn-sm btn-outline-default btn-buddy">
												<i class="fa fa-user-plus" aria-hidden="true"></i>
												Send Buddy Request
											</a>
										<? elseif(!empty($buddy_status) && $isBuddy != 1): ?>
												<a href="#!" onclick="specifyBuddy(<? echo $logged_blogger_data[0]['user_id'] . "," . $viewed_blogger_data[0]['user_id']?>)" class="btn btn-sm btn-outline-default btn-buddy" data-toggle="modal" data-target="#cancel-buddy-modal">
												 <i class="fa fa-check" aria-hidden="true"></i>
												 Buddy Request Sent
											 </a>
										<? elseif($isBuddy==1): ?>
	 										<a href="#!" onclick="specifyBuddy(<? echo $logged_blogger_data[0]['user_id'] . "," . $viewed_blogger_data[0]['user_id']?>)" class="btn btn-sm btn-outline-default btn-buddy" data-toggle="modal" data-target="#remove-buddy-modal">
	 											 <i class="fa fa-times" aria-hidden="true"></i>
	 											 Buddy
	 										</a>
										<? endif; ?>
									 <a href="#!" onclick="" class="btn btn-sm btn-outline-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>Send Open Letter</a>
								 </div>
							 </li>
               <? endif; ?>
						 <? endif; ?>
						 <li>
							 <div class="btn-group user-stats" role="group" aria-label="User Stats">
								<a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-handshake-o" aria-hidden="true"></i>
									<? echo number_format($user_buddy_count); ?>
								</a>
								<a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-heart-o" aria-hidden="true"></i>
									<? echo number_format($user_likes_count); ?>
								</a>
								<a class="btn btn-sm btn-outline-default disabled"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>
									<? echo number_format(count($user_post_count)); ?>
								</a>
							</div>
						</li>
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
		<div id="snackbar-danger">Failed! I encountered a problem doing the request.</div>
