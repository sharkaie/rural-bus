<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $buses = DB::select('select * from buses');
        $allBuses = $buses;
        return view('buses', ['buses' => $buses,'allBuses' => $allBuses]);
    }
    public function search_bus(Request $request)
    {
        $allBuses = DB::select('select * from buses');
        if($request->from && $request->to && $request->date){
            $buses = DB::table('buses')->where('board_from',$request->from)->where('board_to',$request->to)->whereDate('boarding_date','>=',$request->date)->get();
            return view('buses', ['allBuses'=> $allBuses,'buses' => $buses]);
        }
        if($request->from && $request->to){
            $buses = DB::table('buses')->where('board_from',$request->from)->where('board_to',$request->to)->get();
            return view('buses', ['allBuses'=> $allBuses,'buses' => $buses]);
        }
        if($request->from){
            $buses = DB::table('buses')->where('board_from',$request->from)->get();
            return view('buses', ['allBuses'=> $allBuses,'buses' => $buses]);
        }
        return view('buses', ['allBuses'=>$allBuses,'buses' => []]);
    }
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function bookings(Request $request)
    {
        $bookings = DB::table('buses')->join('bookings', 'buses.id', '=', 'bookings.bus_id')->where('bookings.user_id',$request->user()->id)->get();

        return view('manageBooking', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function book_bus(Request $request)
    {
        $bus = DB::table('buses')->where('id',$request->bus_id)->get();
        $isBooked = DB::table('bookings')->insert([
            'user_id' => $request->user()->id,
            'bus_id' => $request->bus_id,
            'total' => $request->seats*$bus[0]->amount,
        ]);
        if($isBooked == '1') return Redirect::route('manage-booking');
        return Redirect::route('buses');
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function a(Request $request)
    {
        $booking = DB::table('bookings')->where('id',$request->id)->get();
        if($booking){
            $deleted = DB::table('bookings')->where('id', $request->id)->delete();
        }
        return Redirect::route('manage-booking');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel_booking(Request $request)
    {
        $booking = DB::table('bookings')->where('id',$request->id)->get();
        if($booking){
            $deleted = DB::table('bookings')->where('id', $request->id, 'user_id'->$request->user()->id)->delete();
        }
        return Redirect::route('manage-booking');
    }
}
