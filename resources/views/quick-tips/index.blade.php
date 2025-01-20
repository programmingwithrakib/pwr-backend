
@extends('layouts.app')

@section('content')
    <div class="p-4">
        <div class="card">
            <x-card-header :can-create="true" :url="route('course_topic.create')" name="Course Topics" url-name="Create">
                <x-slot:buttons>
                    <form action="{{route('course_topic.index')}}">
                        <select name="course-id" onchange="$(this).parent().trigger('submit')" class="form-control me-2 form-control-sm">
                            <option value="">select course</option>
                            @foreach($courses as $item)
                                <option @if(request()->get('course-id') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </x-slot:buttons>
            </x-card-header>
            <div class="mt-3">
                {{--                <x-filter-data export-url="invoice.export" translate-from="db.users" :columns="$columns"/>--}}

                <div class="table-responsive table-paginate mt-2 text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Paid Status</th>
                            <th>Time</th>
                            <th>Play AS</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @php $index = \App\Helper::PageIndex() @endphp
                        @foreach ($course_topics as $key=>$item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td>
                                    <img style="height: 60px" class="img-fluid img-thumbnail" src="{{$item->image}}" alt="">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->course->name}}</td>
                                <td>
                                    @if($item->is_paid)
                                        <span class="badge bg-dark">Paid</span>
                                    @else
                                        <span class="badge bg-success">Free</span>
                                    @endif
                                </td>

                                <td>{{$item->time_duration}}</td>
                                <td>{{$item->play_as}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>


                                        <div class="dropdown-menu" style="">
                                            <a data-bs-toggle="modal" data-bs-target="#viewModal" class="dropdown-item view-btn" href="javascript:void(0);" url="{{route('course_topic.show', $item->id)}}"><i class='bx bx-low-vision me-1'></i>View</a>
                                            <a class="dropdown-item" href="{{route('course_topic.edit', $item->id)}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
{{--                                            <a class="dropdown-item" href="{{route('course_topic.changeStatus', $item->id)}}"><i class='bx bx-checkbox-minus'></i>Active</a>--}}
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" url="{{route('course_topic.delete', $item->id)}}"  class="dropdown-item delete-btn" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <x-when-table-empty :data-length="$course_topics->count()"/>
                </div>


                <div class="px-3 mt-3">
                    {{ $course_topics->links() }}
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


