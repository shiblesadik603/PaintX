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
                <li>
                    <a href="/blogs">Blogs</a>
                </li>
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


    {{-- product details --}}

    <div class="container mx-auto my-10">

        <!-- Product Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
            <!-- Image Section -->
            <div>
                <img class="h-[550px] w-full object-contain" src="{{ asset('uploads/products/'.$item->photo) }}" alt="Product Image" class="w-full rounded-lg shadow-md">
            </div>
    
            <!-- Details Section -->
            <div class="flex flex-col justify-center">
    
                <!-- Product Title -->
                <h1 class="text-3xl font-semibold mb-4">{{ $item->name }}</h1>
    
                <!-- Price -->
                <div class="text-2xl font-bold text-gray-800 mb-4">${{ $item->price }}</div>
    
                <!-- Description -->
                <p class="text-gray-700 mb-6">{{ $item->description }}</p>
    
                <!-- Add to Cart Button -->
              <div class="max-w-md">
                <button onclick="window.location='{{route('add_to_cart', $item->itemID)}}'" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add to Cart
                </button>
              </div>
    
            </div>
    
        </div>

        <div class="my-5 md:mx-12">
          <h2 class="text-2xl">Reviews</h2>
          <hr>
          @if($reviews)
              <div class="mt-4">
                  @foreach($reviews as $review)
                      <div class="border-b border-gray-200 py-4">
                          <div class="flex items-center mb-2">
                              <span class="text-lg font-semibold mr-2">{{ $review->user->name }}</span>
                              @for($i = 0; $i < $review->rating; $i++)
                                  <svg class="h-5 w-5 fill-current text-yellow-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M10 3.105l1.755 4.865H16.29a.745.745 0 0 1 .582 1.214l-3.682 3.227 1.757 4.865a.745.745 0 0 1-1.14.85L10 15.885l-4.207 3.222a.745.745 0 0 1-1.14-.85l1.757-4.865-3.682-3.227a.745.745 0 0 1 .582-1.214h4.535L10 3.105z"/>
                                  </svg>
                              @endfor
                          </div>
                          <p class="text-gray-700">{{ $review->message }}</p>
                      </div>
                  @endforeach
              </div>
          @else
              <p class="text-gray-700">There are no reviews for this product yet.</p>
          @endif
        </div>
    
    
    </div>



  

    <footer>
        <div class="container">
            <p>&copy; 2024 Online Painting Shop. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>