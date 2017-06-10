$(document).ready(function() {
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
});


var cp = document.getElementById("btn-post");

cp.onclick = function() {
		if($('#post_title').val() != "" && $('#post_body').val().length > 0){
				$.ajax({
						url : "<?php echo site_url('blog/userPost'); ?>",
						type: 'POST',
						data: $('#form').serialize(),
						success: function(data){
							console.log(data);
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

function firstStepUpdatePost(user_id,post_id){
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

function showDeleteModal(user_id,post_id){
	localStorage.setItem("delete_uid",user_id);
	localStorage.setItem("delete_pid",post_id);
	$('#delete-confirm-modal').modal('show');
}

function deleteUserPost(){
	var user_id = localStorage.getItem("delete_uid");
	var post_id = localStorage.getItem("delete_pid");
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
						$('#delete-error-modal').modal('show');
				}
		});
}
