<li class="nav-item"><a class="nav-link text-start py-1 px-0 {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt mx-3 fa-lg"></i><span class="text-nowrap mx-2">Dashboard</span></a></li>
<li class="nav-item"><a class="nav-link text-start py-1 px-0 {{ request()->routeIs('templates') ? 'active' : '' }}" href="{{ route('templates') }}"><i class="fas fa-newspaper mx-3 fa-lg"></i><span class="text-nowrap mx-2">Controlled Forms</span></a></li>
<li class="nav-item">
    <a class="nav-link text-start py-1 px-0 {{ request()->routeIs('manuals') ? 'active' : '' }}" href="{{ route('manuals') }}">
        <i class="fas fa-book mx-3 mx-3 mx-3 fa-lg"></i><span class="text-nowrap mx-2">Manuals</span>
    </a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link text-start py-1 px-0 {{ request()->routeIs('evidences') ? 'active' : '' }}" href="{{ route('evidences') }}">
        <i class="fas fa-receipt mx-3 mx-3 mx-3 fa-lg"></i><span class="text-nowrap mx-2">Evidences</span>
    </a>
</li> --}}
<li class="nav-item dropdown {{ request()->is('po/evidence*') || request()->is('evidences*') ? 'active' : '' }}">
    <a data-bs-auto-close="false" class="dropdown-toggle nav-link text-start py-1 px-0 position-relative" aria-expanded="true" data-bs-toggle="dropdown" href="#"><i class="fas fa-receipt mx-3 fa-lg"></i><span class="text-nowrap mx-2">Evidences</span><i class="fas fa-caret-down float-none float-lg-end me-3"></i></a>
    <div class="dropdown-menu drop-menu border-0 animated fadeIn {{ request()->is('po/evidence*') || request()->is('evidences*') ? 'show' : '' }}" data-bs-popper="none">
        <a class="dropdown-item {{ request()->is('evidences*') ? 'active' : '' }}" href="{{ route('evidences') }}"><span>Evidence List</span></a>
        <a class="dropdown-item {{request()->routeIs('dcc.access.evidence.create') ? 'active' : '' }}" href="{{ route('dcc.access.evidence.create') }}"><span>Add Evidence</span></a>
    </div>
</li>
<!-- <li class="nav-item"><a class="nav-link text-start py-1 px-0 {{ request()->routeIs('archives-shared') ? 'active' : '' }}" href="{{ route('archives-shared') }}"><i class="fas fa-share mx-3 mx-3"></i><span class="text-nowrap mx-2">Shared with me</span></a></li> -->
<li class="nav-item"><a class="nav-link text-start py-1 px-0 {{ request()->is('archives*') ? 'active' : '' }}" href="{{ route('archives-page') }}"><i class="fas fa-archive mx-3 fa-lg"></i><span class="text-nowrap mx-2">Archive</span></a></li>

