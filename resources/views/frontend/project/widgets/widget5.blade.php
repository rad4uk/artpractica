@if(count($widget->data->files) > 0)
    <div class="project-widget5">
        <div class="container">
            <div class="row">
                <div class="project-widget5__container">
                    <img src="{{asset('/storage/images/project/' . $widget->data->files[0])}}" alt="" class="project-widget5__container-img">
                </div>
            </div>
        </div>
        @if(isset($widget->data->text))
            <p class="project-widget5-text">
                {{$widget->data->text}}
            </p>
        @endif
    </div>
@endif
