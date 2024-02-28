<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.main') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="#7367F0"/>
                  <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616"/>
                  <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616"/>
                  <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="#7367F0"/>
                </svg>
              </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
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
