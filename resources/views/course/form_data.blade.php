@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<div class="row">
    <div class="col-md-12">
        <x-input
            title="Name"
            name="name"
            type="text"
            :required="true"
            :value="$is_edit ? $course->name : old('name')"
        />
    </div>



    <div class="col-md-12">
        <x-input
            title="Slug"
            name="slug"
            type="text"
            :required="true"
            :value="$is_edit ? $course->slug : old('slug')"
        />
    </div>

    <div class="col-md-12">
        <x-input
            title="Short Description"
            name="short_description"
            type="text-area"
            value="{{$is_edit ? $course->short_description : old('short_description')}}"
            :required="false"
        />
    </div>

    <div class="col-md-12">
        <x-input
            title="Video Count"
            name="video_count"
            value="{{$is_edit ? $course->video_count : old('video_count')}}"
            type="text"
            :required="true"
        />
    </div>

    <div class="col-md-12">
        <x-input
            title="Word Count"
            name="word_count"
            value="{{$is_edit ? $course->word_count : old('word_count')}}"
            type="text"
            :required="true"
        />
    </div>
    <div class="col-md-12">
        <x-input
            title="Publish Date"
            name="publish_date"
            value="{{$is_edit ? $course->publish_date : old('publish_date')}}"
            type="text"
            :required="true"
        />
    </div>

    <div class="col-md-12">
        <x-input
            title="Image"
            name="image"
            type="file"
            value=""
            :required="!$is_edit"
        />
    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            IS Paid
{{--            <x-required/>--}}
            <x-input-error name="is_paid"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="is_paid">
                <option @if($is_edit && !$course->is_paid) selected @endif value="0">Free</option>
                <option @if($is_edit && $course->is_paid) selected @endif value="1">Paid</option>
            </select>
        </div>

        {{--<x-input-select2
            title="Is Paid"
            name="is_paid"
            :is_required="false"
            :array="[ (object)['id' => 0, 'name' => 'Free'], (object)['id' => 1, 'name' => 'Paid']]"
            :multiple="false"
            :value="$is_edit ? $course->is_paid : old('is_paid')"
            :key="1"
        />--}}
    </div>
</div>
