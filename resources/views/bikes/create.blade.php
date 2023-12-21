@extends('base')

@section('content')
<div class="container mx-auto max-w-md mt-4">
    <div class="text-right">
        <a href="{{ route('bikes.index') }}" class="btn btn-secondary m-3">Back</a>
    </div>
    <div class="bg-white shadow-md rounded p-6">
        <h1 class="text-2xl font-bold mb-4">New Bike</h1>
        <form method="POST" action="{{ route('bikes.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">Bike Image:</label>
                <input type="file" class="border rounded py-2 px-3 w-full" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-4">
                <label for="model" class="block text-gray-700 font-semibold">Model:</label>
                <input type="text" class="border rounded py-2 px-3 w-full" id="model" name="model" required>
            </div>
            <div class="mb-4">
                <label for="make" class="block text-gray-700 font-semibold">Make:</label>
                <input type="text" class="border rounded py-2 px-3 w-full" id="make" name="make" required>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700 font-semibold">Year:</label>
                <input type="number" class="border rounded py-2 px-3 w-full" id="year" name="year" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description:</label>
                <textarea class="border rounded py-2 px-3 w-full" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create Bike</button>
            </div>
        </form>
    </div>
</div>
@endsection
