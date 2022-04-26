<?php namespace App\Repositories;

use App\Models\User;

class UserRepository
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
}