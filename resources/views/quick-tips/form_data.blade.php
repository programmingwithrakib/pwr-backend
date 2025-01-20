@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<div class="row">

    <x-input-select2
        title="Course"
        name="course_id"
        :is_required="true"
        :array="$courses"
        :multiple="false"
        :value="$is_edit ? $quick_tip->course_id : old('course_id')"
        :key="1"
    />

    <div class="col-md-12">
        <x-input
            title="Title"
            name="title"
            type="text"
            :required="true"
            :value="$is_edit ? $quick_tip->title : old('title')"
        />
    </div>



    <div class="col-md-12">
        <x-input
            title="Slug"
            name="slug"
            type="text"
            :required="true"
            :value="$is_edit ? $quick_tip->slug : old('slug')"
        />
    </div>




    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            IS Paid
            <x-required/>
            <x-input-error name="is_paid"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="is_paid">
                <option @if($is_edit && !$quick_tip->is_paid) selected @endif value="0">Free</option>
                <option @if($is_edit && $quick_tip->is_paid == 1) selected @endif value="1">Paid</option>
            </select>
        </div>

    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Status
            <x-required/>
            <x-input-error name="status"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="status">
                <option @if($is_edit && !$quick_tip->status) selected @endif value="1">Active</option>
                <option @if($is_edit && $quick_tip->status == 0) selected @endif value="0">In-Active</option>
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
                <option @if($is_edit && !$quick_tip->description_type == 'text') selected @endif value="text">Text Editor Content</option>
                <option @if($is_edit && $quick_tip->description_type == "md") selected @endif value="md">.md File Content</option>
            </select>
        </div>

    </div>



    <div class="col-md-12">
        <x-input
            title="description"
            name="description"
            type="text-area"
            value="{{$is_edit ? $quick_tip->description : old('short_description')}}"
            :required="false"
            rows="10"
        />
    </div>



</div>
