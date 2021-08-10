<x-theme theme="adminkit">
    <x-main-content>
        <x-container>

            <h1 class="h3 mb-3">Inputs Radio</h1>

            <x-row>
                <x-col-6>
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title mb-0">Radios</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option1" name="radios-example" checked="">
                                    <span class="form-check-label">
                                        Option one is this and that—be sure to include why it's great
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option2" name="radios-example">
                                    <span class="form-check-label">
                                        Option two can be something else and selecting it will deselect option one
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option3" name="radios-example" disabled="">
                                    <span class="form-check-label">
                                        Option three is disabled
                                    </span>
                                </label>
                            </div>
                            
                        </div>
                    </x-card>
                </x-col-6>




                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title mb-0">Inline</h5>
                        </x-card-header>
                        <x-card-body>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadio3" name="customRadio1" class="form-check-input">
                                    <label class="form-check-label" for="customRadio3">Toggle this custom radio</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadio4" name="customRadio1" class="form-check-input">
                                    <label class="form-check-label" for="customRadio4">Or toggle this other custom radio</label>
                                </div>
                            </div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example" value="option1">
                                    <span class="form-check-label">
                                        1
                                    </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example" value="option2">
                                    <span class="form-check-label">
                                        2
                                    </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example" value="option3" disabled="">
                                    <span class="form-check-label">
                                        3
                                    </span>
                                </label>
                            </div>
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title mb-0">Disabled</h5>
                        </x-card-header>
                        <x-card-body>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadio5" name="customRadio2" class="form-check-input" disabled="">
                                    <label class="form-check-label" for="customRadio5">Toggle this custom radio</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadio6" name="customRadio2" class="form-check-input" checked="" disabled="">
                                    <label class="form-check-label" for="customRadio6">Or toggle this other custom radio</label>
                                </div>
                            </div>
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title mb-0">Colors</h5>
                        </x-card-header>
                        <x-card-body>
                            <div class="form-check mb-2">
                                <input type="radio" id="customRadiocolor1" name="customRadiocolor1" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor1">Default Radio</label>
                            </div>
                            <div class="form-check form-radio-success mb-2">
                                <input type="radio" id="customRadiocolor2" name="customRadiocolor2" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor2">Success Radio</label>
                            </div>
                            <div class="form-check form-radio-info mb-2">
                                <input type="radio" id="customRadiocolor3" name="customRadiocolor3" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor3">Info Radio</label>
                            </div>
                            <div class="form-check form-radio-secondary mb-2">
                                <input type="radio" id="customRadiocolor6" name="customRadiocolor6" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor6">Secondary Radio</label>
                            </div>
                            <div class="form-check form-radio-warning mb-2">
                                <input type="radio" id="customRadiocolor4" name="customRadiocolor4" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor4">Warning Radio</label>
                            </div>
                            <div class="form-check form-radio-danger mb-2">
                                <input type="radio" id="customRadiocolor5" name="customRadiocolor5" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor5">Danger Radio</label>
                            </div>
                            <div class="form-check form-radio-dark">
                                <input type="radio" id="customRadiocolor7" name="customRadiocolor7" class="form-check-input" checked="">
                                <label class="form-check-label" for="customRadiocolor7">Dark Radio</label>
                            </div>
                        </x-card-body>
                    </x-card>
                </x-col-6>

            </x-row>
        </x-container>
    </x-main-content>
</x-theme>