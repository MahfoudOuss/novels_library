<!DOCTYPE html>
<html lang="en">

<head >
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/images/logo4.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    
    <title>E-BooK | Find Novel Of Your Liking</title>
</head>

<body >
    <div class="flex flex-col h-screen ">
    <nav class=" mb-4  bg-dark">
        <div class="flex justify-between items-center max-w-screen-lg mx-auto">

        
        <a href="/novels"><img class="w-24 h-fit" src="{{asset('images/logo4.png')}}" alt="" class="logo" /></a>
        <ul class="flex space-x-6 mr-6 text-lg text-white">

            @auth
            <li>
                welcome
                <span class="font-bold uppercase">
                    {{auth()->user()->name}}
                </span>
            </li>
            <li>
                <a href="/novels/reading_list" class="hover:text-laravel"><i class="fa-solid fa-gear"></i>
                    Reading List </a>
            </li>
            <li>
                <a href="/novels"> All Novels</a>
            </li>
            <li>
                <a href="/novels/cat"> Genre Catalog</a>
            </li>
            <li>
                <form class="inline" method="POST" action="/users/logout">
                    @csrf

                    <button type="submit">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>

                </form>
            </li>
            @else
            <li>
                <a href="/novels"> All Novels</a>
            </li>
            <li>
                <a href="/novels/cat"> Genre Catalog</a>
            </li>
            <li>
                <a href="/users/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
                <a href="/users/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a>
            </li>
            @endauth






        </ul>
        </div>
    </nav>
    <main class="mb-auto">
        {{$slot}}
    </main>

    <footer class=" w-full buttom-0 flex items-center  justify-items-center justify-around font-bold bg-dark text-white h-30 mt-24 opacity-90 ">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
    </footer>
    </div>
    <x-message/>

</body>

</html>