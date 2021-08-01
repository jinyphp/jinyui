<div class="card">
    <div class="card-header">
        <h5 class="card-title">Basic form</h5>
        <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
    </div>
    <div class="card-body">

        <form>
        
            <x-jinyui::forms.row>
                <x-jinyui::forms.label>
                    Email address
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="email" class="form-control" placeholder="Email">
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>

            <x-jinyui::forms.row>
                <x-jinyui::forms.label>
                    Password
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    {!! CPassword()->addClass("form-control")->setPlaceholder("Password") !!}
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>


            <x-jinyui::forms.row>
                <x-jinyui::forms.label>
                    Textarea
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    {!! CTextarea()->addClass("form-control")->setPlaceholder("Textarea")->setRows(5) !!}
                </x-jinyui::forms.item>
            </x-jinyui::forms.row>


            <x-jinyui::forms.row>
                <x-jinyui::forms.label class="w-100">
                    File input
                </x-jinyui::forms.label>
                <x-jinyui::forms.item>
                    <input type="file">
                </x-jinyui::forms.item>                
                <small class="form-text text-muted">Example block-level help text here.</small>
            </x-jinyui::forms.row>

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