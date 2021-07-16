<div class="card">
    <div class="card-header">
        <h5 class="card-title">Basic form</h5>
        <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
    </div>
    <div class="card-body">
        {!! $form
            ->setLayout("default")
            ->addList(
                [
                    CLabel("Email address")->addClass("form-label"),
                    CEmail()->addClass("form-control")->setPlaceholder("Email")
                ]
            ) 
        !!}

        <form>
            <x-jinyui::forms.row>
                <x-slot name="left">
                    {!! CLabel("Email address")->addClass("form-label") !!}                  
                </x-slot>
                <x-slot name="right">
                    {!! CEmail()->addClass("form-control")->setPlaceholder("Email") !!}
                </x-slot>
            </x-jinyui::forms.row>



            {!! CDiv([
                    CLabel("Password")->addClass("form-label"),
                    CPassword()->addClass("form-control")->setPlaceholder("Password")
                ])->addClass("mb-3")
            !!}

            {!! CDiv([
                    CLabel("Textarea")->addClass("form-label"),
                    CTextarea()->addClass("form-control")->setPlaceholder("Textarea")->setRows(5)
                ])->addClass("mb-3")
            !!}

            {!! CDiv([
                    CLabel("File input")->addClass("form-label")->addClass("w-100"),
                    CFile(),
                    CSmall("Example block-level help text here.")->addClass("form-text")->addClass("text-muted")
                ])->addClass("mb-3")
            !!}

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