<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Dress Shop</title>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    {{--  added tailwind and daisy for ui --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    
</head>

<body>

    {{-- navbar section --}}
    <header class="navbar bg-base-100 px-12 py-3 text-white">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost text-2xl">Paint Experts</a>
        </div>


        <div class="flex-none gap-2">
            <ul>
           
            </ul>
          <div class="dropdown dropdown-end">
            <a href="/cart" class="btn btn-ghost btn-circle">
              <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                {{-- <span class="badge badge-sm indicator-item">{{ $cartLength }}</span> --}}
              </div>
            </a>
         
          </div>
          <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
              <div class="w-10 rounded-full">
                <img alt="Tailwind CSS Navbar component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
              </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="/profile">{{ auth()->user()->name }}</a></li>
                 
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
            </ul>
          </div>
        </div>
    </header> 

    <main class="min-h-screen">



        <form action="" method="post" class="max-w-md mx-auto mt-12">
            @csrf
            <div class="mb-4">
                <label for="product_title" class="block text-sm font-medium">Product Title:</label>
                <input type="text" id="product_title" name="product_title" value="{{$item->name}}" readonly
                       class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white text-black">
            </div>
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium">Rating:</label>
                <select name="rating" id="rating"
                        
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white text-black">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option selected value="5">5</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium">Message:</label>
                <textarea name="message" id="message"
                          class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white text-black"
                          rows="5"></textarea>
            </div>
            <button type="submit"
                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit
                Review
            </button>
        </form>
        <div class="text-center mt-5">
        
            @if (session('error'))
            <div class=" text-red-600">
                {{ session('error') }}
            </div>
            @endif
        </div>
        
    </main>
  

    <footer>
        <div class="container">
            <p>&copy; 2024 Online Painting Shop. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>