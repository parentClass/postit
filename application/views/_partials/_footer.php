

    <script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.min.js"; ?>'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script type='text/javascript' src='<?php echo site_url()."assets/js/bootstrap.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.easings.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/scrolloverflow.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.fullPage.min.js"; ?>'></script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#fullpage').fullpage({
  			//Navigation
  			menu: '#menu',
  			lockAnchors: false,
  			anchors:["auth"],
  			navigation: false,
  			navigationPosition: 'right',
  			navigationTooltips: ['firstSlide', 'secondSlide'],
  			showActiveTooltip: false,
  			slidesNavigation: false,
  			slidesNavPosition: 'bottom',

  			//Scrolling
  			css3: true,
  			scrollingSpeed: 700,
  			autoScrolling: true,
  			fitToSection: true,
  			fitToSectionDelay: 1000,
  			scrollBar: false,
  			easing: 'easeInOutCubic',
  			easingcss3: 'ease',
  			loopBottom: false,
  			loopTop: false,
  			loopHorizontal: true,
  			continuousVertical: false,
  			continuousHorizontal: false,
  			scrollHorizontally: false,
  			interlockedSlides: false,
  			dragAndMove: false,
  			offsetSections: false,
  			resetSliders: false,
  			fadingEffect: false,
  			normalScrollElements: '#element1, .element2',
  			scrollOverflow: false,
  			scrollOverflowReset: false,
  			scrollOverflowOptions: null,
  			touchSensitivity: 15,
  			normalScrollElementTouchThreshold: 5,
  			bigSectionsDestination: null,

  			//Accessibility
  			keyboardScrolling: true,
  			animateAnchor: true,
  			recordHistory: true,

  			//Design
  			controlArrows: false,
  			verticalCentered: true,
  			sectionsColor : [],
  			paddingTop: '3em',
  			paddingBottom: '10px',
  			fixedElements: '#header, .footer',
  			responsiveWidth: 0,
  			responsiveHeight: 0,
  			responsiveSlides: true,
  			parallax: false,
  			parallaxOptions: {type: 'reveal', percentage: 62, property: 'translate'},
  		});

      <? if($page_type=="dashboard" && $logged_blogger_data[0]['isNew'] == 1): ?>
          <? echo "$('#createPostModal').modal('show');\n"; ?>
      <? endif; ?>
    });

    function createPost(){
    		if($('#post_title').val() != "" && $('#post_body').val().length > 0){
    				$.ajax({
    						url : "<?php echo site_url('blog/userPost'); ?>",
    						type: 'POST',
    						data: $('#create-form').serialize(),
    						success: function(data){
    							$('#createPostModal').modal('hide');
    							// Get the snackbar DIV
    							var x = document.getElementById("snackbar-success")
    							// Add the "show" class to DIV
    							x.className = "show";
    							// After 3 seconds, remove the show class from DIV
    							setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    							setTimeout(function(){
    									 location.reload();
    							}, 2000)
    						},error: function (jqXHR, textStatus, errorThrown){
    								$('#createPostModal').modal('hide');
    								$('#post-error-modal').modal('show');
    						}
    				});
    		}else{
    			// Get the snackbar DIV
    			var x = document.getElementById("snackbar")
    			// Add the "show" class to DIV
    			x.className = "show";
    			// After 3 seconds, remove the show class from DIV
    			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    		}
    }

    function firstStepUpdatePost(){
        var user_id = localStorage.getItem("user_id");
        var post_id = localStorage.getItem("post_id");
    		$.ajax({
    				url : "<?php echo site_url('blog/retrieveUserPost'); ?>/" + user_id + "/" + post_id ,
    				type: 'GET',
    				dataType: "JSON",
    				success: function(data){
    						$('[name="post_title"]').val(data.title);
    						$('[name="post_body"]').val(data.body);
    						$('#btn-update').attr("onclick","secondStepUpdatePost(" + user_id + "," + post_id + ")");

    						var tags = data.tags;
    						tags = tags.split(',');

    						for (var i = 0; i < tags.length; i++) {
    								$('[value="'+ tags[i] +'"]').attr("checked","true");
    						}

    						$('#updatePostModal').modal('show');
    				},error: function (jqXHR, textStatus, errorThrown){
    						$('#updatePostModal').modal('hide');
    						$('#post-error-modal').modal('show');
    				}
    		});
    }

    function secondStepUpdatePost(user_id,post_id){
    	if($('#post_title').val() != "" && $('#post_body').val().length > 0){
    			$.ajax({
    				url : "<?php echo site_url('blog/updatePost'); ?>/" + user_id + "/" + post_id,
    				type: 'POST',
    				data: $('#update-form').serialize(),
    				success: function(data){
    					$('#updatePostModal').modal('hide');
    					// Get the snackbar DIV
    					var x = document.getElementById("snackbar-success")
    					// Add the "show" class to DIV
    					x.className = "show";
    					// After 3 seconds, remove the show class from DIV
    					setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    					setTimeout(function(){
    							 location.reload();
    					}, 2000)
    				},error: function (jqXHR, textStatus, errorThrown){
    						$('#updatePostModal').modal('hide');
    						$('#post-error-modal').modal('show');
    				}
    		});
    	}else{
    		// Get the snackbar DIV
    		var x = document.getElementById("snackbar")
    		// Add the "show" class to DIV
    		x.className = "show";
    		// After 3 seconds, remove the show class from DIV
    		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    	}
    }

    function showDeleteModal(){
      $("#operations-modal").modal('hide');
    	$('#delete-confirm-modal').modal('show');
    }

    function deleteUserPost(){
      var user_id = localStorage.getItem("user_id");
      var post_id = localStorage.getItem("post_id");
    	$.ajax({
    				url: "<?php echo site_url('blog/deletePost'); ?>/" + user_id + "/" + post_id,
    				type: 'POST',
    				success: function(data){
    					var data = JSON.parse(data);
    					if(data[0]['delete_ops']=="success"){
    						$('#delete-confirm-modal').modal('hide');
    						// Get the snackbar DIV
    						var x = document.getElementById("snackbar-success")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    						setTimeout(function(){
    								 location.reload();
    						}, 2000)
    					}else{
    						alert("I encountered a problem deleting the post!");
    					}
    				},error: function (jqXHR, textStatus, errorThrown){
    					console.log(jqXHR + " " + textStatus + " " + errorThrown);
    						$('#delete-confirm-modal').modal('hide');
                // Get the snackbar DIV
    						var x = document.getElementById("snackbar-danger")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    				}
    		});
    }
    function specifyPost(user_id,post_id){
      localStorage.setItem("user_id",user_id);
      localStorage.setItem("post_id",post_id);
    }
    function specifyBuddy(uo_id,ut_id){
      localStorage.setItem("uo_id",uo_id);
      localStorage.setItem("ut_id",ut_id);
    }
    function sendBuddyRequest(uo,ut){
      $('.btn-buddy').html("<i class='fa fa-check' aria-hidden='true'></i> Buddy Request Sent!");
      $.ajax({
    				url: "<?php echo site_url('blog/addBuddy'); ?>/" + uo + "/" + ut,
    				type: 'POST',
    				success: function(data){

    				},error: function (jqXHR, textStatus, errorThrown){
    					console.log(jqXHR + " " + textStatus + " " + errorThrown);
                // Get the snackbar DIV
    						var x = document.getElementById("snackbar-danger")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    				}
    		});
    }
    function cancelBuddyRequest(){
      var uo = localStorage.getItem("uo_id");
      var ut = localStorage.getItem("ut_id");
      $('.btn-buddy').html("<i class='fa fa-user-plus' aria-hidden='true'></i> Send Buddy Request");
      $.ajax({
    				url: "<?php echo site_url('blog/cancelBuddy'); ?>/" + uo + "/" + ut,
    				type: 'POST',
    				success: function(data){
              $("#cancel-buddy-modal").modal('hide');
              setTimeout(function(){
                   location.reload();
              }, 2000)
    				},error: function (jqXHR, textStatus, errorThrown){
    					console.log(jqXHR + " " + textStatus + " " + errorThrown);
                // Get the snackbar DIV
    						var x = document.getElementById("snackbar-danger")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    				}
    		});
    }
    function removeBuddy(){
      var uo = localStorage.getItem("uo_id");
      var ut = localStorage.getItem("ut_id");
      $('.btn-buddy').html("<i class='fa fa-user-plus' aria-hidden='true'></i> Send Buddy Request");
      $.ajax({
    				url: "<?php echo site_url('blog/removeBuddy'); ?>/" + uo + "/" + ut,
    				type: 'POST',
    				success: function(data){
              $("#remove-buddy-modal").modal('hide');
              setTimeout(function(){
                   location.reload();
              }, 2000)
    				},error: function (jqXHR, textStatus, errorThrown){
    					console.log(jqXHR + " " + textStatus + " " + errorThrown);
                // Get the snackbar DIV
    						var x = document.getElementById("snackbar-danger")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    				}
    		});
    }
    function acceptBuddy(uo,ut){
      $('.btn-accept-'+ut).html("<i class='fa fa-check' aria-hidden='true'></i> Buddy Request Accepted");
      $('.btn-accept-'+ut).addClass("disabled");
      $.ajax({
    				url: "<?php echo site_url('blog/acceptBuddy'); ?>/" + uo + "/" + ut,
    				type: 'POST',
    				success: function(data){

    				},error: function (jqXHR, textStatus, errorThrown){
    					console.log(jqXHR + " " + textStatus + " " + errorThrown);
                // Get the snackbar DIV
    						var x = document.getElementById("snackbar-danger")
    						// Add the "show" class to DIV
    						x.className = "show";
    						// After 3 seconds, remove the show class from DIV
    						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
    				}
    		});
    }
  </script>
    </body>
</html>
