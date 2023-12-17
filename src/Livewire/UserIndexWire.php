<?php

namespace Aweram\UserManagement\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndexWire extends Component
{
    use WithPagination;

    public string $sortBy = "name";
    public string $sortDirection = "asc";

    protected function queryString(): array
    {
        return ["sortBy", "sortDirection"];
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $query = User::query()->select("id", "name", "email");
        $query->orderBy($this->sortBy, $this->sortDirection);

        return view("um::livewire.admin.users", [
            "users" => $query->paginate(),
        ]);
    }

    /**
     * Изменить сортировку.
     *
     * @param $name
     * @return void
     */
    public function changeSort($name): void
    {
        $this->switchDirection($name);
        $this->sortBy = $name;
        $this->resetPage();
    }

    /**
     * Изменить направление сортировки.
     *
     * @param $name
     * @return void
     */
    private function switchDirection($name): void
    {
        if ($this->sortBy == $name) {
            $this->sortDirection = $this->sortDirection == "asc" ? "desc" : "asc";
        } else $this->sortDirection = "asc";
    }
}
