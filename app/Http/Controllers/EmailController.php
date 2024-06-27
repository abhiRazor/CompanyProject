<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{

    public function forget_password()
    {
    return view('forgetEmail');
    }

    
    public function sendEmail(Request $request)
    {
        $request->validate([
           'email' => 'required|email|exists:users,email',
        ]);
        
           
    $toEmail = $request->email;
    $emailMessage = "Your OTP code for verification is below.";
    $subject = "Welcome to Nwaresoft";
    $otp = rand(100000, 999999);

    //save otp in the otp table
    $newOtp = new Otp();
    $otpRecord = Otp::where('email', $toEmail)->first();
    //If you want to check if $otpRecord does not exist (i.e., it is null or empty)
        if(!$otpRecord){
        
        $newOtp->email = $request->email;
        $newOtp->otp =  $otp;
        $newOtp->save();
        }
        else{

        $otpRecord->otp =$otp;
        $otpRecord->save();
        }
    
    
        Mail::to($toEmail)->send(new SendOtpMail($emailMessage, $subject, $otp));
        return view('otp')->with('success', 'OTP sent successfully.');
    
   
    }


    public function resetPasswordWithOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|numeric|digits:6', // Validate that otp is required, numeric, and exactly 6 digits
    ]);


    $otpData = Otp::where('otp',$request->otp)->first();

    if (!$otpData || $otpData->otp != $request->otp) {
        return back()->with('error','OTP is incorrect');
    }

    // Assuming you have a User model and want to reset the password for the user associated with this OTP
    $user = User::where('email', $otpData->email)->first();

    if (!$user) {
        return back()->with('error','User does not exist');
    }
    
   

    // Optionally, you can delete the OTP record after successful password reset
    $otpData->delete();
    
    return view('password-page', ['user' => $user->email]);
}

public function resetPassword(Request $request,$user)
{
    $user = User::where('email', $user)->first();
     
    //Reset password using Laravel's Hash facade
     $user->password = Hash::make($request->password);
     $user->save();

     return redirect('/')->with('success','Password changed');
}
}
