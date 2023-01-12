<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ["name", "size"];

    public function add($user)
    {
        $this->GuardAgaintsTooManyMember();

        $method = $user instanceof User ? "save" : "saveMany";

        $this->employeers()->$method($user);
    }

    public function employeers()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->employeers()->count();
    }

    public function remove($users = null)
    {
        if ($users instanceof User) {
            return $users->employeeFired();
        }

        return $this->removeMany($users);
    }

    public function removeMany($users)
    {
        return $this->employeers()->whereIn("id", $users->pluck("id"))->update(["employee_id" => null]);
    }

    public function restart()
    {
        return $this->employeers()->update(["employee_id" => null]);
    }

    protected function GuardAgaintsTooManyMember()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }

    protected function SaveJustOneEmployess($user)
    {
        return $user instanceof User ? $this->employeers()->save($user) : "";
    }
}
