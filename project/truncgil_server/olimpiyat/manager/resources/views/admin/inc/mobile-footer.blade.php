<?php use App\Types; ?>

<?php $types = Types::whereNull("kid")->orderBy("s","ASC")->get(); ?>
<?php $u = u(); ?>

        <footer class="main-footer mobile-footer <?php if($u->level=="Öğrenci") echo "d-none"; ?>">
            <div class="container">

                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item"><a href="{{url("admin")}}" class="nav-link waves active waves-effect"><span><i
                                    class="nav-icon fa fa-solid fa-chart-pie"></i> <span
                                    class="nav-text">{{e2("Özet")}}</span></span></a></li>
                 
                  
                    <li class="nav-item"><a href="{{url("admin/types/cihazlar")}}"
                            class="nav-link waves waves-effect"><span><i class="nav-icon fa fa-cog"></i> <span
                                    class="nav-text">{{e2("Cihazlarım")}}</span></span></a></li>
                    <li class="nav-item"><a
                            
                            class="nav-link waves" data-toggle="layout" data-action="side_overlay_toggle"><span><i class="nav-icon fa fa-user"></i> <span
                                    class="nav-text">{{e2("Profil")}}</span></span></a></li>
                </ul>
            </div>
        </footer>