@if(Auth::user()->isAdmin())
    @include('dashboard.admin')
@else
    @include('dashboard.warga')
@endif
