<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index() { return view('crm.files.index'); }
    public function upload(Request $request) { return back()->with('success', 'File uploaded.'); }
    public function download($file) { return back(); }
    public function destroy($file) { return back()->with('success', 'File deleted.'); }
}
