<?php

namespace Aweram\UserManagement\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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
    public $userId = null;

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
        $this->searchEmail = "";
        $this->searchName = "";
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
        $this->switchDirection($name);
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
     * Закрыть форму создания.
     *
     * @return void
     */
    public function closeCreate(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function store()
    {
        $this->closeCreate();
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
            session()->flash("error", "Пользователь не найден");
            $this->closeEdit();
        }
    }

    /**
     * Закрыть форму редактирования.
     *
     * @return void
     */
    public function closeEdit(): void
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
        try {
            $user = User::findOrFail($this->userId);
            /**
             * @var User $user
             */

            $this->validate([
                "name" => $this->nameRules(),
                "email" => $this->emailRules(),
            ], [], [
                "name" => "Имя",
                "email" => "E-mail"
            ]);

            $user->update([
                "name" => $this->name,
                "email" => $this->email
            ]);

            session()->flash("success", "Пользователь успешно обновлен");

            $this->resetPage();
        } catch (Exception $ex) {
            session()->flash("error", "Ошибка обновления");
        }

        $this->closeEdit();
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
                session()->flash("success", "Пользователь был успешно удален");
            } catch (Exception $ex) {
                session()->flash("error", "Неудалось удалить пользователя");
            }
        }
        $this->closeDelete();
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

    /**
     * Сбросить переменные форм.
     *
     * @return void
     */
    private function resetFields(): void
    {
        $this->reset(["name", "email", "userId"]);
    }

    /**
     * Валидация имени пользователя.
     *
     * @return string[]
     */
    private function nameRules(): array
    {
        return ["required", "string", "max:50"];
    }

    /**
     * Валидация email.
     *
     * @return string[]
     */
    private function emailRules(): array
    {
        $uniqueCondition = "unique:users,email";
        if ($this->userId) $uniqueCondition .= ",{$this->userId}";
        return ["required", "string", "email", "max:50", $uniqueCondition];
    }
}
