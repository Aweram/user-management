<?php

namespace Aweram\UserManagement\Livewire;

use Aweram\UserManagement\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleIndexWire extends Component
{
    use WithPagination;

    public bool $displayData = false;
    public bool $displayDelete = false;
    public int|null $roleId = null;

    public string $name = "";
    public string $title = "";

    public function rules(): array
    {
        $uniqueCondition = "unique:roles,name";
        if ($this->roleId) $uniqueCondition .= ",{$this->roleId}";

        $uniqueTitleCondition = "unique:roles,name";
        if ($this->roleId) $uniqueTitleCondition .= ",{$this->roleId}";

        return [
            "name" => ["required", "string", "max:20", $uniqueCondition],
            "title" => ["required", "string", "max:50", $uniqueTitleCondition]
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "name" => __("Name"),
            "title" => __("Title"),
        ];
    }

    public function render()
    {
        $query = Role::query()->select("id", "name", "title");
        $query->orderBy("title");

        return view('um::livewire.admin.roles', [
            "roles" => $query->paginate()
        ]);
    }

    public function showCreate(): void
    {
        $this->resetFields();
        // Проверить авторизацию
        $check = $this->checkAuth("create");
        if (! $check) return;

        $this->displayData = true;
    }

    public function store(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("create");
        if (! $check) return;
        // Валидация
        $this->validate();

        Role::create([
            "name" => $this->name,
            "title" => $this->title
        ]);

        session()->flash("success", __("Role successfully added"));
        $this->closeData();
        $this->resetPage();
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    private function resetFields(): void
    {
        $this->reset(["name", "title", "roleId"]);
    }

    private function checkAuth(string $action, Role $role = null): bool
    {
        try {
            $this->authorize($action, $role ?? Role::class);
            return true;
        } catch (\Exception $ex) {
            session()->flash("error", __("Unauthorized action"));
            $this->closeData();
            return false;
        }
    }
}
