@extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
          <h2 class="dashboard-title">Transaction</h2>
          <p class="dashboard-subtitle">Edit Transaction</p>
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
                        <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <select name="users_id" class="form-control">
                                            <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Transaction Status</label>
                                        <select name="transaction_status" class="form-control">
                                            <option value="PENDING" {{ $item->transaction_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                            <option value="SHIPPING" {{ $item->transaction_status == 'SHIPPING' ? 'selected' : '' }}>SHIPPING</option>
                                            <option value="SUCCESS" {{ $item->transaction_status == 'SUCCESS' ? 'selected' : '' }}>SUCCESS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Total Price</label>
                                        <input type="number" name="total_price" class="form-control" value="{{ $item->total_price }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('transaction.index') }}" class="btn btn-secondary px-5 mr-2">
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
