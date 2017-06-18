@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
	<div class="profile">

			<!-- PROFILE HEADER -->
			<div class="profile-header">
				<div class="overlay"></div>
				<div class="profile-main">
					<img src="assets/img/user-medium.png" class="img-circle" alt="Avatar">
					<h3 class="name">{{ $member->name }}</h3>
					<span class="online-status status-available">Available</span>
				</div>
				<div class="profile-stat">
					<div class="row">
						<div class="col-md-4 stat-item">
							No <span>{{ $member->id_member }}</span>
						</div>
						<div class="col-md-4 stat-item">
							Nik <span>{{ $member->nik }}</span>
						</div>
						<div class="col-md-4 stat-item">
							Jabatan <span>{{ $member->role->name }}</span>
						</div>
					</div>
				</div>
			</div>
			<!-- END PROFILE HEADER -->

			<!-- PROFILE DETAIL -->
			<div class="profile-detail">
				<div class="profile-info">
					<h4 class="heading">Basic Info</h4>
					<ul class="list-unstyled list-justify">
						<li>Birthdate <span>{{ $member->date_of_birth }}</span></li>
						<li>Mobile <span>{{ $member->phone }}</span></li>
						<li>Email <span>{{ $member->email }}</span></li>
						<li>Jabatan <span>{{ $member->role->name }}</span></li>
						<li>Group <span>{{ $member->group->name }}</span></li>
						<li>Account Create <span>{{ $member->created_at }}</span></li>
					</ul>
				</div>
				<div class="text-center"><a href="{{ route('member.edit', $member->id) }}" type="button" class="btn btn-default btn-sm"><i class="lnr lnr-pencil"></i></a></div>
			</div>
			<!-- END PROFILE DETAIL -->
		</div>
@endsection