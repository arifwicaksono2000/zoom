<div class="horizontal-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ url('assets') }}/images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-body fw-medium font-size-16">Arif Wicaksono</a>
                <p class="text-muted mt-1 mb-0 font-size-13">Kantor Pusat</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu Utama</li>
                <li>
                    <a href="{{ route('dashboard') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{-- route('ijinprinsip') --}}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>List Ijin Prinsip</span>
                    </a>
                </li>
                <br>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>