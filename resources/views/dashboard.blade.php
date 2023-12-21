@extends('base')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center custom-card primary-card">
                <div class="card-header">
                    <i class="fas fa-bicycle fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Bikes</h5>
                    <p class="card-text">{{ $bikeCount }}</p>
                </div>
                <div class="card-footer">
                    <small>Updated: {{ now()->format('F d, Y') }}</small>
                </div>
            </div>
        </div>

        @role('admin')
        <div class="col-md-4">
            <div class="card text-center custom-card success-card">
                <div class="card-header">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $userCount }}</p>
                </div>
                <div class="card-footer">
                    <small>Updated: {{ now()->format('F d, Y') }}</small>
                </div>
            </div>
        </div>
        @endrole

        <div class="col-md-4">
            <div class="card text-center custom-card info-card">
                <div class="card-header">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Bikes Sold</h5>
                    <p class="card-text">{{ $successfulBikePurchases }}</p>
                </div>
                <div class="card-footer">
                    <small>Updated: {{ now()->format('F d, Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 800px;
    }

    .custom-card {
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border: 2px solid #fff;
        transition: transform 0.3s;
        background: linear-gradient(45deg, #00bcd4, #2979ff);
        color: white;
    }

    .custom-card:hover {
        transform: translateY(-5px);
    }

    .custom-card .card-header {
        background: rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
