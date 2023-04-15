<div class="project-widget2">
    <div class="container">
        <div class="row">
            <div class="project-widget2__container">
                @foreach($widget->files as $file)
                <div class="project-widget2-item">
                    <img src="{{asset('/storage/images/project/' . $file)}}" alt="" class="project-widget2__container-img">
                </div>
                @endforeach
            </div>
            @if(isset($widget->text) && mb_strlen($widget->text) > 0)
                <p class="project-widget2-text">
                    {{$widget->text}}
                </p>
            @endif
        </div>
    </div>
</div>
