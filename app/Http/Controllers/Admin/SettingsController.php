<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.admin.settings.index');
    }

    public function update(Request $request)
    {
        // This would typically update config or a settings table
        // For this template, we'll just simulate success
        return back()->with('success', 'System settings updated successfully.');
    }
}
