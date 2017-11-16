<section class="sige-dashboard">
    <ul class="display-horizontal dashboard-values">
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index')}}">
                <sige-turbo-dashboard-enrollments-active></sige-turbo-dashboard-enrollments-active>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[6]}"])}}">
                <sige-turbo-dashboard-enrollments-internship></sige-turbo-dashboard-enrollments-internship>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[12]}"])}}">
                <sige-turbo-dashboard-enrollments-pending></sige-turbo-dashboard-enrollments-pending>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[4]}"])}}">
                <sige-turbo-dashboard-enrollments-retired></sige-turbo-dashboard-enrollments-retired>
            </a>
        </li>
        <li class="col-20">
            <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[13]}"])}}">
                <sige-turbo-dashboard-enrollments-psychology></sige-turbo-dashboard-enrollments-psychology>
            </a>
        </li>
    </ul>
</section>
