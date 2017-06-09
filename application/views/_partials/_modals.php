
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
	      					<strong>Well done!</strong> Let's tell the world that we've arrived!
	      				</small>
	      			</div>
	      		<? else: ?>
	      			<div class="alert alert-warning" role="alert">
	      				<small>
	      					<strong>Show them how free you are <? echo $logged_blogger_data[0]['first_name']; ?>!</strong>
	      				</small>
	      			</div>
	      		<? endif; ?>
	      		<form action="" id="form">
				  <div class="form-group">
				    <label for="post_title">Post title</label>
				    <input type="text" name="post_title" class="form-control" id="post_title" aria-describedby="post-title" required>
				  </div>
				  <div class="form-group">
				    <label for="post_body">Post body</label>
				    <textarea class="form-control" name="post_body" id="post_body" rows="3" required></textarea>
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
			    <button type="button" id="btn-post" onclick="createPost()" class="btn btn-md btn-success">Post it!</button>
			</div>
	    </div>
	  </div>
	<!-- Updatepost Modal -->
	<div class="modal fade" id="updatePostModal" tabindex="-1" role="dialog" aria-labelledby="updatePostModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Updating Post</h5>
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
				    <textarea class="form-control" id="post_body" name="post_body" rows="5"></textarea>
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

	