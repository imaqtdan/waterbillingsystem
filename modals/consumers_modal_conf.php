<!------------------------------------------------------------------------------------------------------------ ADD -->
<button type="button" class="btn btn-info" id="addconsumer"><i class="mdi mdi-account-plus"></i> Add New Consumer</button>
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
			<form class="ps-3 pe-3" id="consumerform">
			<div data-simplebar style="max-height: 700px;">
            <div class="modal-body">
			<ul class="nav nav-tabs nav-justified nav-bordered mb-3">
				<li class="nav-item">
					<a href="#accountinfo" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
						<i class="mdi mdi-account-circle d-md-none d-block"></i>
						<span class="d-none d-md-block">Account Information</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#accountdata" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
						<i class="mdi mdi-home-variant d-md-none d-block"></i>
						<span class="d-none d-md-block">Account Data</span>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane show active" id="accountinfo">
					<div class="mb-3">
						<input type="hidden" name="id" />
						<input type="hidden" name="consumerid" />
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input class="form-control" type="text" name="firstname" id="firstname" required="" placeholder="Enter first name">
                    </div>
					
					<div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="lastname" id="lastname" required="" placeholder="Enter last name">
                    </div>
					
					<div class="mb-3">
                        <label for="address" class="form-label">Street Address/House No.</label>
                        <input class="form-control" type="text" name="address" id="address" required="" placeholder="Enter Street Address">
                    </div>
					
					<div class="row">
						<div class="col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="brg_address" class="form-label">Barangay Address</label>
								<input class="form-control" type="text" name="brg_address" id="brg_address" required="" placeholder="Enter Barangay Address">
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="ct_address" class="form-label">City Address</label>
								<input class="form-control" type="text" name="ct_address" id="ct_address" required="" placeholder="Enter City Address">
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="pro_address" class="form-label">Province Address</label>
								<input class="form-control" type="text" name="pro_address" id="pro_address" required="" placeholder="Enter Province Address">
							</div>
						</div>
					</div>
					
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter username">
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
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input class="form-control" type="email" name="emailaddress" id="emailaddress" required="" placeholder="Enter email">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input class="form-control" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="contact" id="contact" required="" placeholder="Enter contact number">
                    </div>
				</div>
			<div class="tab-pane" id="accountdata">
					
					<div class="mb-3">
						<label class="form-label">Balance</label>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" id="basic-addon1">₱</span>
							<input type="text" class="form-control" name="balance" id="balance" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="" aria-label="balance" aria-describedby="basic-addon1">
						</div>
					</div>
					
					<div class="mb-3">
                        <label for="tconsumed" class="form-label">Current Meter Count</label>
                        <input class="form-control" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="tconsumed" id="tconsumed" required="" placeholder="">
                    </div>
					
			</div>
			</div>
			</div>
			</div>
					<div class="mb-3 text-center">
                        <button class="btn btn-primary" name="submit" id="submit" type="submit">Confirm</button>
                    </div>
					</form>
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
							<input type="hidden" name="consumerid" />
							<h4 class="mt-2">Are you sure you want to remove consumer ?</h4>
							<p class="mt-3">Warning: If you confirm the deletion, Consumer 

							<div class="del-fname"></div>
							<div class="del-lname"></div> 
					
							<br>
							will be lost his/her data including pending bill.</p>
							
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