<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'message' => $request->message,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'เสียงกระซิบของคุณถูกส่งไปยังความว่างเปล่าแล้ว... (Your whisper has been heard)');
    }
}
