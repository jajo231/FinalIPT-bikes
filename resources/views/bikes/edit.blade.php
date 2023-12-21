@extends('base')

@section('content')
<div class="container mx-auto max-w-md mt-4">
    <div class="text-right">
        <a href="{{ route('bikes.index') }}" class="btn btn-secondary m-3">Back</a>
    </div>
    <div class="bg-white shadow-md rounded p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Bike</h1>
        <form action="{{ route('bikes.update', $bike->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Add the method spoofing for PUT request -->
            <input type="hidden" name="bike_id" value="{{ $bike->id }}"> <!-- Add a hidden input for  ID -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">Bike Image:</label>
                <input type="file" class="border rounded py-2 px-3 w-full" id="image" name="image" accept="image/*">
            </div>
            <div class="mb-4">
                <label for="model" class="block text-gray-700 font-semibold">Model:</label>
                <input type="text" class="border rounded py-2 px-3 w-full" id="model" name="model" value="{{ $bike->model }}" required>
            </div>
            <div class="mb-4">
                <label for="make" class="block text-gray-700 font-semibold">Make:</label>
                <input type="text" class="border rounded py-2 px-3 w-full" id="make" name="make" value="{{ $bike->make }}" required>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700 font-semibold">Year:</label>
                <input type="number" class="border rounded py-2 px-3 w-full" id="year" name="year" value="{{ $bike->year }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description:</label>
                <textarea class="border rounded py-2 px-3 w-full" id="description" name="description" rows="4" required>{{ $bike->description }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Bike</button>
            </div>
        </form>
    </div>
</div>
@endsection
