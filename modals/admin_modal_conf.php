<!-- Scrollable modal -->
<div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
			
            <div class="modal-body">
				<div data-simplebar style="max-height: 700px;">
				<form class="ps-3 pe-3" id="adminform">
					<div class="mb-3">
						<input type="hidden" name="id" />
						<label for="firstname" class="form-label">First Name</label>
						<input type="text" id="firstname" name="firstname" class="form-control" required="">
					</div>
					<div class="mb-3">
						<label for="lastname" class="form-label">Last Name</label>
						<input type="text" id="lastname" name="lastname" class="form-control" required="">
					</div>
					<div class="mb-3">
						<label for="address" class="form-label">Full Address</label>
						<input type="text" id="address" name="address" class="form-control" required="">
					</div>
					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input type="text" id="username" name="username" class="form-control" required="">
					</div>
					<div class="mb-3">
                        <label for="password" class="form-label">Password</label>
					<div class="input-group input-group-merge">
                        <input type="password" required="" name="password" id="password" class="form-control" placeholder="Enter password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                     </div>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email Address</label>
						<input type="email" id="email" name="email" class="form-control" required="">
					</div>
					<div class="mb-3">
						<label for="contact" class="form-label">Contact No.</label>
						<input type="text" id="contact" name="contact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" required="">
					</div>
					<?php if($_SESSION['login_user_level'] < 1): ?>
					<div class="mb-3">
						<label for="example-select" class="form-label">Select Level</label>
						<select class="form-select" id="user_level" name="user_level">
							<option value="0">Administrator</option>
							<option value="1">Cashier</option>
						</select>
					</div>
					<?php else: ?>
						<input type="hidden" name="user_level" />
					<?php endif; ?>
					<div class="modal-footer">
						<button class="btn btn-primary" name="submit" id="submit" type="submit">Save changes</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
				
				<form action="commands/uploadprofile.php" method="post" enctype="multipart/form-data" id="adminimage">
					<div class="form-group d-flex justify-content-center">
						<img src="upload/upload.png" alt="" id="cimg" class="img-fluid img-thumbnail">
					</div>
					<br>
					<div class="mb-3">
						<input type="hidden" name="id2" />
						<input type="file" class="form-control" id="profile" name="profile" onchange="displayImg(this,$(this))">
					</div>
					<center>
					<div class="mb-3">
						<button class="btn btn-primary" name="submit2" id="submit2" type="submit">Update Profile Picture</button>
					</div>
					</center>
				</form>
				
				</div>
            </div>
            
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Danger Alert Modal -->
<div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
						<form id="deleteform">
							<input type="hidden" name="id" />
							<h4 class="mt-2">Are you sure you want to remove this user ?</h4>
							<p class="mt-3">Warning: If you confirm the deletion, User 

							<div class="del-fname"></div>
							<div class="del-lname"></div> 
					
							<br>
							will be lost all his/her data.</p>
							
							<div class="mb-3">
								<label for="confirmdel" class="form-label">Type "CONFIRM" to proceed.</label>
								<input class="form-control" type="text" name="confirmdel" id="confirmdel" required="" placeholder="CONFIRM">
							</div>
							
							<button class="btn btn-light" type="submit">Confirm Deletion</button>&nbsp&nbsp
							<button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Cancel Deletion</button>
						</form>
				</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->