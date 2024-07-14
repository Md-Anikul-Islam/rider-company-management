<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:site_name" content="Drive on"/>
    <meta property="og:description" content=""/>
    <link rel="shortcut icon" href="{{asset('backend/media/logos/favicon.ico')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{asset('backend/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="-kt-toolbar-height: 55px; --kt-toolbar-height-tablet-and-mobile: 55px;">

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
            data-kt-drawer-width="{default:'200px', '300px': '250px'}"
            data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_aside_mobile_toggle"
        >
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                 <a class="d-flex align-items-center gap-3" href="">
                    <img alt="Logo" src="{{asset('backend/media/logos/drive.jpg')}}" class="h-50px logo"/>
                    <h3 style="color: white">Company</h3>
                 </a>

                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2" data-kt-toggle="true" data-kt-toggle-state="active"
                    data-kt-toggle-target="body"
                    data-kt-toggle-name="aside-minimize"
                >
                    <i class="ki-outline ki-double-left fs-1 rotate-180"></i>
                </div>
            </div>

            <div class="aside-menu flex-column-fluid">
                <div class="hover-scroll-overlay-y py-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-height="auto"
                    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                    data-kt-scroll-wrappers="#kt_aside_menu"
                    data-kt-scroll-offset="0">>
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">

                        <div class="menu-item">
                            <a class="menu-link" href="{{route('company.dashboard')}}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-element-11 fs-2"></i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="{{route('company.car')}}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-rocket fs-2"></i>
                                </span>
                                <span class="menu-title">Car/Flet</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="{{route('company.driver')}}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-user fs-2"></i>
                                </span>
                                <span class="menu-title">Driver</span>
                            </a>
                        </div>

                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-address-book fs-2"></i>
                                </span>
                                <span class="menu-title">Trip</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link" href="{{route('company.trip')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                    <span class="menu-title">Trip</span>
                                    </a>
                                </div>
                            </div>
                             <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link" href="{{route('company.request.trip')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                    <span class="menu-title">Request Trip</span>
                                    </a>
                                </div>
                            </div>
                             <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link" href="{{route('company.manual.trip')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                    <span class="menu-title">Manual Trip</span>
                                    </a>
                                </div>
                            </div>
                             <div class="menu-sub menu-sub-accordion">
                                  <div class="menu-item">
                                      <a class="menu-link" href="{{route('company.agent.trip')}}">
                                          <span class="menu-bullet">
                                              <span class="bullet bullet-dot"></span>
                                          </span>
                                      <span class="menu-title">Agent Trip</span>
                                      </a>
                                  </div>
                              </div>
                        </div>

                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-setting-2 fs-2"></i>
                                </span>
                                <span class="menu-title">Settings</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">

                                <div class="menu-item">
                                    <a class="menu-link" href="{{route('company.password.change')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                    <span class="menu-title">Change Password</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            {{--TOP MENU ADMIN PROFILE--}}
            <div id="kt_header" class="header align-items-stretch">
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                        </div>
                        <div class="topbar d-flex align-items-stretch flex-shrink-0">
                            <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
                                <div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                    <img src="{{ asset('backend/media/avatars/user.jpg') }}" alt="metronic" />
                                </div>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="{{ asset('backend/media/avatars/user.jpg') }}" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span></div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5">
                                        <a class="menu-link px-5" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{--MAIN BODAY CONTENT--}}
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                @yield('company_content')
            </div>

            {{--FOOTER--}}
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-semibold me-1">2024&copy;</span>
                        <a href="https://www.etl.com.bd/" target="_blank" class="text-gray-800 text-hover-primary">Ezze Technology Ltd.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-outline ki-arrow-up"></i>
</div>

<script src="{{asset('backend/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('backend/js/scripts.bundle.js')}}"></script>
<script src="{{asset('backend/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('backend/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
<script src="{{asset('backend/js/widgets.bundle.js')}}"></script>
<script src="{{asset('backend/js/custom/widgets.js')}}"></script>
<script src="{{asset('backend/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('backend/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('backend/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('backend/js/custom/utilities/modals/bidding.js')}}"></script>
<script src="{{asset('backend/js/custom/utilities/modals/users-search.js')}}"></script>

{{-- Active Sidenav Script --}}
<script>
    $(document).ready(function () {
        var currentUrl = window.location.href;
        $('.menu-link').each(function () {
            var linkUrl = $(this).attr('href');
            if (currentUrl === linkUrl) {
                $(this).addClass('active');
                $(this).closest('.menu-accordion').addClass('show');
            }
        });
    });

    // Dashboard Card Number Trim
    function formatNumber(number) {
        if (number >= 1000000000) {
            return (Math.floor(number / 10000000) / 100) + 'B+';
        } else if (number >= 1000000) {
            return (Math.floor(number / 10000) / 100) + 'M+';
        } else if (number >= 10000) {
            return (Math.floor(number / 10) / 100) + 'k+';
        }
        return number.toLocaleString();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const numberElements = document.getElementsByClassName('trimNumber');
        for (let i = 0; i < numberElements.length; i++) {
            const numberElement = numberElements[i];
            const numberValue = parseInt(numberElement.innerText.replace(/,/g, ''), 10);
            numberElement.innerText = formatNumber(numberValue);
        }
    });
</script>
</body>
</html>
