<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IPT2 Final</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @if (auth()->check())

    <nav class="bg-teal-800 p-4">
        <div class="flex justify-between items-center">
            <div class="text-white font-bold text-xl">Final</div>
            <div class="hidden md:flex space-x-4 items-center">
                <div class="relative group text-white">
                    {{ Auth::user()->name }}
                </div>
                <a href="/dashboard" class="text-white hover:text-teal-400">Dashboard</a>
                <a href="/bikes" class="text-white hover:text-teal-400">Bike List</a>
                @role('admin')
                <a href="/logs" class="text-white hover:text-teal-400">Logs</a>
                @endrole
                <form action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="text-white px-3 py-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    @endif
    @yield('content')
    @stack('scripts')
</body>
</html>

<style>
    .bg-teal-800 {
        background-color: #2e27e4;
    }

    .text-white {
        color: #ffffff;
    }

    .hover\:text-teal-400:hover {
        color: #4fd1c5;
    }
</style>
