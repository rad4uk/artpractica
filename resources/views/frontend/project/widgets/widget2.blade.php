<div class="project-widget2">
    <div class="container">
        <div class="row">
            <div class="project-widget2__container">
                @foreach($widget->data->files as $file)
                <div class="project-widget2-item">
                    <img src="{{asset('/storage/images/project/' . $file)}}" alt="" class="project-widget2__container-img">
                </div>
                @endforeach
            </div>
            @if(isset($widget->data->text))
                <p class="project-widget2-text">
                    {{$widget->data->text}}
                </p>
            @endif
        </div>
    </div>
</div>
