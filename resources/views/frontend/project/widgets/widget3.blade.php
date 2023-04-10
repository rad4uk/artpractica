<div class="project-widget3">
    <div class="container">
        <div class="row">
            <div class="project-widget3-container">
                @foreach($widget->data->files as $file)
                <div class="project-widget3__column">
                    <img src="{{asset('/storage/images/project/' . $file)}}" alt=""
                         class="project-widget3__column-image">
                </div>
                @endforeach
            </div>
            @if(isset($widget->data->text))
                <p class="project-widget3-text">
                    {{$widget->data->text}}
                </p>
            @endif
        </div>
    </div>
</div>
