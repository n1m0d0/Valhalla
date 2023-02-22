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
}
