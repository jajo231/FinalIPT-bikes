@extends('base')

@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h1 class="display-4">System Logs</h1>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header bg-teal-800 text-white">
            <strong>System Logs</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="custom-table table table-bordered table-striped">
                    <thead class="bg-teal text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Log Entry</th>
                            <th scope="col">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <th scope="row">{{ $log->id }}</th>
                            <td>{{ $log->log_entry }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    .custom-table th, .custom-table td {
        padding: 10px;
        text-align: left;
    }

    .custom-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:hover {
        background-color: #ddd;
    }
    .bg-teal-800 {
        background-color: #004d4d;
    }
</style>
@endsection
