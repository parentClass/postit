

    <script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.min.js"; ?>'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script type='text/javascript' src='<?php echo site_url()."assets/js/bootstrap.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.easings.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/scrolloverflow.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.fullPage.min.js"; ?>'></script>
    <script type="text/javascript">
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
                <? if($page_type=="dashboard" && $logged_blogger_data[0]['isNew'] == 1): ?>
                    <? echo "$('#createPostModal').modal('show');\n"; ?>
                <? endif; ?>
        });
        function createPost(){
            $.ajax({
                url : "<?php echo site_url('blog/userPost'); ?>",
                type: 'POST',
                data: $('#form').serialize(),
                success: function(data){
                    location.reload();
                },error: function (jqXHR, textStatus, errorThrown){
                    $('#createPostModal').modal('hide');
                    $('#post-error-modal').modal('show');
                }
            });
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
        };
        function secondStepUpdatePost(user_id,post_id){
            $.ajax({
                url : "<?php echo site_url('blog/updatePost'); ?>/" + user_id + "/" + post_id,
                type: 'POST',
                data: $('#update-form').serialize(),
                success: function(data){
                    location.reload();
                },error: function (jqXHR, textStatus, errorThrown){
                    $('#updatePostModal').modal('hide');
                    $('#post-error-modal').modal('show');
                }
            });
        }
    </script>
    </body>
</html>
