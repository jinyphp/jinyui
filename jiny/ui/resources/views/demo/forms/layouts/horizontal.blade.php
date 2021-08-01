<div class="card">
    <div class="card-header">
        <h5 class="card-title">Horizontal form</h5>
        <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
    </div>
    <div class="card-body">

        <form>

            <x-jinyui::forms.hor>
                <x-jinyui::forms.label>
                    Email
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="email" class="form-control" placeholder="Email">
                </x-jinyui::forms.item>
            </x-jinyui::forms.hor>

            <x-jinyui::forms.hor>
                <x-jinyui::forms.label>
                    Password
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="password" class="form-control" placeholder="Password">
                </x-jinyui::forms.item>
            </x-jinyui::forms.hor>

            <x-jinyui::forms.hor>
                <x-jinyui::forms.label class="col-form-label">
                    Textarea
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                </x-jinyui::forms.item>
            </x-jinyui::forms.hor>
        




            <fieldset>
                <x-jinyui::forms.hor>
                    <x-jinyui::forms.label class="col-form-label pt-sm-0 ">
                        Radios
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <x-jinyui::forms.radio name="radio-3" checked="">
                            <span class="form-check-label">Default radio</span>
                        </x-jinyui::forms.radio>

                        <x-jinyui::forms.radio name="radio-3">
                            <span class="form-check-label">Second default radio</span>
                        </x-jinyui::forms.radio>
                        
                        <x-jinyui::forms.radio name="radio-3" disabled="">
                            <span class="form-check-label">Disabled radio</span>
                        </x-jinyui::forms.radio>
                        

                        
                    </x-jinyui::forms.item>
                </x-jinyui::forms.hor>
            </fieldset>
            
            <x-jinyui::forms.hor>
                <x-jinyui::forms.label class="col-form-label pt-sm-0">
                    Checkbox
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <x-jinyui::forms.checkbox>
                        <span class="form-check-label">Check me out</span>
                    </x-jinyui::forms.checkbox>
                </x-jinyui::forms.item>
            </x-jinyui::forms.hor>

            <x-jinyui::forms.hor>
                <x-jinyui::forms.item class="ms-sm-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </x-jinyui::forms.item>
            </x-jinyui::forms.hor>





        </form>
    </div>
</div>