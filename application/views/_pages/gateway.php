
	<div id="fullpage">
        <div class="section">
            <div class="slide" data-anchor="sign-in">
                <div class="container">
                    <? echo form_open('gates/login',array('class'=>'form-signin')); ?>
                        <? if($this->session->flashdata('error_msg')): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>
                                    <small>
                                        Oopps! <? echo $this->session->flashdata('error_msg'); ?>
                                    </small>
                                </strong>
                            </div>
                        <? elseif($this->session->flashdata('signup_failed_msg')): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>
                                    <small>
                                        <? echo $this->session->flashdata('signup_failed_msg'); ?>
                                    </small>
                                </strong>
                            </div>
                        <? elseif($this->session->flashdata('signup_success_msg')): ?>
                            <div class="alert alert-success" role="alert">
                                <strong>
                                    <small>
                                        <? echo $this->session->flashdata('signup_success_msg'); ?>
                                    </small>
                                </strong>
                            </div>
                        <? elseif($this->session->flashdata('username_taken_msg')): ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>
                                    <small>
                                        <? echo $this->session->flashdata('username_taken_msg'); ?>
                                    </small>
                                </strong>
                            </div>
                        <? elseif($this->session->flashdata('username_invalid_msg')): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>
                                    <small>
                                        <? echo $this->session->flashdata('username_invalid_msg'); ?>
                                    </small>
                                </strong>
                            </div>

                        <? endif; ?>
                    <h2 class="form-signin-heading">Post it!</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-auto sign-in-fields">
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
																<div class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></div>
																<input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
															</div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <button class="btn btn-md btn-outline-success btn-block" type="submit">Sign in!</button>
																<br/>
																<a class="anchor-sign" href="#auth/sign-up" >Not yet a member? Sign up now!</a>
                            </div>
                        </div>
                    </div>
                    <? echo form_close(); ?>
                </div>
            </div>
            <div class="slide" data-anchor="sign-up">
                <div class="container">
                    <? echo form_open('gates/register',array('class' => 'form-signin')); ?>
                    <h2 class="form-signin-heading">Post it!</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-auto sign-in-fields">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" required autofocus>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" required autofocus>
                                <input type="text" name="tagline" id="tagline" class="form-control" placeholder="What's your preferred tagline?" required autofocus>
                                <input class="form-control" type="color" value="#651fff" name="color_preference" id="color_preference">
																<div class="input-group mb-2 mr-sm-2 mb-sm-0">
																	<a class="input-group-addon gfont" href="https://fonts.google.com/" target="_blank">
																		<i class="fa fa-google" aria-hidden="true"></i>
																	</a>
																	<input type="text" name="font_preference" id="font_preference" class="form-control" placeholder="Pick one google font" required autofocus>
																</div>
																<br/>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                                <button class="btn btn-md btn-outline-warning btn-block" type="submit">Sign up!</button>
																<br/>
																<a class="anchor-sign" href="#auth/sign-in" >No need for signup? Sign in to continue!</a>
                            </div>
                        </div>
                    </div>
                    <? echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
