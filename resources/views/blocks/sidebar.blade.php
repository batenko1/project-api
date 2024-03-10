<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.main') }}" class="app-brand-link">
            <img
                width="50"
                src="{{ asset('storage/'. \Str::replace('public', '', \App\Models\Setting::query()->where('key', 'logo')->first()->value)) }}" alt="">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item @if(strpos(Route::currentRouteName(),'admin.main') !== false) active @endif">
            <a href="{{ route('admin.main') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Главная</div>
            </a>
        </li>

        @can('index user')
            <!-- Layouts -->
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.users') !== false) active @endif">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                    <div>Пользователи</div>
                </a>
            </li>
        @endcan

        @can('index role')
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.roles.index') !== false) active @endif">
                <a href="{{ route('admin.roles.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-files"></i>
                    <div>Роли</div>
                </a>
            </li>
        @endcan


        @can('index entity')
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.entities') !== false) active @endif">
                <a href="{{ route('admin.entities.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail"></i>
                    <div>Категории</div>
                </a>
            </li>
        @endcan

        @can('index product')
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.products') !== false) active @endif">
                <a href="{{ route('admin.products.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                    <div>Товары</div>
                </a>
            </li>
        @endcan


        @can('index template')
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.templates') !== false) active @endif">
                <a href="{{ route('admin.templates.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-messages"></i>
                    <div>Шаблоны</div>
                </a>
            </li>
        @endcan


        @can('index order')
            <li class="menu-item @if(strpos(Route::currentRouteName(), 'admin.orders') !== false) active @endif">
                <a href="{{ route('admin.orders.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div>Заказы</div>
                </a>
            </li>
        @endcan

        @can('index account')
            <li class="menu-item @if(str_contains(Route::currentRouteName(), 'admin.accounts')) active @endif">
                <a href="{{ route('admin.accounts.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-id"></i>
                    <div>Покупатели</div>
                </a>
            </li>
        @endcan

        @can('index chat')
            <li class="menu-item @if(str_contains(Route::currentRouteName(),'admin.chat')) active @endif">
                <a href="{{ route('admin.chat.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                    <div>Чат</div>
                    <span class="badge bg-primary" style="display: inline-block; margin-left:10px;"
                    >{{ \App\Models\Message::query()->where('is_read', 0)->count() }}</span>
                </a>
            </li>
        @endcan

        @can('index setting')
            <li class="menu-item @if(str_contains(Route::currentRouteName(), 'admin.settings')) active @endif">
                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                    <div>Настройки</div>
                </a>

            </li>
        @endcan

    </ul>
</aside>
