<?php namespace App\Domains\User;

use App\Models\User;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function update($user_id, array $data)
    {
        $user = $this->user
            ->newQuery()
            ->find($user_id);
        
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function find($user_id)
    {
        return $this->user
            ->newQuery()
            ->find($user_id);
    }

    public function paginate(array $excluded_user_ids = [], int $per_page = 10)
    {
        return $this->user
            ->newQuery()
            ->whereNotIn('id', $excluded_user_ids)
            ->paginate($per_page);
    }
}