<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function patient()
    {
        return view('pages.patient');
    }

    public function file(Patient $patient)
    {
        return view('pages.file', compact('patient'));
    }

    public function phone(Patient $patient)
    {
        return view('pages.phone', compact('patient'));
    }

    public function address(Patient $patient)
    {
        return view('pages.address', compact('patient'));
    }

    public function meeting(Patient $patient)
    {
        return view('pages.meeting', compact('patient'));
    }

    public function calendar()
    {
        return view('pages.calendar');
    }

    public function program()
    {
        return view('pages.program');
    }

    public function question()
    {
        return view('pages.question');
    }

    public function detail(Patient $patient)
    {
        return view('pages.detail', compact('patient'));
    }

    public function consultation()
    {
        return view('pages.consultation');
    }

    public function treatment()
    {
        return view('pages.treatment');
    }

    public function user()
    {
        return view('pages.user');
    }

    public function diagnostic(Patient $patient)
    {
        return view('pages.diagnostic', compact('patient'));
    }
}
