<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\ProcessQueueJob;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(
        UserRepository $userRepository
    ){
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
//        dispatch(new ProcessQueueJob($request->all()));
        ProcessQueueJob::dispatch($request->all());
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
