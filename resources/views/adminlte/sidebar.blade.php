<div class="sidebar" id="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2" style="border-bottom: 1px solid #4b545c;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

{{--            <li class="nav-item">--}}
{{--                <a href="pages/mailbox/mailbox.html" class="nav-link">--}}
{{--                    <i class="nav-icon far fa-envelope"></i>--}}
{{--                    <p>--}}
{{--                        Письма--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item">
                <a href="{{route('admin_services_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Услуги</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin_post_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Проекты</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin_category_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Категории</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin_page_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Страницы</p>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="mt-2" id="logout">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <logout-component>
                    <template v-slot:icon>
                        <i class="nav-icon far ion-log-out"></i>
                    </template>
                </logout-component>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                    <form method="POST" action="{{ route('logout') }}" style="margin: 0" x-data>--}}
{{--                        @csrf--}}
{{--                        <i class="nav-icon far ion-log-out"></i>--}}
{{--                        <p @click.prevent="$root.submit();">Выйти</p>--}}
{{--                    </form>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </nav>
</div>

