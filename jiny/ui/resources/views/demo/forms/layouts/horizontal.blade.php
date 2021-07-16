<div class="card">
    <div class="card-header">
        <h5 class="card-title">Horizontal form</h5>
        <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
    </div>
    <div class="card-body">
        {!! $form
            ->setLayout("horizontal")
            ->addList(
                [
                    CLabel("Email address")->addClass("col-form-label"),
                    CEmail()->addClass("form-control")->setPlaceholder("Email")
                ]
            ) 
        !!}


        <form>

            <x-jinyui::forms.horizontal>
                <x-slot name="left">
                    <label class="col-form-label">Email</label>                    
                </x-slot>
                <x-slot name="right">
                    <input type="email" class="form-control" placeholder="Email">
                </x-slot>
            </x-jinyui::forms.horizontal>




            
            <div class="mb-3 row">
                <div class="col-sm-2 text-sm-end">
                    <label class="col-form-label">Password</label>
                </div>                
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