<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
</head>

<body class="bg-white font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <!-- <div class="flex justify-center pt-12">
                <img src="/img/logo.png" class="w-64"></img>
            </div> -->

            <div class="flex flex-col justify-center md:justify-start my-auto pt-56 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-4xl font-bold pt-6">Login!</p>
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST" class="flex flex-col items-center">
                    @csrf
                    <div class="flex flex-col pt-2 w-full">
                        <label for="credential" class="text-lg">Email</label>
                        <input type="text" id="credential" name="credential" placeholder="your@email.com"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-2 w-full">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit" name="submit" style="background-color: #00AEEE;"
                        class="mt-4 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-l font-bold py-2.5 px-5 focus:outline-none">Login</button>
                </form>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="/img/coba plnku.png">
        </div>
    </div>

</body>

</html>