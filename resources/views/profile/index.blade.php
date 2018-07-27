@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}" />
                    <!-- badge -->
                    <div class="rank-label-container text-center">
                        <span class="label label-default rank-label">{{ $user->name }}</span>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row justify-content-center">
            <form action="{{ route('profile.update_avatar', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="row justify-content-center">
        <form id="formEditProfile" action="{{ route('profile.edit', ['id' => $user->id]) }}">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Edit Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection