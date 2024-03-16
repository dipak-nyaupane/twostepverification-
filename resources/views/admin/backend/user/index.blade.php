@extends('admin.master')
@section('admin')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <!-- add content here -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-success text-white-all">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Manage Users</li>
                    </ol>
                </nav>
                <br>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Search by Name">
                    </div>
                    <div class="col-md-4">
                        <select name="user_role" class="form-control" id="user-role">
                            <option value="">Filter by User Role</option>
                            @foreach ($userRole as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-end" id="filter-button-container" style="display: none;">
                        <button class="btn btn-primary btn-sm w-100" id="filter-btn">Filter</button>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-start">
                        <a href="{{ route('create.users') }}" class="btn btn-primary btn-sm w-100"
                            data-target=".bd-example-modal-lg"><i class="fas fa-user-plus"></i>&nbsp; Add New User</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="user-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Images</th>
                                                <th>User Role</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <img alt="image" width="45"
                                                            src="{{ asset('storage/' . $user->profile_photo) }}"
                                                            class="">
                                                    </td>
                                                    <td data-role-id="{{ $user->user_role }}">
                                                        @foreach ($userRole as $role)
                                                            @if ($user->user_role == $role->id)
                                                                {{ $role->name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($genders as $gender)
                                                            @if ($user->gender == $gender->id)
                                                                {{ $gender->name }}
                                                            @endif
                                                        @endforeach
                                                        {{ $user->gender }}
                                                    </td>
                                                    <td>
                                                        <button value="{{ $user->id }}"
                                                            class="btn btn-primary editbtn">Edit</button>
                                                        <button class="btn btn-danger deletebtn"> Delete User</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- No results found message -->
                                <div class="row" id="no-results-row" style="display: none; text-align: center; margin-top: 20px;">
                                    <div class="col-12">
                                        <p style="color: red; font-weight: bold;">No results found.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#name, #user-role").on("input", function() {
                var nameValue = $("#name").val().trim();
                var userRoleValue = $("#user-role").val();

                if (nameValue !== '' || userRoleValue !== '') {
                    $("#filter-button-container").show();
                } else {
                    $("#filter-button-container").hide();
                }
            });

            $("#filter-btn").click(function() {
                var nameValue = $("#name").val().toLowerCase();
                var userRoleValue = $("#user-role").val();

                $("#user-table tbody tr").each(function() {
                    var userName = $(this).find("td:nth-child(2)").text().toLowerCase();
                    var userRole = $(this).find("td:nth-child(5)").data('role-id');

                    if ((nameValue === '' || userName.includes(nameValue)) &&
                        (userRoleValue === '' || userRole == userRoleValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Show no results message if all rows are hidden
                if ($("#user-table tbody tr:visible").length === 0) {
                    $("#no-results-row").show();
                } else {
                    $("#no-results-row").hide();
                }
            });
        });
    </script>
@endsection
