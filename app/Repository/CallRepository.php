<?php

namespace App\Repository;

use App\Models\Call;
use Illuminate\Database\Eloquent\Collection;

class CallRepository
{
    public function first(): ?Call
    {
        return Call::first();
    }

    public function findOrFail(string $id): Call
    {
        return Call::findOrFail($id);
    }

    public function getAll(): Collection
    {
        return Call::all();
    }
}
