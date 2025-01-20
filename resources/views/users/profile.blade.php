@php $user = auth()->user(); @endphp
@extends('layouts.app')
@section('content')
    <div class="p-4">
        <div class="card">
{{--            <x-card-header :can-create="false" :name="__('page.profile')" :url="route('user.index')" :url-name="__('page.back')"/>--}}
            <form enctype="multipart/form-data" action="{{route('profile.update')}}" method="post" class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <x-input
                            title="Name"
                            name="name"
                            type="text"
                            :required="true"
                            :value="$user->name"
                        />
                    </div>

                    <div class="col-md-12">
                        <x-input
                            title="Email"
                            name="email"
                            type="email"
                            :disabled="true"
                            :required="false"
                            :value="$user->email"
                        />
                    </div>



                    <div class="col-md-12">
                        <x-input
                            title="Image"
                            name="file"
                            type="file"
                            :required="false"
                        />
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <img class="img-thumbnail img-thumbnail-shadow" width="200px"  src="{{auth()->user()->image}}"/>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="my-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">Save</button>
                </div>


            </form>
        </div>
    </div>
@endsection
