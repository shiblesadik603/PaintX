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
            <a class="btn btn-ghost text-2xl">Paint Experts</a>
        </div>


        <div class="flex-none gap-2">
            <ul>
           
            </ul>
          <div class="dropdown dropdown-end">
            <a href="/cart" class="btn btn-ghost btn-circle">
              <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <span class="badge badge-sm indicator-item">{{ $cartLength }}</span>
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


    {{-- hero section --}}

    <section >
        <div class="hero min-h-screen" style="background-image: url(https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
              <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Discover Our Latest Trends</h1>
                <p class="mb-5">Explore our collection of trendy paints</p>
                
                <a href="#products">
                    <button class="btn btn-primary">Get Started</button>
                </a>
              </div>
            </div>
          </div>
    </section>

    {{-- products --}}
    <section id="products" class="products">
        <div class="container">
            <h2 class="text-3xl text-center font-bold my-5">Featured Products</h2>
            <div class="flex gap-8 items-center justify-center pt-5 flex-wrap">

                @foreach($items as $item)
                    <div class="card w-96 bg-base-100 shadow-xl text-white">
                        <a href="{{route('product.details', $item->itemID)}}">
                        <figure class="h-[200px]"><img src="{{ asset('uploads/products/'.$item->photo) }}" alt="{{ $item->name }}" /></figure>
                        <div class="card-body">
                            <h2 class="card-title truncate">
                                {{ $item->name }}
                        
                        </h2>
                        </a>
                        <div class="badge badge-secondary">${{ $item->price }}</div>
                        <p class="truncate">{{ $item->description }}</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-success btn-sm text-white bg-pink-500 border-none outline-none" onclick="window.location='{{route('add_to_cart', $item->itemID)}}'">Add to Cart</button>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>
  

    <footer>
        <div class="container">
            <p>&copy; 2024 Online Painting Shop. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>