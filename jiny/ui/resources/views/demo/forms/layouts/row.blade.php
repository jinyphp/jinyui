<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form row</h5>
        <h6 class="card-subtitle text-muted">Bootstrap column layout.</h6>
    </div>
    <div class="card-body">
        <form>

            <div class="row">
                <x-jinyui::forms.row class="col-md-6">
                    <x-jinyui::forms.label for="inputEmail4">
                        Email
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.row>

                <x-jinyui::forms.row class="col-md-6">
                    <x-jinyui::forms.label for="inputPassword4">
                        Password
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.row>
            </div>

            <x-jinyui::forms.row>
                <x-jinyui::forms.label for="inputAddress">
                    Address
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>
            
            <x-jinyui::forms.row>
                <x-jinyui::forms.label for="inputAddress2">
                    Address 2
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>



            <div class="row">
                <x-jinyui::forms.row class="col-md-6">
                    <x-jinyui::forms.label for="inputCity">
                        City
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <input type="text" class="form-control" id="inputCity">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.row>

                <x-jinyui::forms.row class="col-md-4">
                    <x-jinyui::forms.label for="inputState">
                        State
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <select id="inputState" class="form-control">
                            <option selected="">Choose...</option>
                            <option>...</option>
                        </select>
                    </x-jinyui::forms.item>
                </x-jinyui::forms.row>
                
                <x-jinyui::forms.row class="col-md-2">
                    <x-jinyui::forms.label for="inputZip">
                        Zip
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <input type="text" class="form-control" id="inputZip">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.row>

            </div>

            <x-jinyui::forms.row>
                <x-jinyui::forms.item>
                    <x-jinyui::forms.checkbox>
                        <span class="form-check-label">Check me out</span>
                    </x-jinyui::forms.checkbox>
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>

            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>