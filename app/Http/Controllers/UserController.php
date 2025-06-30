<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserLogger;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Declare a protected propert to hold the
     * UserLogger instance.
     */
    protected UserLogger $logger;

    /**
     * Constructor for the controller
     *
     * @param UserLogger $logger
     * An instance of the UserLogger used for logging
     * user-related activities
     */
    public function __construct(UserLogger $logger)
    {
        $this->authorizeResource(User::class, 'user');
        $this->logger = $logger;
    }

        /**
     * Display a listing of users.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $this->logger->index(auth()->id());

        $archivedCount = User::onlyTrashed()->count();

        return Inertia::render('users/Index', [
            'users' => User::paginate(10),
            'authUser' => auth()->user(),
            'hasArchivedUsers' => $archivedCount > 0,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Empty for now
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Empty for now
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @param Request $request
     *
     * @return \Inertia\Response
     */
    public function show(User $user, Request $request)
    {
        $this->authorize('view', $user);

        $user->get();

        $this->logger->show($user, auth()->id());

        return Inertia::render('users/Show', [
            'user' => $user,
            'from' => $request->query('from', 'index'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Empty for now
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Empty for now
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Empty for now
    }

    /**
     * Restore a previously soft-deleted user.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(User $user)
    {
        $this->authorize('restore', $user);

        $user->update([
            'deleted_at' => null,
            'deleted_by' => null,
            'is_archived' => false,
            'restored_at' => now(),
            'restored_by' => auth()->id(),
        ]);
        $user->restore();

        $this->logger->restore($user, auth()->id());

        return redirect()->route(
            'users.show',
            $user
        )->with('success', 'User restored.');
    }

    /**
     * Display a list of archived users.
     *
     * @return \Inertia\Response
     */
    public function archived()
    {
        $this->authorize('viewArchived', User::class);
        $archivedUsers = User::onlyTrashed()
            ->paginate(10);

        $authUser = auth()->user();

        $this->logger->archived(auth()->id());

        return Inertia::render('users/Archived', [
            'users' => $archivedUsers,
            'authUser' => $authUser,
        ]);
    }
}
