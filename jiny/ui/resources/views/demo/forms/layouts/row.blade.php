<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form row</h5>
        <h6 class="card-subtitle text-muted">Bootstrap column layout.</h6>
    </div>
    <div class="card-body">
        <form>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>

            <div class="mb-3">
                <label class="form-label" for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label" for="inputState">State</label>
                    <select id="inputState" class="form-control">
                        <option selected="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label" for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <input type="checkbox" class="form-check-input">
                    <span class="form-check-label">Check me out</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>