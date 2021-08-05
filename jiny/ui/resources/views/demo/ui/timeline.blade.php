<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <h1 class="h3">TimeLine</h1>

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-header>

                        </x-card-header>
                        <x-card-body>
                            <ul class="timeline mt-2 mb-0">
                                <li class="timeline-item">
                                    <strong>Signed out</strong>
                                    <span class="float-end text-muted text-sm">30m ago</span>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                </li>
                                <li class="timeline-item">
                                    <strong>Created invoice #1204</strong>
                                    <span class="float-end text-muted text-sm">2h ago</span>
                                    <p>Sed aliquam ultrices mauris. Integer ante arcu...</p>
                                </li>
                                <li class="timeline-item">
                                    <strong>Discarded invoice #1147</strong>
                                    <span class="float-end text-muted text-sm">3h ago</span>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                </li>
                                <li class="timeline-item">
                                    <strong>Signed in</strong>
                                    <span class="float-end text-muted text-sm">3h ago</span>
                                    <p>Curabitur ligula sapien, tincidunt non, euismod vitae...</p>
                                </li>
                                <li class="timeline-item">
                                    <strong>Signed up</strong>
                                    <span class="float-end text-muted text-sm">2d ago</span>
                                    <p>Sed aliquam ultrices mauris. Integer ante arcu...</p>
                                </li>
                            </ul>
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            Json Data 
                        </x-card-header>
                        <x-card-body>
                            @php
                            $timeline = '[
                                {"time":"30m ago","title":"Signed out","description":"Nam pretium turpis et arcu. Duis arcu tortor, suscipit..."},
                                {"time":"2h ago","title":"Created invoice #1204","description":"Sed aliquam ultrices mauris. Integer ante arcu..."},
                                {"time":"3h ago","title":"Discarded invoice #1147","description":"Nam pretium turpis et arcu. Duis arcu tortor, suscipit..."},
                                {"time":"3h ago","title":"Signed in","description":"Curabitur ligula sapien, tincidunt non, euismod vitae..."},
                                {"time":"2d ago","title":"Signed up","description":"Sed aliquam ultrices mauris. Integer ante arcu..."}
                            ]';
                        @endphp
                        <ul class="timeline mt-2 mb-0">
                            @foreach (json_decode($timeline, true) as $item)
                                <li class="timeline-item">
                                    <strong>{{$item['title']}}</strong>
                                    <span class="float-end text-muted text-sm">{{$item['time']}}</span>
                                    <p>{{$item['description']}}</p>
                                </li>
                            @endforeach
                        </ul>
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>
        </x-container>
    </x-main-content>
</x-theme>