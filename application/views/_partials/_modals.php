
	<!-- Createpost Modal -->
	<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">
	        <? if($logged_blogger_data[0]['isNew']==1): ?>
	        	<? echo "Almost there!"; ?>
	           <? else: ?>
	             <? echo "How's your adventure today?"; ?>
	    	<? endif; ?>
	        </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      	<div class="modal-body">
	      		<? if($logged_blogger_data[0]['isNew']==1): ?>
	      			<div class="alert alert-success" role="alert">
	      				<small>
	      					Well done! Let's tell the world that we've arrived!
	      				</small>
	      			</div>
	      		<? else: ?>
	      			<div class="alert alert-warning" role="alert">
	      				<small>
	      					<strong>How's the adventure <? echo $logged_blogger_data[0]['first_name']; ?>?</strong>
	      				</small>
	      			</div>
	      		<? endif; ?>
	      		<form action="" id="create-form">
				  <div class="form-group cm_pt">
				    <label class="form-control-label" for="post_title">Post title</label>
				    <input type="text" name="post_title" class="form-control" id="post_title" aria-describedby="post-title" required>
						<div class="form-control-feedback" style="display:none;">Cannot be left blank.</div>
				  </div>
				  <div class="form-group cm_pt">
				    <label class="form-control-label" for="post_body">Post body</label>
				    <textarea class="form-control" name="post_body" id="post_body" rows=11 cols=50 maxlength="1500" required></textarea>
						<div class="form-control-feedback" style="display:none;">Cannot be left blank.</div>
				  </div>
				  <div class="form-group form-check form-check-inline form-category">
				  	Post category <br/><br/>
				  	<? for($i = 0; $i<count($posts_tags_dataset);$i++): ?>
				  		<label class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input" name="post_tag[]" value="<? echo $posts_tags_dataset[$i]['tag_name']; ?>">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">
						  	<? echo stripcslashes($posts_tags_dataset[$i]['tag_emoji']); ?> <? echo $posts_tags_dataset[$i]['tag_name']; ?>
						  </span>
						</label>
				  	<? endfor; ?>
				  </div>
				</form>
			</div>
	      	<div class="modal-footer">
			    	<button type="button" id="btn-post" onclick="createPost()" class="btn btn-md btn-success">Post it!</button>
					</div>
	    </div>
	  </div>
	</div>
	<!-- Updatepost Modal -->
	<div class="modal fade" id="updatePostModal" tabindex="-1" role="dialog" aria-labelledby="updatePostModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Post Update</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      	<div class="modal-body">
	      		<form action="#" id="update-form">
				  <div class="form-group">
				    <label for="post_title">Post title</label>
				    <input type="text" class="form-control" id="post_title" name="post_title" aria-describedby="post_title" required>
				  </div>
				  <div class="form-group">
				    <label for="post_body">Post body</label>
				    <textarea class="form-control" id="post_body" name="post_body" rows=11 cols=50 maxlength="1500" required></textarea>
				  </div>
				  <div class="form-group">
				  	Post category <br/><br/>
				  	<? for($i = 0; $i<count($posts_tags_dataset);$i++): ?>
				  		<label class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input" name="post_tag[]" value="<? echo $posts_tags_dataset[$i]['tag_name']; ?>">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">
						  	<? echo stripcslashes($posts_tags_dataset[$i]['tag_emoji']); ?> <? echo $posts_tags_dataset[$i]['tag_name']; ?>
						  </span>
						</label>
				  	<? endfor; ?>
				  </div>
				</form>
			</div>
	      	<div class="modal-footer">
			    <button type="button" onclick="secondStepUpdatePost()" id="btn-update" class="btn btn-md btn-success">Post it!</button>
			</div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="post-error-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Oopps!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h6>Sorry <? echo $logged_blogger_data[0]['first_name']; ?>, but I'm not able to accept that kind of post.</h6>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="delete-error-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Oopps!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h6>Sorry <? echo $logged_blogger_data[0]['first_name']; ?>, but I encountered a problem deleting the selected post.</h6>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="delete-confirm-modal">
	  <div class="modal-dialog delete-dialog" role="document">
	    <div class="modal-content delete-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Notification</h5>
	      </div>
	      <div class="modal-body text-center delete-modal-body">
	        <p>Are you sure you want to delete this post?</p>
	      </div>
	      <div class="modal-footer justify-content-center">
	        <a href="#!" onclick="deleteUserPost()" class="btn btn-md btn-outline-danger">Yes</a>
	        <a href="#!" class="btn btn-md btn-outline-primary" data-dismiss="modal">No</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="operations-modal">
	  <div class="modal-dialog modal-lg operations-dialog" role="document">
	    <div class="modal-content operations-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Notification</h5>
	      </div>
	      <div class="modal-body text-center operations-modal-body">
	        <p>What should we do with this post?</p>
	      </div>
	      <div class="modal-footer justify-content-center">
					<? if('@'.$currUser!=$viewed_blogger_data[0]['uname']): ?>
						<a href="#!" onclick="#!" class="btn btn-md btn-default"><i class="fa fa-bookmark" aria-hidden="true"></i> Bookmark Post</a>
						<a href="#!" onclick="#!" class="btn btn-md btn-default" data-dismiss="modal"><i class="fa fa-flag" aria-hidden="true"></i> Report Post</a>
					<? else: ?>
						<a href="#!" onclick="showDeleteModal()" class="btn btn-md btn-default"><i class="fa fa-trash" aria-hidden="true"></i> Delete Post</a>
						<a href="#!" onclick="firstStepUpdatePost()" class="btn btn-md btn-default" data-dismiss="modal"><i class="fa fa-pencil-square" aria-hidden="true"></i> Update Post</a>
					<? endif; ?>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="search-modal">
	  <div class="modal-dialog search-dialog" role="document">
	    <div class="modal-content search-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Notification</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
        	</button>
	      </div>
	      <div class="modal-body text-center delete-modal-body">
	        <form action="javascript:searchForThis()">
						<div class="form-group">
					    <label for="search-input">What to search?</label>
					    <input type="text" class="form-control" id="search-input" required>
							<small class="form-text text-danger error-text hidden">There's nothing to search <? echo '@'.$currUser; ?></small>
					    <small class="form-text text-muted">You can search for a post or different user<br/>and create connections across the world!</small>
					  </div>
	        </form>
	      </div>
	      <div class="modal-footer justify-content-center">
	        <a href="#!" onclick="searchForThis()" class="btn btn-md btn-outline-default"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="remove-buddy-modal">
	  <div class="modal-dialog modal-md remove-buddy-dialog" role="document">
	    <div class="modal-content remove-buddy-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Notification</h5>
	      </div>
	      <div class="modal-body text-center operations-modal-body">
	        <p>Are you sure you want to remove connection with <? echo $viewed_blogger_data[0]['uname']; ?>?</p>
	      </div>
				<div class="modal-footer justify-content-center">
	        <a href="#!" onclick="removeBuddy()" class="btn btn-md btn-outline-danger">Yes</a>
	        <a href="#!" class="btn btn-md btn-outline-primary" data-dismiss="modal">No</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="cancel-buddy-modal">
	  <div class="modal-dialog modal-md cancel-buddy-dialog" role="document">
	    <div class="modal-content cancel-buddy-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Notification</h5>
	      </div>
	      <div class="modal-body text-center operations-modal-body">
	        <p>Are you sure you want to cancel the buddy request sent to <? echo $viewed_blogger_data[0]['uname']; ?>?</p>
	      </div>
				<div class="modal-footer justify-content-center">
	        <a href="#!" onclick="cancelBuddyRequest()" class="btn btn-md btn-outline-danger">Yes</a>
	        <a href="#!" class="btn btn-md btn-outline-primary" data-dismiss="modal">No</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="buddyRequestModal">
	  <div class="modal-dialog modal-md buddyRequest-dialog" role="document">
	    <div class="modal-content buddyRequest-dialog-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Buddy Request</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
        	</button>
	      </div>
	      <div class="modal-body text-center operations-modal-body">
					<div class="card-group">
						<? if(empty($buddy_requests)): ?>
						<div class="card">
							<div class="card-block">
								<h6 class="card-title">No Requests</h6>
							</div>
						</div>
						<? else: ?>
							<? foreach($buddy_requests as $row): ?>
								<div class="card buddy-card">
									<img class="card-img-top buddy-avatar" src="../assets/img/back.jpeg" alt="Card image cap">
									<div class="card-block">
										<a href="<? echo substr($row['requester'],1); ?>">
											<h6 class="card-title"><? echo $row['requester']; ?></h6>
										</a>
										</a>
										<a href="#!" onclick="acceptBuddy(<? echo $logged_blogger_data[0]['user_id'] . "," . $row['requester_uid'] ?>)" class="btn btn-sm btn-default btn-accept-<? echo $row['requester_uid'];?>">
											<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
											Accept Request
										</a>
									</div>
								</div>
							<? endforeach; ?>
						<? endif; ?>
					</div>
	      </div>
	    </div>
	  </div>
	</div>
