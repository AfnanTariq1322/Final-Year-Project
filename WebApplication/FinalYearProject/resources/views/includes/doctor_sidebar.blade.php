<ul class="inflanar-dashboard-sidebar__menu">
    <li class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
        <a href="{{ route('doctor.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
        <a href="{{ route('doctor.appointments', ['status' => 'pending']) }}">
            <i class="fas fa-calendar-check"></i>
            <span>Appointments Requests</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('doctor.completedappointments') ? 'active' : '' }}">
        <a href="{{ route('doctor.completedappointments') }}">
            <i class="fas fa-check-circle"></i>
            <span>Appointments</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('doctor.fundus.analysis') ? 'active' : '' }}">
        <a href="{{ route('doctor.fundus.analysis') }}">
            <i class="fas fa-microscope"></i>
            <span>Fundus Analysis</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('doctor.profile') ? 'active' : '' }}">
        <a href="{{ route('doctor.profile') }}">
            <i class="fas fa-user-cog"></i>
            <span>Profile Settings</span>
        </a>
    </li>
    <li>
        <a href="{{ route('doctor.logout') }}">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
