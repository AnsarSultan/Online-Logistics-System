<div class="admin-sidebar">
    <a href="{{route('admin.dashboard')}}" >
        <image src="{{ URL('images\admin.png')}}" class="admin-sidebar-image"><p>Dashboard</p>
    </a>
    <a href="{{route('locations')}}" >
        <image src="{{ URL('images\cities.png')}}" class="admin-sidebar-image"><p>Manage Cities & Rates</p>
    </a>
    <a href="{{route('admin.panel')}}" id="admin-active">
        <image src="{{ URL('images\freights.png')}}" class="admin-sidebar-image"> <p>Freights</p>
    </a>
    <a href="{{route('manage.trips')}}">
        <image src="{{ URL('images\trip.png')}}" class="admin-sidebar-image"><p>Trips</p>
    </a>
    <a href="{{route('manage.expense')}}">
        <image src="{{ URL('images\expense.png')}}" class="admin-sidebar-image"><p>Expense</p>
    </a>
    <a href="{{route('manage.income')}}">
        <image src="{{ URL('images\income.png')}}" class="admin-sidebar-image"> <p>Income</p>
    </a>
    <a href="{{route('manage.driver')}}">
        <image src="{{ URL('images\driver.png')}}" class="admin-sidebar-image"><p>Driver</p>
    </a>
    <a href="{{route('manage.vehicle')}}">
        <image src="{{ URL('images\vehicle.png')}}" class="admin-sidebar-image"><p>Vehicle</p>
    </a>
    <a href="{{route('generate.report')}}">
        <image src="{{ URL('images\report.png')}}" class="admin-sidebar-image"><p>Generate report</p>
    </a>
</div>