@extends('admin.layouts.app')
@section('title', 'All Users - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <!-- <h3 class="fw-bold mb-3">Create Category</h3> -->
            <ul class="breadcrumbs mb-3 p-0 m-0 border-0">
                <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                </a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>Users</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>All Users</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("admin.register") }}"'>
                Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
            @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> {{ Session::get('error') }}
            </div>
            @endif
                
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h4><i class="icon fa fa-check"></i> Success!</h4> {{ Session::get('success') }}
            </div>
            @endif
        </div>

        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title" style="white-space: nowrap;">Users List</div>
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="d-flex justify-content-end align-items-center">
                                    {{-- <div class="col-sm-12 col-md-8 text-end">
                                        <form id="filter-form" method="GET" action="{{ route('user.list') }}">
                                            <div class="dataTables_length" id="add-row_length">
                                                <label>
                                                    Show
                                                    <select name="add-row_length" onchange="document.getElementById('filter-form').submit()" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="1" {{ request('add-row_length') == 1 ? 'selected' : '' }}>1</option>
                                                        <option value="25" {{ request('add-row_length') == 25 ? 'selected' : '' }}>25</option>
                                                        <option value="50" {{ request('add-row_length') == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ request('add-row_length') == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                    entries
                                                </label>
                                            </div>
                                        </form>
                                    </div> --}}
                                    <div class="col-sm-12 col-md-4">
                                        <form action="" method="get">
                                            <div id="add-row_filter" class="dataTables_filter">
                                                <label>
                                                    Search:
                                                    <input type="search" name="keyword" value="{{ Request::get('keyword') }}" class="form-control form-control-sm" placeholder="Search here..." aria-controls="add-row" />
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
                                <li class="nav-item submenu" role="presentation">
                                <a
                                    class="nav-link active"
                                    id="line-home-tab"
                                    data-bs-toggle="pill"
                                    href="#line-home"
                                    role="tab"
                                    aria-controls="pills-home"
                                    aria-selected="true"
                                    >All({{ $allUsers->count() }})</a
                                >
                                </li>
                                <li class="nav-item submenu" role="presentation">
                                <a
                                    class="nav-link"
                                    id="line-profile-tab"
                                    data-bs-toggle="pill"
                                    href="#line-profile"
                                    role="tab"
                                    aria-controls="pills-profile"
                                    aria-selected="false"
                                    tabindex="-1"
                                    >Active({{ $activeUsers->count() }})</a
                                >
                                </li>
                                <li class="nav-item submenu" role="presentation">
                                <a
                                    class="nav-link"
                                    id="line-contact-tab"
                                    data-bs-toggle="pill"
                                    href="#line-contact"
                                    role="tab"
                                    aria-controls="pills-contact"
                                    aria-selected="false"
                                    tabindex="-1"
                                    >Block({{ $bannedUsers->count() }})</a
                                >
                                </li>
                            </ul>
                            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                                <div class="tab-pane fade active show" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($allUsers->isNotEmpty())
                                                    @foreach ($allUsers as $allUser)                                                   
                                                        <tr>
                                                            <td>{{ $allUser->name }}</td>
                                                            <td>{{ $allUser->email }}</td>
                                                            <td>{{ $allUser->phone }}</td>
                                                            <td style="text-transform: capitalize">{{ $allUser->role }}</td>
                                                            <td>
                                                                @if ($allUser->status == 'active')
                                                                {{-- <i class="fa-solid fa-circle-check" style="color: #31ce36;"></i> --}}
                                                                    <button class="btn btn-icon btn-link btn-success op-8">
                                                                        <i class="far fa-check-circle"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                                                        <i class="fas fa-ban"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('user.edit', $allUser->id) }}">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg p-0"
                                                                            data-original-title="Edit Task"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger p-0 ps-4" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>                          
                                    </div>
                                    <div>
                                        {{ $allUsers->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="line-profile" role="tabpanel" aria-labelledby="line-profile-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if (!empty($activeUsers))
                                                    @foreach ($activeUsers as $activeUser)                                                   
                                                        <tr>
                                                            <td>{{ $activeUser->name }}</td>
                                                            <td>{{ $activeUser->email }}</td>
                                                            <td>{{ $activeUser->phone }}</td>
                                                            <td class="text-capitalize">{{ $activeUser->role }}</td>
                                                            <td>
                                                                @if ($activeUser->status == 'active')
                                                                {{-- <i class="fa-solid fa-circle-check" style="color: #31ce36;"></i> --}}
                                                                    <button class="btn btn-icon btn-link btn-success op-8">
                                                                        <i class="far fa-check-circle"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                                                        <i class="fas fa-ban"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('user.edit', $activeUser->id) }}">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg p-0"
                                                                            data-original-title="Edit Task"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger p-0 ps-4" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        {{ $activeUsers->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="line-contact" role="tabpanel" aria-labelledby="line-contact-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if (!empty($bannedUsers))
                                                    @foreach ($bannedUsers as $bannedUser)                                                   
                                                        <tr>
                                                            <td>{{ $bannedUser->name }}</td>
                                                            <td>{{ $bannedUser->email }}</td>
                                                            <td>{{ $bannedUser->phone }}</td>
                                                            <td class="text-capitalize">{{ $bannedUser->role }}</td>
                                                            <td>
                                                                @if ($bannedUser->status == 'active')
                                                                    <button class="btn btn-icon btn-link btn-success op-8">
                                                                        <i class="far fa-check-circle"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                                                        <i class="fas fa-ban"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('user.edit', $bannedUser->id) }}">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg p-0"
                                                                            data-original-title="Edit Task"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger p-0 ps-4" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>   
                                    </div>
                                    <div>
                                        {{ $bannedUsers->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection