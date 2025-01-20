@php $is_edit = isset($is_edit) ? $is_edit : false;  @endphp

<div class="row">

    <x-input-select2
        title="Course"
        name="course_id"
        :is_required="true"
        :array="$courses"
        :multiple="false"
        :value="$is_edit ? $course_topic_data->course_id : old('course_id')"
        :key="1"
    />

    <x-input-select2
        title="Course Topic"
        name="course_topic_id"
        :is_required="true"
        :array="$is_edit ? $course_topics : []"
        :multiple="false"
        :value="$is_edit ? $course_topic_data->course_topic_id : old('course_topic_id')"
        :key="1"
    />



    <div class="col-md-12 mb-3 row">
        <label class="col-2 col-form-label">
            IS Paid
            <x-required/>
            <x-input-error name="is_paid"/>
        </label>
        <div class="col-10">
            <select class="form-control" name="is_paid">
                <option @if($is_edit && !$course_topic_data->is_paid) selected @endif value="0">Free</option>
                <option @if($is_edit && $course_topic_data->is_paid) selected @endif value="1">Paid</option>
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
                <option @if($is_edit && !$course_topic_data->description_type == 'text') selected @endif value="text">Text Editor Content</option>
                <option @if($is_edit && $course_topic_data->description_type == "md") selected @endif value="md">.md File Content</option>
            </select>
        </div>

    </div>



    <div class="col-md-12">
        <x-input
            title="description"
            name="description"
            type="text-area"
            value="{{$is_edit ? $course_topic_data->description : old('description')}}"
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
