@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
          <h2 class="dashboard-title">User</h2>
          <p class="dashboard-subtitle">Edit User</p>
      </div>
      <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama User</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Email User</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $item->email) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password User</label>
                                        <input type="password" name="password" class="form-control">
                                        <small class="text-info">Kosongkan jika tidak ingin ganti password !</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Roles</label>
                                        <select name="roles" id="" class="form-control" required>
                                            <option value="ADMIN" {{ $item->roles == "ADMIN" ? 'selected' : '' }}>Admin</option>
                                            <option value="USER" {{ $item->roles == "USER" ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary px-5 mr-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-success px-5">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection