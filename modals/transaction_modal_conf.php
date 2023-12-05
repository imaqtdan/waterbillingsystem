<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
		<form class="ps-3 pe-3" id="transactionform">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"><i class="mdi mdi-cash-check"></i> Complete Transaction</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            
					<div class="mb-3">
						<input type="hidden" name="id" />
						<input type="hidden" name="consumerid" />
                    </div>
					
					<div class="mb-3">
						<label class="form-label">Total Amount</label>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" id="basic-addon1">₱</span>
							<input type="text" class="form-control" name="ptotal" id="ptotal"  readonly="" aria-label="Total Amount" aria-describedby="basic-addon1">
						</div>
					</div>
					
					<div class="mb-3">
						<label class="form-label">Payment Value</label>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" id="basic-addon2">₱</span>
							<input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="pment" id="pment" required="" aria-label="Total Amount" aria-describedby="basic-addon1">
						</div>
					</div>
					
            </div>
            <div class="modal-footer">
				<button class="btn btn-primary" name="submit" id="submit" type="submit">Confirm</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
			</form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->