<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function RegisterForm(){
        return view('auth.register');
    }

    public function RegisterStore(Request $request){

        $validated = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $verificationToken = \Str::random(64);

        $userId = DB::table('users')->insertGetId([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $verificationToken,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = DB::table('users')->where('id', $userId)->first();
    
        SendVerificationEmail::dispatch($user);

       Session::flash('message', 'You Have Registerd Successfully!Please check your email to verify'); 
       return redirect('loginform');
    }

    public function VerifyEmail($token)
    {
        $user = DB::table('users')->where('email_verification_token', $token)->first();

        if ($user) {
            DB::table('users')->where('id', $user->id)->update([
                'is_verify_email' => 1,
                'email_verification_token' => null
            ]);

            Session::flash('message', 'Email verified successfully! You can now login.');
            return redirect('loginform');
        } else {
            Session::flash('error', 'Invalid verification link.');
            return redirect('loginform');
        }
    }

    public function LoginForm(){
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = DB::table('users')->where('email', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Email or password is incorrect.');
        }
    
        if ($user->is_verify_email == 0) {
            return back()->with('error', 'You need to verify your email first.');
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email or password is incorrect.');
        }
    
        Auth::loginUsingId($user->id);
    
        return redirect()->route('dashboard')->with('message', 'Login successful!');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/loginform')->with('message', 'You have been logged out successfully.');
    }

    public function Dashboard(){
        return view('dashboard');
    }

    public function StoreBookings(Request $request)
    {
     
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'booking_date' => 'required|date',
            'booking_type' => 'required|in:full_day,half_day,custom',
            'booking_slot' => 'nullable|in:first_half,second_half',
            'booking_from_time' => 'nullable|date_format:H:i',
            'booking_to_time' => 'nullable|date_format:H:i|after:booking_from_time',
        ]);
    
        $bookingDate = $request->booking_date;
        $bookingType = $request->booking_type;
        $bookingSlot = $request->booking_slot;
        $userId = Auth::id();

        // Check if a "custom" booking exists (no other bookings allowed on that date)
        $customBookingExists = DB::table('bookings')
            ->where('booking_date', $bookingDate)
            ->where('booking_type', 'custom')
            ->exists();
    
        if ($customBookingExists) {
            return back()->with('error', 'A custom booking already exists on this date. No other bookings are allowed.');
        }
    
        // if a full-day booking exists (no other bookings allowed)
        $fullDayBookingExists = DB::table('bookings')
            ->where('booking_date', $bookingDate)
            ->where('booking_type', 'full_day')
            ->exists();
    
        if ($fullDayBookingExists) {
            return back()->with('error', 'A full-day booking already exists on this date. No other bookings are allowed.');
        }
    
        // If booking is "full_day", prevent any existing half-day bookings on that date
        if ($bookingType === 'full_day') {
            $halfDayExists = DB::table('bookings')
                ->where('booking_date', $bookingDate)
                ->where('booking_type', 'half_day')
                ->exists();
    
            if ($halfDayExists) {
                return back()->with('error', 'A half-day booking exists on this date. Full-day booking is not allowed.');
            }
        }
    
        // If booking is "half_day", check if the opposite half is already booked
        if ($bookingType === 'half_day') {
            $oppositeSlot = $bookingSlot === 'first_half' ? 'second_half' : 'first_half';
    
            $oppositeHalfExists = DB::table('bookings')
                ->where('booking_date', $bookingDate)
                ->where('booking_type', 'half_day')
                ->where('booking_slot', $oppositeSlot)
                ->exists();
    
            if ($oppositeHalfExists) {
                return back()->with('error', 'Both half-day slots are already booked for this date. No more bookings allowed.');
            }
        }
    
        DB::table('bookings')->insert([
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'booking_date' => $bookingDate,
            'booking_type' => $bookingType,
            'booking_slot' => $bookingType === 'half_day' ? $bookingSlot : null,
            'booking_from_time' => $bookingType === 'custom' ? $request->booking_from_time : null,
            'booking_to_time' => $bookingType === 'custom' ? $request->booking_to_time : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return back()->with('success', 'Booking confirmed successfully!');
    }
}
