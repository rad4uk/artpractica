
<div class="project-widget1">
    <div class="container">
        <div class="row">
            <div class="project-widget1__container">
                <img src="{{asset('/storage/images/project/' . $widget->data->files[0])}}" alt="" class="project-widget1__container-img">
            </div>
            @if(isset($widget->data->text))
                <p class="project-widget1-text">
                    {{$widget->data->text}}
                </p>
            @endif
        </div>
    </div>
</div>
