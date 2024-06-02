### Описание

Пакет содержит интерфейс администрирования для пользователей. Через конфиг `user-management` можно переименовать путь и изменить класс компонента для livewire, что бы дописать методы.

Страница содержит таблицу пользователей, полностью на livewire. Есть поиск по двум полям пользователя, добавление, редактирование и удаление.

### Установка

Добавить `"./vendor/aweram/user-management/src/resources/views/**/*.blade.php"` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить трейт `use ShouldRole;` (use Aweram\UserManagement\Traits\ShouldRole;) в класс пользователя.
