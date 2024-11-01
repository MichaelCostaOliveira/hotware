<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TaskController extends Controller
{
    protected $taskRepository;
    public function __construct(
        TaskRepository $taskRepository
    ){
        $this->taskRepository = $taskRepository;
    }
    public function index()
    {
//        $a = 0.1;
//        $b = 0.2;
//        $c = 0.3;
//        $soma = $a+$b;
//        $r = $soma == $c;
//        dd(Hash::make('123'), $r);

        $tasks = $this->taskRepository->all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $task = $this->taskRepository->create(['name' => $request->name]);

        if ($request->wantsTurboStream()) {
            return response()->turboStream()->append('tasks', 'tasks._task', ['task' => $task]);
        }

        return redirect()->back();
    }

    public function complete($taskId)
    {
        // Usa o repositório para marcar a tarefa como concluída pelo ID
        $completedTask = $this->taskRepository->completeById($taskId);

        if (request()->wantsTurboStream()) {
            return response()->turboStream()->replace("task_{$completedTask->id}", 'tasks._task', ['task' => $completedTask]);
        }

        return redirect()->back();
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
