@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<div class="row">

    <x-input-select2
        title="Course"
        name="course_id"
        :is_required="true"
        :array="$courses"
        :multiple="false"
        :value="$is_edit ? $course_topic->course_id : old('course_id')"
        :key="1"
    />

    <div class="col-md-12">
        <x-input
            title="Name"
            name="name"
            type="text"
            :required="true"
            :value="$is_edit ? $course_topic->name : old('name')"
        />
    </div>



    <div class="col-md-12">
        <x-input
            title="Slug"
            name="slug"
            type="text"
            :required="true"
            :value="$is_edit ? $course_topic->slug : old('slug')"
        />
    </div>


    <div class="col-md-12">
        <x-input
            title="time duration"
            name="time_duration"
            type="text"
            value="{{$is_edit ? $course_topic->time_duration : old('time_duration')}}"
            :required="false"
        />
    </div>

    <div class="col-md-12">
        <x-input
            title="video link"
            name="video_link"
            type="text"
            value="{{$is_edit ? $course_topic->video_link : old('video_link')}}"
            :required="false"
        />
    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Video Type
            <x-required/>
            <x-input-error name="video_type"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="video_type">
                <option @if($is_edit && !$course_topic->video_type == "youtube") selected @endif value="youtube">youtube</option>
                <option @if($is_edit && !$course_topic->video_type == "vimeo") selected @endif value="vimeo">vimeo</option>
                <option @if($is_edit && !$course_topic->video_type == "local") selected @endif value="local">local</option>
                <option @if($is_edit && !$course_topic->video_type == "others") selected @endif value="others">others</option>
            </select>
        </div>

    </div>

    <div class="col-md-12">
        <x-input
            title="Image"
            name="image"
            type="file"
            value=""
            :required="false"
        />
    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Play As
            <x-required/>
            <x-input-error name="play_as"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="play_as">
                <option @if($is_edit && !$course_topic->play_as == "video") selected @endif value="video">video</option>
                <option @if($is_edit && !$course_topic->play_as == "image") selected @endif value="image">image</option>
                <option @if($is_edit && !$course_topic->play_as == "none") selected @endif value="none">none</option>
            </select>
        </div>

    </div>


    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            IS Paid
            <x-required/>
            <x-input-error name="is_paid"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="is_paid">
                <option @if($is_edit && !$course_topic->is_paid) selected @endif value="0">Free</option>
                <option @if($is_edit && $course_topic->is_paid) selected @endif value="1">Paid</option>
            </select>
        </div>

    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Description Type
            <x-required/>
            <x-input-error name="description_type"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="description_type">
                <option @if($is_edit && !$course_topic->description_type == 'text') selected @endif value="text">Text Editor Content</option>
                <option @if($is_edit && $course_topic->description_type == "md") selected @endif value="md">.md File Content</option>
            </select>
        </div>

    </div>



    <div class="col-md-12">
        <x-input
            title="description"
            name="description"
            type="text-area"
            value="{{$is_edit ? $course_topic->description : old('short_description')}}"
            :required="false"
            rows="10"
        />
    </div>



</div>
