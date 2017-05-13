

    <script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.min.js"; ?>'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script type='text/javascript' src='<?php echo site_url()."assets/js/bootstrap.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.easings.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/scrolloverflow.min.js"; ?>'></script>
	<script type="text/javascript" src='<?php echo site_url()."assets/js/jquery.fullPage.min.js"; ?>'></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#fullpage').fullpage();
                <? if($page_type=="dashboard" && $logged_blogger_data[0]['isNew'] == 1): ?>
                    <? echo "$('#createPostModal').modal('show');\n"; ?>
                <? endif; ?>
            });
        </script>
        <script type='text/javascript'>
            function createPost(){
                $.ajax({
                    crossOrigin: true,
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
            };
            function firstStepUpdatePost(user_id,post_id){
                $.ajax({
                    url : "<?php echo site_url('blog/retrieveUserPost'); ?>/" + user_id + "/" + post_id ,
                    type: 'GET',
                    dataType: "JSON",
                    success: function(data){
                        $('[name="post-title"]').val(data.title);
                        $('[name="post-body"]').val(data.body);
                        $('#btn-update').attr("onclick","secondStepUpdatePost(" + user_id + "," + post_id + ")");
                        $('#updatePostModal').modal('show');
                    },error: function (jqXHR, textStatus, errorThrown){
                        $('#updatePostModal').modal('hide');
                        $('#post-error-modal').modal('show');
                    }
                });
            };
            function secondStepUpdatePost(user_id,post_id){
                $.ajax({
                    crossOrigin: true,
                    url : "<?php echo site_url('blog/updatePost'); ?>/" + user_id + "/" + post_id,
                    type: 'POST',
                    data: $('#update-form').serialize(),
                    success: function(data){
                        location.reload();
                    },error: function (jqXHR, textStatus, errorThrown){
                        $('#updatePost').modal('hide');
                        $('#post-error-modal').modal('show');
                    }
                });
            }
        </script>
    </body>
</html>