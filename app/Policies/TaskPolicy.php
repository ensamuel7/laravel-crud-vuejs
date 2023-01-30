<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given Task can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $Task
     * @return bool
     */
    public function viewAny(User $user, Task $task)
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('You do not own this', 404);
    }

    /**
     * Determine if the given Task can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $Task
     * @return bool
     */
    public function view(User $user, Task $task)
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('You do not own this', 404);
    }

    /**
     * Determine if the given Task can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $Task
     * @return bool
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('You do not own this', 404);
    }

    /**
     * Determine if the given Task can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $Task
     * @return bool
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('You do not own this', 404);
    }
}
