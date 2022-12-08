<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Booking') }}
        </h2>
    </x-slot>

    <div class="py-4">
    <div class="bg-white dark:bg-gray-900">
    <div class="py-4 sm:py-6 space-y-3">
      <div class="max-w-7xl mx-auto sm:px-2 lg:px-8 overflow-y-auto">
        <div class="max-w-2xl mx-auto px-4 lg:max-w-4xl lg:px-0">
          <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl dark:text-white">My Bookings</h1>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Check the status of your ticket bookings and routes</p>
        </div>
      </div>
      @if(count($bookings)>0)
      @foreach($bookings as $booking)
      <div class="mt-8 space-y-4">
        <h2 class="sr-only">Recent orders</h2>
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-8">
          <div class="max-w-2xl mx-auto space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
            <div class="bg-white dark:bg-gray-800 border-t border-b border-gray-200 dark:border-gray-800 shadow-sm sm:rounded-lg sm:border">
              <h3 class="sr-only">Order placed on <time datetime="2021-07-06">Jul 6, 2021</time></h3>
  
              <div class="flex items-center p-4 border-b border-gray-200 dark:border-gray-600 sm:p-6 sm:grid sm:grid-cols-4 sm:gap-x-6">
                <dl class="flex-1 grid grid-cols-3 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-2">
                  <div>
                    <dt class="font-medium text-gray-900 dark:text-white">Bus number</dt>
                    <dd class="mt-1 text-gray-500 dark:text-gray-400">{{$booking->bus_number}}</dd>
                  </div>
                  <div class="hidden sm:block">
                    <dt class="font-medium text-gray-900 dark:text-white">Date of boarding</dt>
                    <dd class="mt-1 text-gray-500 dark:text-gray-400">
                      <time datetime="2021-07-06">{{$booking->boarding_date}}</time>
                    </dd>
                  </div>
                  <div>
                    <dt class="font-medium text-gray-900 dark:text-white">Total amount</dt>
                    <dd class="mt-1 font-medium text-gray-900 dark:text-white">₹ {{$booking->total}}</dd>
                  </div>
                </dl>
                <form method="post" action="/cancel-booking">@csrf
                    @method('post')
                    <input type="hidden" name="id" value={{$booking->id}}>
                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel Booking</button>
                </form>
                <div class="relative flex justify-end lg:hidden">
                  <div class="flex items-center">
                    <button type="button" class="-m-2 p-2 flex items-center text-gray-400 hover:text-gray-500 dark:text-gray-400" id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                      <span class="sr-only">Options for order {{$booking->bus_number}}</span>
                      <!-- Heroicon name: outline/dots-vertical -->
                      <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                      </svg>
                      
                    </button>
                  </div>
  
                  <!--
                    Dropdown menu, show/hide based on menu state.
  
                    Entering: "transition ease-out duration-100"
                      From: "transform opacity-0 scale-95"
                      To: "transform opacity-100 scale-100"
                    Leaving: "transition ease-in duration-75"
                      From: "transform opacity-100 scale-100"
                      To: "transform opacity-0 scale-95"
                  -->
                </div>
  
                <div class="hidden lg:col-span-2 lg:flex lg:items-center lg:justify-end lg:space-x-4">
                  <!-- <a href="#" class="flex items-center justify-center bg-white py-2 px-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span>View Order</span> -->
                    <span class="sr-only">{{$booking->bus_number}}</span>
                  </a>
                </div>
              </div>
  
              <!-- Products -->
              <h4 class="sr-only">Items</h4>
              <ul role="list" class="divide-y divide-gray-200">
                <li class="p-4 sm:p-6">
                  <div class="flex items-center sm:items-start">
                    <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden sm:w-40 sm:h-40">
                      <img src="./photo/Bharat Yatra Company.JPG" alt="Moss green canvas compact backpack with double top zipper, zipper front pouch, and matching carry handle and backpack straps." class="w-full h-full object-center object-cover">
                    </div>
                    <div class="flex-1 ml-6 text-sm">
                      <div class="font-medium text-gray-900 dark:text-white sm:flex sm:justify-between">
                        <h5>About Booking ID #2022-{{$booking->id}}</h5>
                      </div>
                      <p class="hidden text-gray-500 dark:text-gray-400 sm:block sm:mt-2">From: {{$booking->board_from}}    to    {{$booking->board_to}} <br> Boarding Time : {{$booking->boarding_time}} <br> Boarding place : {{$booking->boarding_place}}<br> Reaching date and time : {{$booking->arrival}}
                      </p>
                    </div>
                  </div>
  
                  <div class="mt-6 sm:flex sm:justify-between">
                    <div class="flex items-center">
                      <!-- Heroicon name: solid/check-circle -->
                      <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                      </svg>
                      <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">Verified and Purchased on <time datetime="2021-07-12">{{$booking->created_at}}</time></p>
                    </div>
                    </div>
                  </div>
                </li>
  
                <!-- More products... -->
              </ul>
            </div>
  
            <!-- More orders... -->
          </div>
        </div>
      </div>
      @endForeach
      @else
      <div class="mt-8 space-y-4">
        <h2 class="sr-only">Recent orders</h2>
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-8 flex justify-center items-center py-3">
            <div class="bg-white dark:bg-gray-800 border-t border-b border-gray-200 dark:border-gray-800 shadow-sm sm:rounded-lg sm:border w-full py-4 text-gray-600 dark:text-gray-300 flex justify-center items-center">
            No Bookings Yet
            </div>
        </div>
      </div>
      @endif
      
  </div>
  </div>
    </div>
</x-app-layout>
