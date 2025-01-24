@php $is_edit = request()->segment(2) == "edit"  @endphp
@extends('layouts.app')

@section('content')
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" name="Edit Short Cuts" :url="route('short_cuts.index')" url-name="Back"/>
            <form action="{{route('short_cuts.update', request()->id)}}" method="post" class="card-body" enctype="multipart/form-data">
                @csrf

                @include('short-cuts.form_data', compact('is_edit'))

                <div class="mb-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">
                        Save
                    </button>
                </div>


            </form>
        </div>
    </div>
@endsection
