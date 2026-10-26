<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $subjects = Subject::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('subjects.index', compact('subjects', 'search'));
    }




    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }





    public function create()
    {
        if (!str_contains(url()->previous(), '/subjects/create')) {
            session(['subjects.back' => url()->previous()]);
        }

        return view('subjects.create');
    }



    public function store(Request $request)
    {
        $valid = $request->validate([
            'name'        => ['required', 'string', 'max:50'],
            'code'        => ['required', 'string', 'max:50', 'unique:subjects,code'],
            'description' => ['nullable', 'string'],
        ]);

        $user = $request->user();

        Subject::create($valid + [
            'created_by_id'    => $user->id,
            'created_by_name'  => $user->name,
            'created_by_email' => $user->email,
            'created_by_role'  => $user->role,
        ]);

        session()->forget('subjects.back');

        return redirect()->route('subjects.index')
            ->with('success', 'Subject added successfully.');
    }





    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }



    public function update(Request $request, Subject $subject)
    {
        $valid = $request->validate([
            'name'        => ['required', 'string', 'max:50'],
            'code'        => ['required', 'string', 'max:50', Rule::unique('subjects', 'code')->ignore($subject->id)],
            'description' => ['nullable', 'string'],
        ]);

        $user = $request->user();

        $subject->update($valid + [
            'updated_by_id'    => $user->id,
            'updated_by_name'  => $user->name,
            'updated_by_email' => $user->email,
            'updated_by_role'  => $user->role,
        ]);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }




    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }



}
