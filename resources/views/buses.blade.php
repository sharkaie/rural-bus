<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="/buses">
                    @method('POST')
                    @csrf
            <div class="grid grid-cols-4 space-x-2 md:space-x-6 px-8 md:px-20 py-10">
                <div>
                    <label for="from" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">From</label>
                    <select id="from" name="from"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose boarding location</option>
                    @foreach($allBuses as $bus)
                    <option value={{$bus->board_from}}>{{$bus->board_from}}</option>
                    @endforeach
                    </select>
                  </div>

                  <div>
                    <label for="to" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">To</label>
                    <select id="to" name="to"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value=" ">Choose reach destination</option>
                    @foreach($allBuses as $bus)
                        <option value={{$bus->board_to}}>{{$bus->board_to}}</option>
                    @endforeach
                    </select>
                  </div>
            {{-- <div class="">
                <label for="from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">From</label>
                <input type="text" name="from" id="from" autocomplete="address-level2" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-gray-300 dark:text-gray-300 rounded-md">
            </div> --}}


          <div class="">
            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
            <input type="date" name="date" id="date" autocomplete="date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-gray-300 dark:text-gray-300 rounded-md">
          </div>
          <button type="submit" class="sm:inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md mx-40 mb-12">
    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-600">
        @if(count($buses)>0)
        @foreach($buses as $bus)
        <li>
            
            <div class="block hover:bg-gray-50 dark:hover:bg-gray-700">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="min-w-0 flex-1 flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-12 w-auto object-cover rounded-full" src="./photo/ABYatracompany.jpg" alt="">
                </div>
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-4">
                    <div>
                    <p class="text-sm font-medium text-blue-600 truncate">{{$bus->bus_name}}</p>
                    <p class="mt-2 flex items-center text-sm dark:text-gray-300 text-gray-500">
                        <!-- Heroicon name: solid/mail -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span class="truncate">{{$bus->email}}</span>
                    </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-900 dark:text-white">
                            Amount
                            </p>
                    <p class="mt-2 flex items-center text-sm dark:text-gray-300 text-gray-500">
                        <span class="truncate">₹ {{$bus->amount}}</span>
                    </p>
                    </div>
                    <div class="hidden md:block">
                    <div>
                        <p class="text-sm text-gray-900 dark:text-white">
                        Available on
                        <time datetime="2020-01-07">{{$bus->boarding_date}}</time>
                        </p>
                        <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-300">
                            @if($bus->meals_included == "true")
                        <!-- Heroicon name: solid/check-circle -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        @else
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                          </svg>
                          @endif
                          
                        Meals Included
                        </p>
                    </div>
                    </div>
                </div>
                </div>
                <div>
                <!-- Heroicon name: solid/chevron-right -->
                <form action="/book-bus" method="POST">@csrf @method("POST")
                    <input type="hidden" name="bus_id" value={{$bus->id}}>
                    <div class="flex items-center">
                        <select id="seats" name="seats"  class="px-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        </select>
                        <button type="submit" class="focus:outline-none text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 ml-2 dark:focus:ring-yellow-900">Book</button>
                    </div>
            </form>
                </div>
            </div>
            </div>
        </li>
        
      @endforeach
      @else
      <li>
        <a href="#" class="block hover:bg-gray-50 dark:hover:bg-gray-700">
        <div class="flex items-center justify-center px-4 py-4 sm:px-6 text-gray-500  dark:text-white">
            <p>No Buses Found</p>
        </div>
        </a>
    </li>
      @endif
     
    </ul>
  </div>
</x-app-layout>
