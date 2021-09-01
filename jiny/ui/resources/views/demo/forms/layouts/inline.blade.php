<div class="card">
    <div class="card-header">
        <h5 class="card-title">Inline form</h5>
        <h6 class="card-subtitle text-muted">Single horizontal row.</h6>
    </div>
    <div class="card-body">

        <form >
            <div class="row row-cols-md-auto align-items-center">
                <x-jinyui::forms.inline>
                    <x-jinyui::forms.label for="inlineFormInputName2">
                        Name
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item>
                        <input type="text" class="form-control mb-2 me-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.inline>
                
                <x-jinyui::forms.inline>
                    <x-jinyui::forms.label for="inlineFormInputGroupUsername2">
                        Username
                    </x-jinyui::forms.label>
                    <x-jinyui::forms.item class="input-group mb-2 me-sm-2">
                        <div class="input-group-text">@</div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                    </x-jinyui::forms.item>
                </x-jinyui::forms.inline>

                <x-jinyui::forms.inline>
                    <div class="form-check mb-1 me-sm-2">
                        <input type="checkbox" class="form-check-input" id="customControlInline">
                        <label class="form-check-label" for="customControlInline">Remember me</label>
                    </div>
                </x-jinyui::forms.inline>
    
                <x-jinyui::forms.inline>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </x-jinyui::forms.inline>
    
            </div>
            
        </form>

    </div>
</div>