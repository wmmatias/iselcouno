<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php       if($data['status'] !== '1'){
?>      <div class="badge rounded-pill bg-danger">
        <p><strong><?=$data['first_name'].' '.$data['last_name']?>!</strong> You should check your email or click verify email to get you verified.</p>
      </div>
<?php   }
        else{
?>      <div class="badge rounded-pill bg-primary">
      <p>Account Verified!</p>
      </div>
<?php   }
?>        <form action="/users/users_modification" method="post" id="form-input">
<?php	if(!$this->session->flashdata('success')){
		}
		else{
?>		<div class="alert alert-dismissible fade show alert-success" role="alert">
			<?=$this->session->flashdata('success');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
<?php	}
?>          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
					<div class="form-group">
						<label for="firstname">First Name</label>
						<input type="text" name="firstname" class="form-control" value="<?=$data['first_name']?>" placeholder="First Name">
            			<?php echo form_error('firstname') ?>
					</div>
					<div class="form-group">
						<label for="lastname">Last Name</label>
						<input type="text" name="lastname" class="form-control" value="<?=$data['last_name']?>" placeholder="Last Name">
            			<?php echo form_error('lastname') ?>
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name="phone" class="form-control" value="<?=$data['phone']?>" placeholder="Phone">
            			<?php echo form_error('phone') ?>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" class="form-control" value="<?=$data['email']?>" placeholder="Email">
            			<?php echo form_error('email') ?>
<?php       if($data['status'] !== '1'){
?>            <a href="#" id="verify" class="btn btn-danger mt-1">Verify Email</a>
              <p style="font-size: 90%">By clicking this you are sending verification email in your email account</p>
<?php       }
?>					</div>
          			<input type="hidden" name="id" value="<?=$data['id']?>">
					<button id="form-button" type="submit" class="btn btn-primary">Update Profile</button>
				</form>

				<form id="change_password" action="users/credentials_modification" method="post">
					
<?php	if(!$this->session->flashdata('success')){
		}
		else{
?>		<div class="alert alert-dismissible fade show alert-success" role="alert">
			<?=$this->session->flashdata('success');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
<?php	}
?> 
				<?=$this->session->flashdata('old_pass');?>
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
					<div class="form-group">
						<label for="current">Current Password</label>
						<input type="password" name="current" class="form-control" placeholder="Current Password">
						<?php echo form_error('current') ?>
					</div>
					<div class="form-group">
						<label for="new">New Password</label>
						<input type="password" name="new" class="form-control" placeholder="New Password">
						<?php echo form_error('new') ?>
					</div>
					<div class="form-group">
						<label for="confirm">Confirm Password</label>
						<input type="password" name="confirm" class="form-control" placeholder="Confirm Password">
						<?php echo form_error('confirm') ?>
					</div>
					<input type="hidden" name="id" value="<?=$data['id']?>">
					<button type="submit" class="btn btn-primary">Update Password</button>
				</form>