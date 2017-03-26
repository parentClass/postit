
	<div class="container">
     <?php echo form_open('gates/login',array('class' => 'form-signin')); ?>     
        <h2 class="form-signin-heading">Heeeya!</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="user" id="user" class="form-control" placeholder="Username	" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Sign in</button>
	 <?php echo form_close(); ?>
	 </div>