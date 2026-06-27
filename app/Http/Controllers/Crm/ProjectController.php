<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() { return view('crm.projects.index'); }
    public function create() { return view('crm.projects.create'); }
    public function store(Request $request) { return redirect()->route('crm.projects.index')->with('success', 'Project created.'); }
    public function show($project) { return view('crm.projects.show', ['project' => (object)['id' => $project]]); }
    public function edit($project) { return view('crm.projects.edit', ['project' => (object)['id' => $project]]); }
    public function update(Request $request, $project) { return redirect()->route('crm.projects.index')->with('success', 'Project updated.'); }
    public function destroy($project) { return redirect()->route('crm.projects.index')->with('success', 'Project deleted.'); }
    public function updateStatus(Request $request, $project) { return back()->with('success', 'Status updated.'); }
    public function uploadFile(Request $request, $project) { return back()->with('success', 'File uploaded.'); }
    public function deleteFile($project, $file) { return back()->with('success', 'File deleted.'); }
    public function addComment(Request $request, $project) { return back()->with('success', 'Comment added.'); }
}
