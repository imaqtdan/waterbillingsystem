<!-- Large modal -->
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
			<form class="ps-3 pe-3" id="invoiceform">
            <div class="modal-body">
			
					<div class="mb-3">
						<input type="hidden" name="id" />
						<label for="cid" class="form-label">Consumer ID</label>
						<input type="text" id="cid" name="cid" class="form-control" readonly="">
					</div>
					
					<div class="mb-3">
						<label class="form-label">Balance</label>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" id="basic-addon1">₱</span>
							<input type="text" class="form-control" name="bal" id="bal"  readonly="" aria-label="Balance" aria-describedby="basic-addon1">
						</div>
					</div>
			
					<div class="mb-3">
						<label for="prevread" class="form-label">Previous Consumption</label>
						<input type="text" id="prevread" name="prevread" class="form-control" readonly="">
					</div>
										
					<div class="mb-3">
						<label for="presread" class="form-label">Present Consumption</label>
						<input type="text" id="presread" name="presread" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="" class="form-control">
					</div>
					
					<div class="mb-3">
						<label for="prevdate" class="form-label">Previous Reading Date</label>
						<input class="form-control" id="prevdate" type="date" name="prevdate" readonly="" value="<?php echo $row['previous_transaction'] ?>">
					</div>
										
					<div class="mb-3">
						<label for="presdate" class="form-label">Present Reading Date</label>
						<input class="form-control" id="presdate" type="date" name="presdate" readonly="" value="<?php echo $date ?>">
					</div>
					
					<div class="mb-3 text-center">
                        <button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="mdi mdi-cash-plus"></i> Submit Invoice</button>
                    </div>

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
							<h4 class="mt-2">Are you sure you want to remove invoice ?</h4>
							Consumer ID:
							<div class="del-cid"></div>
							<br>
							Warning: Present consumption of the consumer are already updated, This bill cannot be retrieve anymore once deleted.</p>
							
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