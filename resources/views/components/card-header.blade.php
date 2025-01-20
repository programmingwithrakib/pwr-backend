<div class="d-flex pe-4 justify-content-between align-items-center">
    <h5 class="card-header">{{$attributes->get('name')}}</h5>

    <div>
        {{$slot}}
    </div>

    @if($attributes->get('can-create'))
        <div class="d-flex align-items-center">

            @isset($buttons)
                {{$buttons}}
            @endisset

            <a href="{{$attributes->get('url')}}" type="button" class="btn btn-sm btn-primary">
                {{$attributes->get('url-name')}}
            </a>
        </div>
    @endif


</div>
<hr class="m-0">
