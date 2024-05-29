@php($routeName = config('user-management.as') . 'users')
<x-tt::admin-menu.item href="{{ route($routeName) }}" :active="\Illuminate\Support\Facades\Route::currentRouteName() == $routeName">
    <x-slot name="ico">
        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.62495 5.00012C2.62509 4.28905 2.80905 3.5901 3.15896 2.97109C3.50887 2.35208 4.01285 1.83403 4.622 1.46722C5.23115 1.1004 5.92477 0.897281 6.63556 0.877563C7.34635 0.857846 8.05017 1.0222 8.67872 1.35468C9.30726 1.68716 9.83919 2.17647 10.2229 2.77513C10.6066 3.3738 10.829 4.06147 10.8686 4.77144C10.9081 5.4814 10.7635 6.18954 10.4487 6.82712C10.1339 7.46471 9.65965 8.0101 9.07195 8.41037C10.3376 8.87457 11.4353 9.7069 12.2239 10.8002C13.0125 11.8936 13.4559 13.1979 13.4969 14.5454C13.4952 14.6906 13.4374 14.8296 13.3356 14.9333C13.2338 15.0369 13.0958 15.0972 12.9506 15.1016C12.8054 15.106 12.6641 15.054 12.5563 14.9567C12.4484 14.8593 12.3824 14.724 12.3719 14.5791C12.3273 13.1177 11.7154 11.7311 10.6658 10.7132C9.6163 9.69523 8.21166 9.12594 6.74957 9.12594C5.28748 9.12594 3.88284 9.69523 2.83332 10.7132C1.78379 11.7311 1.17186 13.1177 1.1272 14.5791C1.11969 14.726 1.05495 14.8641 0.946865 14.9638C0.838777 15.0635 0.695929 15.117 0.548926 15.1127C0.401922 15.1083 0.262455 15.0466 0.160402 14.9407C0.0583487 14.8348 0.00182726 14.6932 0.00294598 14.5461C0.0438595 13.1985 0.487151 11.894 1.27576 10.8006C2.06437 9.70706 3.1622 8.87462 4.42795 8.41037C3.87207 8.03209 3.41717 7.52358 3.1029 6.92917C2.78863 6.33476 2.62455 5.67249 2.62495 5.00012ZM6.74995 2.00012C5.9543 2.00012 5.19123 2.31619 4.62863 2.8788C4.06602 3.44141 3.74995 4.20447 3.74995 5.00012C3.74995 5.79577 4.06602 6.55883 4.62863 7.12144C5.19123 7.68405 5.9543 8.00012 6.74995 8.00012C7.5456 8.00012 8.30866 7.68405 8.87127 7.12144C9.43388 6.55883 9.74995 5.79577 9.74995 5.00012C9.74995 4.20447 9.43388 3.44141 8.87127 2.8788C8.30866 2.31619 7.5456 2.00012 6.74995 2.00012ZM12.9674 5.00012C12.8564 5.00012 12.7484 5.00762 12.6419 5.02262C12.5676 5.03593 12.4913 5.03413 12.4177 5.01733C12.344 5.00052 12.2745 4.96906 12.2133 4.92481C12.1521 4.88056 12.1004 4.82443 12.0613 4.75977C12.0223 4.69511 11.9966 4.62325 11.986 4.54847C11.9753 4.47369 11.9798 4.39753 11.9992 4.32452C12.0185 4.25151 12.0524 4.18316 12.0988 4.12354C12.1452 4.06391 12.2031 4.01425 12.2691 3.97749C12.3351 3.94074 12.4078 3.91765 12.4829 3.90962C13.2289 3.80177 13.9895 3.94501 14.6451 4.31681C15.3007 4.6886 15.8141 5.26784 16.1044 5.96336C16.3947 6.65888 16.4456 7.4312 16.2489 8.15877C16.0522 8.88634 15.6192 9.52786 15.0179 9.98237C15.9017 10.3781 16.6521 11.0211 17.1786 11.8338C17.7051 12.6466 17.9851 13.5943 17.9849 14.5626C17.9849 14.7118 17.9257 14.8549 17.8202 14.9604C17.7147 15.0659 17.5716 15.1251 17.4224 15.1251C17.2733 15.1251 17.1302 15.0659 17.0247 14.9604C16.9192 14.8549 16.8599 14.7118 16.8599 14.5626C16.8599 13.7257 16.5902 12.9111 16.0909 12.2395C15.5916 11.5678 14.8893 11.0749 14.0879 10.8336L13.6874 10.7136V9.45662L13.9949 9.29987C14.4508 9.06897 14.8155 8.69121 15.0302 8.22755C15.2449 7.76389 15.2971 7.2414 15.1783 6.74444C15.0596 6.24747 14.7768 5.80503 14.3756 5.48854C13.9745 5.17205 13.4784 4.99998 12.9674 5.00012Z" fill="currentColor"/>
        </svg>
    </x-slot>
    {{ __("Users") }}
</x-tt::admin-menu.item>
