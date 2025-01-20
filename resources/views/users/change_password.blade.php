@php $user = auth()->user(); @endphp

@extends('layouts.app')
@section('content')
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="false" name="Change Password" />
            <form action="{{route('profile.change_password')}}" method="post" class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <x-input
                            title="old password"
                            name="old_password"
                            type="text"
                            value=""
                            :required="true"
                        />
                    </div>

                    <div class="col-md-12">
                        <x-input
                            title="new password"
                            name="new_password"
                            value=""
                            type="text"
                            :required="true"
                        />
                    </div>

                    <div class="col-md-12">
                        <x-input
                            title="confirm password"
                            name="confirm_new_password"
                            value=""
                            type="text"
                            :required="true"
                        />
                    </div>
                </div>


                <div class="my-3 row">
                    <label for="html5-datetime-local-input" class="col-md-2 col-form-label"></label>
                    <button type="submit" class="btn btn-primary col-2">
                        Save
                    </button>
                </div>


            </form>
        </div>
    </div>
@endsection
