@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.UserLayout')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <form method="POST" action="{{ route('user.profile.update', Auth::user()->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">

              @php
                $user = Auth::user();
              @endphp

              <div class="row mb-3">
                <div class="col-sm-3"><label class="mb-0">Full Name</label></div>
                <div class="col-sm-9">
                  <input type="text" name="fullname" class="form-control" value="{{ $user->fullname }}" disabled>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3"><label class="mb-0">Email</label></div>
                <div class="col-sm-9">
                  <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3"><label class="mb-0">Phone</label></div>
                <div class="col-sm-9">
                    <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" disabled>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-sm-3"><label class="mb-0">Address</label></div>
                <div class="col-sm-9">
                  <input type="text" name="address" class="form-control" value="{{ $user->address }}" disabled>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div> <!-- /.row -->

      <div class="row">
        <div class="col text-end">
          <button type="button" class="btn btn-warning me-2" onclick="enableEdit()">
            <i class="fas fa-edit"></i> Edit
          </button>
          <button type="submit" class="btn btn-success" id="saveBtn" disabled>
            <i class="fas fa-save"></i> Save Changes
          </button>
        </div>
      </div>

    </form>
  </div>
</section>

<script>

  function enableEdit() {
    document.querySelectorAll('input, textarea').forEach(el => {
      el.removeAttribute('disabled');
    });
    // Bật nút lưu
    document.getElementById('saveBtn').removeAttribute('disabled');
  }
</script>
@endsection