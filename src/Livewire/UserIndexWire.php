<?php

namespace Aweram\UserManagement\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Mockery\Exception;

class UserIndexWire extends Component
{
    use WithPagination;

    public string $sortBy = "name";
    public string $sortDirection = "asc";
    public string $searchName = "";
    public string $searchEmail = "";

    public bool $displayDelete = false;
    public bool $displayData = false;
    public int|null $userId = null;

    public string $name = "";
    public string $email = "";

    protected function queryString(): array
    {
        return [
            "sortBy",
            "sortDirection",
            "searchName" => ["as" => "name", "except" => ""],
            "searchEmail" => ["as" => "email", "except" => ""]
        ];
    }

    /**
     * Валидация форм.
     *
     * @return array[]
     */
    public function rules(): array
    {
        $uniqueCondition = "unique:users,email";
        if ($this->userId) $uniqueCondition .= ",{$this->userId}";
        return [
            "name" => ["required", "string", "max:50"],
            "email" => ["required", "string", "email", "max:50", $uniqueCondition],
        ];
    }

    /**
     * Имена полей.
     *
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            "name" => __("Name"),
            "email" => "E-mail"
        ];
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $query = User::query()->select("id", "name", "email");
        if (! empty($this->searchName)) {
            $value = trim($this->searchName);
            $query->where("name", "like", "%$value%");
        }
        if (! empty($this->searchEmail)) {
            $value = trim($this->searchEmail);
            $query->where("email", "like", "%$value%");
        }
        $query->orderBy($this->sortBy, $this->sortDirection);

        return view("um::livewire.admin.users", [
            "users" => $query->paginate(),
        ]);
    }

    /**
     * Очистить форму поиска.
     *
     * @return void
     */
    public function clearSearch(): void
    {
        $this->reset("searchEmail", "searchName");
        $this->resetPage();
    }

    /**
     * Изменить сортировку.
     *
     * @param $name
     * @return void
     */
    public function changeSort($name): void
    {
        if ($this->sortBy == $name) {
            $this->sortDirection = $this->sortDirection == "asc" ? "desc" : "asc";
        } else $this->sortDirection = "asc";
        $this->sortBy = $name;
        $this->resetPage();
    }

    /**
     * Показать форму добавления.
     *
     * @return void
     */
    public function showCreate(): void
    {
        $this->resetFields();
        $this->displayData = true;
    }

    /**
     * Добавить пользователя.
     *
     * @return void
     */
    public function store(): void
    {
        $this->validate();
        $newPassword = Str::random(8);
        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => Hash::make($newPassword)
        ]);

        session()->flash("success", implode(", ", [
            __("User successfully added"),
            __("Password") . ": $newPassword"
        ]));
        $this->closeData();
        $this->resetPage();
    }

    /**
     * Открыть редактирование пользователя.
     *
     * @param int $userId
     * @return void
     */
    public function showEdit(int $userId): void
    {
        $this->resetFields();
        try {
            $user = User::findOrFail($userId);
            $this->userId = $userId;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->displayData = true;
        } catch (\Exception $ex) {
            session()->flash("error", __("User not found"));
            $this->closeData();
        }
    }

    /**
     * Закрыть форму редактирования.
     *
     * @return void
     */
    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    /**
     * Обновление пользователя.
     *
     * @return void
     */
    public function update(): void
    {
        $this->validate();
        try {
            $user = User::findOrFail($this->userId);
            /**
             * @var User $user
             */
            $user->update([
                "name" => $this->name,
                "email" => $this->email
            ]);

            session()->flash("success", __("User successfully updated"));
        } catch (Exception $ex) {
            session()->flash("error", __("Error while update"));
        }

        $this->resetPage();
        $this->closeData();
    }

    /**
     * Открыть подтверждение удаления.
     *
     * @param int $userId
     * @return void
     */
    public function showDelete(int $userId): void
    {
        $this->resetFields();
        $this->userId = $userId;
        $this->displayDelete = true;
    }

    /**
     * Закрыть форму удаления.
     *
     * @return void
     */
    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    /**
     * Удалить пользователя.
     *
     * @return void
     */
    public function confirmDelete(): void
    {
        if ($this->userId !== Auth::id()) {
            try {
                $user = User::find($this->userId);
                $user->delete();
                session()->flash("success", __("User successfully deleted"));
            } catch (Exception $ex) {
                session()->flash("error", __("User not found"));
            }
        }
        $this->resetPage();
        $this->closeDelete();
    }

    /**
     * Сбросить переменные форм.
     *
     * @return void
     */
    private function resetFields(): void
    {
        $this->reset(["name", "email", "userId"]);
    }
}
