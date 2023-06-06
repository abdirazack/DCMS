<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addressModalLabel">ADD NEW ADDRESS</h1>
            </div>
            <form action="./app/address/process_address.php" method="post" id="formInsertUpdateAddress">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="mb-3>
                            <label for="street" class="form-label">Street:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="street" name="street" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="mb-3>
                            <label for="city" class="form-label">City:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3>
                            <label for="state" class="form-label">State:</label>
                            <input type="text" class="form-control border border-1 border-primary" id="state" name="state" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit' class="btn btn-outline-primary">Add Address</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>