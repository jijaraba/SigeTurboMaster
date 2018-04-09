<section class="sige-dashboard">
    <ul class="display-horizontal dashboard-values">
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index')}}">
                <sigeturbo-dashboard-enrollments :statusschooltype="1"></sigeturbo-dashboard-enrollments>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[6]}"])}}">
                <sigeturbo-dashboard-enrollments :statusschooltype="6"></sigeturbo-dashboard-enrollments>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[12]}"])}}">
                <sigeturbo-dashboard-enrollments :statusschooltype="12"></sigeturbo-dashboard-enrollments>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[4]}"])}}">
                <sigeturbo-dashboard-enrollments :statusschooltype="4"></sigeturbo-dashboard-enrollments>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[13]}"])}}">
                <sigeturbo-dashboard-enrollments :statusschooltype="13"></sigeturbo-dashboard-enrollments>
            </a>
        </li>
    </ul>
</section>
