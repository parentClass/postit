
	<div id="fullpage">
        <div class="section">
            <div class="slide">
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
                                <input type="text" name="username" id="username" class="form-control" placeholder="@username" required autofocus>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <button class="btn btn-md btn-outline-success btn-block text-white" type="submit">Sign in!</button>
                            </div>
                        </div>
                    </div>
                    <? echo form_close(); ?>
                </div>
            </div>
            <div class="slide">
                <div class="container">
                    <? echo form_open('gates/register',array('class' => 'form-signin')); ?>     
                    <h2 class="form-signin-heading">Post it!</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-auto sign-in-fields">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" required autofocus>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" required autofocus>
                                <input type="text" name="tagline" id="tagline" class="form-control" placeholder="What describes you?" required autofocus>
                                <input class="form-control" type="color" value="#651fff" name="color_preference" id="color_preference">
                                <hr style="border: 1px white solid;">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                                <button class="btn btn-md btn-outline-warning btn-block text-white" type="submit">Sign up!</button>
                            </div>
                        </div>
                    </div>
                    <? echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>