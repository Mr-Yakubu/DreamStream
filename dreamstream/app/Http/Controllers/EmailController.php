<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;



class EmailController extends Controller
{
public function sendWelcomeEmail(Request $request)
{
    $username = $request->input('name'); // Example: Fetch name from request
    $messageBody = "We are thrilled to have you onboard! Explore educational videos tailored just for you.";
    $subject = "Welcome to DreamStream!";

    // Replace with recipient's email address
    Mail::to('gakere.jacob@gmail.com')->send(new WelcomeEmail($username, $subject,$messageBody));

    return response()->json(['message' => 'Welcome email sent successfully!']);
}
}