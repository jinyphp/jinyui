<x-jiny-theme theme="adminkit" class="bootstrap">
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Form Layouts</h1><a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">Pro Component <i class="fas fa-fw fa-external-link-alt"></i></a>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Basic form</h5>
                                <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Textarea</label>
                                        <textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label w-100">File input</label>
                                        <input type="file">
                                        <small class="form-text text-muted">Example block-level help text here.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check m-0">
                                            <input type="checkbox" class="form-check-input">
                                            <span class="form-check-label">Check me out</span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Horizontal form</h5>
                                <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end">Textarea</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <fieldset class="mb-3">
                                        <div class="row">
                                            <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Radios</label>
                                            <div class="col-sm-10">
                                                <label class="form-check">
                                                    <input name="radio-3" type="radio" class="form-check-input" checked="">
                                                    <span class="form-check-label">Default radio</span>
                                                </label>
                                                <label class="form-check">
                                                    <input name="radio-3" type="radio" class="form-check-input">
                                                    <span class="form-check-label">Second default radio</span>
                                                </label>
                                                <label class="form-check">
                                                    <input name="radio-3" type="radio" class="form-check-input" disabled="">
                                                    <span class="form-check-label">Disabled radio</span>
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Checkbox</label>
                                        <div class="col-sm-10">
                                            <label class="form-check m-0">
                                                <input type="checkbox" class="form-check-input">
                                                <span class="form-check-label">Check me out</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 ms-sm-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
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
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Inline form</h5>
                                <h6 class="card-subtitle text-muted">Single horizontal row.</h6>
                            </div>
                            <div class="card-body">
                                <form class="row row-cols-md-auto align-items-center">
                                    <div class="col-12">
                                        <label class="visually-hidden" for="inlineFormInputName2">Name</label>
                                        <input type="text" class="form-control mb-2 me-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
                                    </div>

                                    <div class="col-12">
                                        <label class="visually-hidden" for="inlineFormInputGroupUsername2">Username</label>
                                        <div class="input-group mb-2 me-sm-2">
                                            <div class="input-group-text">@</div>
                                            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check mb-1 me-sm-2">
                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-jiny-theme>   