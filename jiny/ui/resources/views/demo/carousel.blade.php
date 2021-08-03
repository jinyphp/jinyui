<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <h1 class="h3 mb-3">Carousel</h1>
            
            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            Slides Only
                        </x-card-header>
                        <x-card-body>
                            <x-carousel>

                                <x-carousel-item class="active">
                                    <img src="/img/photos/unsplash-1.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                

                            </x-carousel>
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            With controls
                        </x-card-header>
                        <x-card-body>
                            <x-carousel controls>
                                <x-carousel-item class="active">
                                    <img src="/img/photos/unsplash-1.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                            </x-carousel>
                        </x-card-body>
                    </x-card>                  
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            With indicators
                        </x-card-header>
                        <x-card-body>
                            <x-carousel controls indicator >
                                <x-carousel-item class="active">
                                    <img src="/img/photos/unsplash-1.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
    
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                            </x-carousel>
                        </x-card-body>
                    </x-card>
                    
            
                </x-col-6>



                <x-col-6>
                    <x-card>
                        <x-card-header>
                            With captions
                        </x-card-header>
                        <x-card-body>
                            <x-carousel controls indicator >
                                <x-carousel-item class="active">
                                    <img src="/img/photos/unsplash-1.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>First slide label</h5>
                                        <p>Some representative placeholder content for the first slide.</p>
                                    </div>
                                </x-carousel-item>
    
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Second slide label</h5>
                                        <p>Some representative placeholder content for the second slide.</p>
                                    </div>
                                </x-carousel-item>
                                
                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Some representative placeholder content for the third slide.</p>
                                    </div>
                                </x-carousel-item>
                            </x-carousel>

                        </x-card-body>

                    </x-card>
                    

                    
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            Crossfade
                        </x-card-header>
                        <x-card-body>
                            <x-carousel controls class="carousel-fade">
                                <x-carousel-item class="active">
                                    <img src="/img/photos/unsplash-1.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-2.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>

                                <x-carousel-item>
                                    <img src="/img/photos/unsplash-3.jpg" class="d-block w-100" alt="...">
                                </x-carousel-item>
                                
                            </x-carousel>

                          
                        </x-card-body>
                    </x-card>
                    

                    
                </x-col-6>
            </x-row>
        </x-container>
    </x-main-content>
</x-theme>