@php
    $segment1 = request()->segment(1);
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
          <span class="app-brand-logo demo">
            <img height="50px" src="{{asset('assets/logo.png')}}"/>
          </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <x-menu-item icon="bx bx-grid-alt bx-sm" url="#" name="Dashboard"/>
        <x-menu-item-dropdown
            bi-icon="bi-building-gear"
            name="Course Management"
            :active="$segment1 == 'course' || $segment1 == 'course-topic' || $segment1 == 'course-topic-data' || $segment1 == 'course-topic-resource' "
            :visibility="true"
            :child="[
                [
                    'visibility' => true,
                    'active' => request()->routeIs('course.index'),
                    'url' => route('course.index'),
                    'name' => 'Course'
                ],
                [
                    'visibility' => true,
                    'active' => request()->routeIs('course_topic.index') || request()->routeIs('course_topic.edit') || request()->routeIs('course_topic.create'),
                    'url' => route('course_topic.index'),
                    'name' => 'Course Topic'
                ],
                [
                    'visibility' => true,
                    'active' => request()->routeIs('course_topic_data.index') || request()->routeIs('course_topic_data.edit') || request()->routeIs('course_topic_data.create'),
                    'url' => route('course_topic_data.index'),
                    'name' => 'Course Topic Data'
                ],
                [
                    'visibility' => true,
                    'active' => request()->routeIs('course_topic_resource.index') || request()->routeIs('course_topic_resource.edit') || request()->routeIs('course_topic_resource.create'),
                    'url' => route('course_topic_resource.index'),
                    'name' => 'Course Topic Resource'
                ],
            ]
        "/>


        <x-menu-item-dropdown
            bi-icon="bi-building-gear"
            name="Quick Tips"
            :active="$segment1 == 'quick-tips' "
            :visibility="true"
            :child="[
                [
                    'visibility' => true,
                    'active' => request()->routeIs('quick_tips.index'),
                    'url' => route('quick_tips.index'),
                    'name' => 'All'
                ],
            ]
        "/>

        <x-menu-item-dropdown
            bi-icon="bi-building-gear"
            name="Short Cuts"
            :active="$segment1 == 'short-cuts' "
            :visibility="true"
            :child="[
                [
                    'visibility' => true,
                    'active' => request()->routeIs('short_cuts.index'),
                    'url' => route('short_cuts.index'),
                    'name' => 'All'
                ],
            ]
        "/>


    </ul>


</aside>
<!-- / Menu -->
