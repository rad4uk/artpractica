@if(isset($widget->file))
    <div class="project-widget5">
        <div class="container">
            <div class="row">
                <div class="project-widget5__container">
                    <img src="{{asset('/storage/images/project/' . $widget->file)}}" alt="" class="project-widget5__container-img">
                </div>
            </div>
        </div>
        @if(isset($widget->text) && mb_strlen($widget->text) > 0)
            <p class="project-widget5-text">
                {{$widget->text}}
            </p>
        @endif
    </div>
@endif
