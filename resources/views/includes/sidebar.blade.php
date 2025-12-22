<!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href={{route('home')}} class="logo"><i class="mdi mdi-assistant"></i> ДЖВ</a>
                        <!-- <a href="index.html" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="24" alt="logo"></a> -->
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title"><b>БЛОК РАЗВИТИЯ ПРОИЗВОДСТВА</b></li>

                           <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="mdi mdi-layers"></i> <span> ЗИМА/ЛЕТО </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
									<li><a href={{route('dashboard')}}>ДАШБОРД</a></li>
                                    <li><a href={{route('preparation-data.create')}}>ФОРМЫ</a></li>
                                    <li><a href="form-advanced.html">ТАБЛИЦЫ</a></li>
                                    <li><a href="form-editors.html">АНАЛИТИКА</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> ТАБЛО </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="advanced-highlight.html" class="text-uppercase">Страница табло</a></li>
                                    <li><a href="advanced-rating.html">ФОРМЫ</a></li>
                                    <li><a href="advanced-alertify.html">ТАБЛИЦЫ</a></li>
                                    <li><a href="advanced-rangeslider.html">АНАЛИТИКА</a></li>
                                </ul>
                            </li>
                          

                            <li class="menu-title"><b>БЛОК ПО УПРАВЛЕНИЮ ПЕРСОНАЛОМ, ТРУДОВЫМИ РЕСУРСАМИ И ОРГАНИЗАЦИОННОЙ СТРУКТУРОЙ</b></li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Основные кадровые показатели ДЖВ </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="advanced-highlight.html">Укомплектование работников Дирекции в разрезе РДЖВ</a></li>
                                    <li><a href="advanced-rating.html">Динамика изменения укомплектованности по основным профессиям Дирекции в разрезе РДЖВ</a></li>
                                    <li><a href="advanced-alertify.html">Список работников Дирекции, орган управления</a></li>
                                    <li><a href="advanced-rangeslider.html">Список работников РДЖВ</a></li>
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="mdi mdi-layers"></i> <span> ВАКЦИНАЦИЯ </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
									<li><a href={{route('worker.dashboard')}}>ДАШБОРД</a></li>
                                    <li><a href="#">ФОРМЫ</a></li>
                                    <li><a href={{route('worker.table')}}>ТАБЛИЦЫ</a></li>
                                    <li><a href={{route('worker.analytics')}}>АНАЛИТИКА</a></li>
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect"><i class="mdi mdi-layers"></i> <span> ПЕРВОЗИМНИКИ </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
									<li><a href={{route('dashboard')}}>ДАШБОРД</a></li>
                                    <li><a href={{route('preparation-data.create')}}>ФОРМЫ</a></li>
                                    <li><a href="form-advanced.html">ТАБЛИЦЫ</a></li>
                                    <li><a href="form-editors.html">АНАЛИТИКА</a></li>
                                </ul>
                            </li>
							
                          

                            <li class="menu-title"><b>БЛОК ПО РЕКОНСТРУКЦИИ И ИНВЕСТИЦИЯМ</b></li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Основные показатели по реконструкции и инвестициям </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="advanced-highlight.html">Выполнение инвестиционной программы</a></li>
                                    <li><a href="advanced-rating.html">Выполнение программы капитального ремонта </a></li>
                                    <li><a href="advanced-alertify.html">Выполнение программы текущего ремонта</a></li>
                                    <li><a href="advanced-rangeslider.html">Техническое состояние и неисправности подъемно-транспортного оборудования в разрезе РДЖВ</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->
