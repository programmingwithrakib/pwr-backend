@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<div class="row">

    <x-input-select2
        title="Course"
        name="course_id"
        :is_required="true"
        :array="$courses"
        :multiple="false"
        :value="$is_edit ? $course_topic_resource->course_id : old('course_id')"
        :key="1"
    />

    <x-input-select2
        title="Course Topic"
        name="course_topic_id"
        :is_required="true"
        :array="$is_edit ? $course_topics : []"
        :multiple="false"
        :value="$is_edit ? $course_topic_resource->course_topic_id : old('course_topic_id')"
        :key="1"
    />

    <div class="col-md-12">
        <x-input
            title="title"
            name="title"
            type="text"
            value="{{$is_edit ? $course_topic_resource->title : old('title')}}"
            :required="true"
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
                <option @if($is_edit && !$course_topic_resource->is_paid) selected @endif value="0">Free</option>
                <option @if($is_edit && $course_topic_resource->is_paid) selected @endif value="1">Paid</option>
            </select>
        </div>

    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Show In
            <x-required/>
            <x-input-error name="show_in"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="show_in">
                <option @if($is_edit && $course_topic_resource->show_in == "external") selected @endif value="external">External</option>
                <option @if($is_edit && !$course_topic_resource->show_in == 'modal') selected @endif value="modal">Modal</option>
                <option @if($is_edit && $course_topic_resource->show_in == "internal") selected @endif value="internal">Internal</option>
            </select>
        </div>

    </div>

    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            Info Type
            <x-required/>
            <x-input-error name="info_type"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="info_type">
                <option @if($is_edit && !$course_topic_resource->info_type == 'text') selected @endif value="text">Text Editor Content</option>
                <option @if($is_edit && $course_topic_resource->info_type == "md") selected @endif value="md">.md File Content</option>
                <option @if($is_edit && $course_topic_resource->info_type == "link") selected @endif value="link">Link</option>
            </select>
        </div>

    </div>



    <div class="col-md-12">
        <x-input
            title="Information"
            name="info"
            type="text-area"
            value="{{$is_edit ? $course_topic_resource->info : old('info')}}"
            :required="false"
            rows="10"
        />
    </div>



    <script>
        $('select[name=course_id]').on('change', function (){
            let course_id = $(this).val();
            getCourseWiseTopic(course_id)
        })

        {{--@if($course_id = request()->get('course-id'))
        getCourseWiseTopic('{{$course_id}}')
        @endif--}}


        function getCourseWiseTopic(course_id){
            let course_topic_el = $('select[name=course_topic_id]')
            course_topic_el.empty();
            course_topic_el.append(`<option value="">Select</option>`)
            let route = "{{route('course.get_topics', 'x')}}".replace('x', course_id)
            axios.get(route).then(function (response){
                data = response.data;
                let route_course_id = '{{request()->get('course-topic-id')}}'
                data.forEach(function (item){
                    course_topic_el.append(`<option ${route_course_id == item.id ? 'selected' : ''}  value="${item.id}">${item.name}</option>`)
                })
            }).catch(function (error){

            })
        }
    </script>

</div>
