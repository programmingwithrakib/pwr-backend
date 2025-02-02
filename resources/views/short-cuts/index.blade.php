@extends('layouts.app')

@section('content')
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :url="route('short_cuts.create')" name="Short Cuts" url-name="Create">
                <x-slot:buttons>
                    <form action="{{route('short_cuts.index')}}" class="d-flex">
                        <div class="me-3">
                            <select name="course-id" class="form-control form-control-sm">
                                <option value="">select course</option>
                                @foreach($courses as $item)
                                    <option @if(request()->get('course-id') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-3">
                            <select name="course-topic-id" {{--onchange="$(this).parent().trigger('submit')"--}} class="form-control form-control-sm">
                                <option value="">select course topic</option>
                            </select>
                        </div>

                        <div class="me-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <script>
                        $('select[name=course-id]').on('change', function (){
                            let course_id = $(this).val();
                            getCourseWiseTopic(course_id)
                        })

                        @if($course_id = request()->get('course-id'))
                            getCourseWiseTopic('{{$course_id}}')
                        @endif


                        function getCourseWiseTopic(course_id){
                            let course_topic_el = $('select[name=course-topic-id]')
                            course_topic_el.empty();
                            course_topic_el.append(`<option value="">select course topic</option>`)
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

                </x-slot:buttons>
            </x-card-header>
            <div class="mt-3">
                {{--                <x-filter-data export-url="invoice.export" translate-from="db.users" :columns="$columns"/>--}}

                <div class="table-responsive table-paginate mt-2 text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>slug</th>
                            <th>Course</th>
                            <th>Topic</th>
                            <th>Description Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @php $index = \App\Helper::PageIndex() @endphp
                        @foreach ($short_cuts as $key=>$item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td></td>
                                <td title="{{$item->title}}">{{$item->slug}}</td>
                                <td>{{$item?->course?->name}}</td>
                                <td>{{$item?->course_topic?->name}}</td>
                                <td>{{$item->description_type}}</td>
                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-dark">In-Active</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>


                                        <div class="dropdown-menu" style="">
                                            <a data-bs-toggle="modal" data-bs-target="#viewModal" class="dropdown-item view-btn" href="javascript:void(0);" url="{{route('short_cuts.show', $item->id)}}"><i class='bx bx-low-vision me-1'></i>View</a>
                                            <a class="dropdown-item" href="{{route('short_cuts.edit', $item->id)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
{{--                                            <a class="dropdown-item" href="{{route('course_topic.changeStatus', $item->id)}}"><i class='bx bx-checkbox-minus'></i>Active</a>--}}
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" url="{{route('short_cuts.delete', $item->id)}}"  class="dropdown-item delete-btn" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <x-when-table-empty :data-length="$short_cuts->count()"/>
                </div>


                <div class="px-3 mt-3">
                    {{ $short_cuts->links() }}
                </div>
            </div>
        </div>
    </div>



    <x-view-modal title="Show User" size="modal-xl">
        <div id="modal-body"></div>
    </x-view-modal>

    <script>

        $('.view-btn').on('click', function (){
            modalLoaderON();
            let url = $(this).attr('url')
            axios({
                method: 'get',
                url: url
            })
                .then(function (response){
                    modalLoaderOFF();
                    const data = response.data;
                    $('#modal-body').html(data);
                })
                .catch(function (error){

                });
        })

    </script>

@endsection


