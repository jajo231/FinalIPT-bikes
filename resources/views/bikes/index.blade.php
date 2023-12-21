@extends('base')

@section('content')
<div class="container mt-4 mb-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="text-xl leading-6 font-semibold text-gray-900">Bike Listings</h4>
        </div>
        <div class="card-body">
            @role('admin')
            <div class="mb-3 text-end">
                <a href="{{ route('bikes.create') }}" class="btn btn-success">Add New Bike</a>
            </div>
            @endrole
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3">Image</th>
                            <th class="py-3">Make and Model</th>
                            <th class="py-3">Year</th>
                            <th class="py-3">Stock</th>
                            <th class="py-3">Description</th>
                            @role('admin')
                            <th class="py-3">Actions</th>
                            @endrole
                            @role('client')
                            <th class="py-3">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bikes as $bike)
                            <tr>
                                <td>
                                    <img src="{{ asset($bike->image) }}" alt="{{ $bike->make }} {{ $bike->model }}" style="max-height: 100px;" class="rounded-lg">
                                </td>
                                <td class="font-semibold">{{ $bike->make }} {{ $bike->model }}</td>
                                <td>{{ $bike->year }}</td>
                                <td>{{ $bike->stocks }}</td>
                                <td>{{ $bike->description }}</td>
                                @role('admin')
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('bikes.destroy', $bike->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bike?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endrole
                                @role('client')
                                <td>
                                    <form action="{{ route('bikes.buy', $bike->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirmStock({{ $bike->stocks }});">
                                            <i class="fas fa-shopping-cart"></i> Buy
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmStock(stocks) {
        if (stocks <= 0) {
            alert('Sorry, this bike is out of stock.');
            return false;
        }

        return confirm('Are you sure you want to buy this bike?');
    }
</script>
