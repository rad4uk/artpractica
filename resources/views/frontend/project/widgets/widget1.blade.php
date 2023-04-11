<div class="project-widget1">
    <div class="container">
        <div class="row">
            <div class="project-widget1__container">
                <img src="{{asset('/storage/images/project/' . $widget->file)}}" alt="" class="project-widget1__container-img">
            </div>
            @if(isset($widget->text))
                <p class="project-widget1-text">
                    {{$widget->text}}
                </p>
            @endif
        </div>
    </div>
</div>
