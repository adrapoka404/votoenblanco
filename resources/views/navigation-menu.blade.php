<style>
    [x-cloak] {
        display: none;
    }
</style>
<script>
    document.addEventListener('alpine:init', () => {
        // Stores variable globally 
        Alpine.store('sidebar', {
            full: true,
            active: 'home',
            navOpen: false
        });
        // Creating component Dropdown
        Alpine.data('dropdown', () => ({
            open: false,
            toggle(tab) {
                this.open = !this.open;
                Alpine.store('sidebar').active = tab;
            },
            activeClass: 'bg-white text-black',
            expandedClass: '',
            shrinkedClass: 'sm:absolute top-0 left-20 sm:shadow-md sm:z-10 sm:bg-gray sm:rounded-md sm:p-4 border-l sm:border-none border-gray ml-4 pl-4 sm:ml-0 w-28'
        }));
        // Creating component Sub Dropdown
        Alpine.data('sub_dropdown', () => ({
            sub_open: false,
            sub_toggle() {
                this.sub_open = !this.sub_open;
            },
            sub_expandedClass: '',
            sub_shrinkedClass: 'sm:absolute top-0 left-28 sm:shadow-md sm:z-10 sm:bg-gray-dark sm:rounded-md sm:p-4 border-l sm:border-none border-gray-dark ml-4 pl-4 sm:ml-0 w-28'
        }));
        // Creating tooltip
        Alpine.data('tooltip', () => ({
            show: false,
            visibleClass: 'block sm:absolute -top-7 sm:border border-black left-5 sm:text-sm sm:bg-black text-white sm:px-2 sm:py-1 sm:rounded-md'
        }))

    })
</script>
<!-- Mobile Menu Toggle -->
<button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen"
    class="sm:hidden absolute top-5 right-5 focus:outline-none">
    <!-- Menu Icons -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" x-bind:class="$store.sidebar.navOpen ? 'hidden' : ''"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>

    <!-- Close Menu -->
    <svg x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
        x-bind:class="$store.sidebar.navOpen ? '' : 'hidden'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<div class="h-screen bg-black transition-all duration-300 space-y-2 fixed sm:relative"
    x-bind:class="{
        'w-64': $store.sidebar.full,
        'w-64 sm:w-20': !$store.sidebar.full,
        'top-0 left-0': $store.sidebar
            .navOpen,
        'top-0 -left-64 sm:left-0': !$store.sidebar.navOpen
    }">

    <h1 class="text-white font-black py-4"
        x-bind:class="$store.sidebar.full ? 'text-2xl px-4' : 'text-xl px-4 xm:px-2'">
        <a href="/">LOGO</a>
    </h1>

    <div class="px-4 space-y-2">

        <!-- SideBar Toggle -->
        <button @click="$store.sidebar.full = !$store.sidebar.full"
            class="hidden sm:block focus:outline-none absolute p-1 -right-3 top-10 bg-black rounded-full shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-all duration-300 text-white transform"
                x-bind:class="$store.sidebar.full ? 'rotate-90' : '-rotate-90 '" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        @can('dashboard')
            <!-- Home -->
            <div x-data="tooltip" x-on:mouseover="show = true" x-on:mouseleave="show = false"
                @click="$store.sidebar.active = 'home' "
                class=" relative flex items-center hover:text-black hover:bg-white space-x-2 rounded-md p-2 cursor-pointer"
                x-bind:class="{
                    'justify-start': $store.sidebar.full,
                    'sm:justify-center': !$store.sidebar
                        .full,
                    'text-black bg-white': $store.sidebar.active == 'home',
                    'text-black bg-white ': $store.sidebar
                        .active != 'home'
                }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <a href="{{ route('dashboard') }}" x-cloak
                    x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ? 'sm:hidden' : ''">
                    Tablero</a>
            </div>
        @endcan
        <!-- Profile -->
        <div x-data="dropdown" class="relative">
            <!-- Dropdown head -->
            <div @click="toggle('profile')" x-data="tooltip" x-on:mouseover="show = true"
                x-on:mouseleave="show = false"
                class="flex justify-between text-white hover:text-black hover:bg-white items-center space-x-2 rounded-md p-2 cursor-pointer"
                x-bind:class="{
                    'justify-start': $store.sidebar.full,
                    'sm:justify-center': !$store.sidebar
                        .full,
                    'text-white bg-black': $store.sidebar.active == 'profile',
                    'text-white ': $store.sidebar
                        .active != 'profile'
                }">
                <div class="relative flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span x-cloak
                        x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ?
                            'sm:hidden' : ''">
                        Perfil</span>
                </div>
                <svg x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'" xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <!-- Dropdown content -->
            <div x-cloak x-show="open" @click.outside="open =false"
                x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
                class="text-black bg-gray-dark space-y-3 ">
                @can('profile.show')
                <div>
                    <a class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block"
                        href="{{ route('profile.show') }}">
                        Mi perfil
                    </a>
                </div>
                @endcan
                @can('admin.editor.profile.edit')
                <div>
                    <a class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block"
                        href="{{ route('admin.editor.profile.edit', auth()->user()->id) }}">
                        Editar perfil
                    </a>
                </div>
                @endcan
                <div>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        {!! Form::submit('Cerrar sesión', [
                            'class' =>
                                'bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block',
                        ]) !!}
                    </form>
                </div>
            </div>
        </div>
        <!-- Audience -->
        @if (Auth::user()->can('admin.notas.index'))
        <div x-data="dropdown" class="relative">
            <!-- Dropdown head -->
            <div @click="toggle('audience')" x-data="tooltip" x-on:mouseover="show = true"
                x-on:mouseleave="show = false"
                class="flex justify-between text-white hover:text-black hover:bg-white items-center space-x-2 rounded-md p-2 cursor-pointer"
                x-bind:class="{
                    'justify-start': $store.sidebar.full,
                    'sm:justify-center': !$store.sidebar
                        .full,
                    'text-white bg-black': $store.sidebar.active == 'audience',
                    'text-white ': $store.sidebar
                        .active != 'audience'
                }">
                <div class="relative flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span x-cloak
                        x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ?
                            'sm:hidden' : ''">
                        Post</span>
                </div>
                <svg x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'" xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <!-- Dropdown content -->
            <div x-cloak x-show="open" @click.outside="open =false"
                x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
                class="text-black bg-gray-dark space-y-3 ">
                @if (Auth::user()->can('admin.notas.index'))
                    
                <div>
                    <a class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block"
                        href="{{ route('admin.notas.index') }}">
                        Todas
                    </a>
                </div>
                @endif
                
                @can('admin.notas.create')
                
                <div>
                    <a class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block"
                        href="{{ route('admin.notas.create') }}">
                        Crear Post
                    </a>
                </div>
                @endcan
            </div>
        </div>
        @endif
        <!-- Posts -->
        <!--div @click="$store.sidebar.active = 'posts' " x-data="tooltip" x-on:mouseover="show = true"
            x-on:mouseleave="show = false"
            class=" relative flex justify-between items-center text-white hover:text-black hover:bg-white space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{
                'justify-start': $store.sidebar.full,
                'sm:justify-center': !$store.sidebar
                    .full,
                'text-white bg-black': $store.sidebar.active == 'posts',
                'text-white ': $store.sidebar.active !=
                    'posts'
            }">
            <div class="flex  items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <a x-cloak href="#"
                    x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ? 'sm:hidden' : ''">
                    Disponible
                </a>
            </div>
            <h1 x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'"
                class="w-5 h-5 p-1 bg-green rounded-full text-sm leading-3 text-center text-white">8</h1>
        </div-->

        <!-- Schedules -->
        <!--div @click="$store.sidebar.active = 'home' " x-data="tooltip" x-on:mouseover="show = true"
            x-on:mouseleave="show = false"
            class=" relative flex justify-between items-center text-white hover:text-black hover:bg-white space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{
                'justify-start': $store.sidebar.full,
                'sm:justify-center': !$store.sidebar
                    .full,
                'text-white bg-black': $store.sidebar.active == 'schedules',
                'text-white ': $store.sidebar
                    .active != 'schedules'
            }">
            <div class="flex  items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h1 x-cloak
                    x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ? 'sm:hidden' : ''">
                    Schedules</h1>
            </div>
            <div x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="w-5 h-5 p-1 bg-pink-400 rounded-sm text-sm leading-3 text-center text-gray">3
                </h1>

            </div>
        </div-->
        <!-- Income -->
        @can('admin.editors.index')
        <div x-data="dropdown" class="relative">
            <!-- Dropdown head -->
            <div @click="toggle('income')" x-data="tooltip" x-on:mouseover="show = true"
                x-on:mouseleave="show = false"
                class="flex justify-between text-white hover:text-black hover:bg-white items-center space-x-2 rounded-md p-2 cursor-pointer"
                x-bind:class="{
                    'justify-start': $store.sidebar.full,
                    'sm:justify-center': !$store.sidebar
                        .full,
                    'text-gray-200 bg-gray-800': $store.sidebar.active == 'income',
                    'text-white ': $store.sidebar
                        .active != 'income'
                }">
                <div class="relative flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    <h1 x-cloak
                        x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ?
                            'sm:hidden' : ''">
                        Configuración</h1>
                </div>
                <svg x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'" xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <!-- Dropdown content -->
            <div x-cloak x-show="open" @click.outside="open=false"
                x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
                class="text-black bg-gray-dark space-y-3">
                @can('admin.editors.index')
                <a class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:bg-white cursor-pointer pl-2 block"
                    href="{{ route('admin.editors.index') }}">
                    Editores
                </a>
                @endcan
                @can('admin.editors.create')
                <a href="{{ route('admin.editors.create') }}"
                    class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:text-black hover:bg-white cursor-pointer pl-2 block">
                    Crear editor
                </a>
                @endcan
                <!-- Sub Dropdown  -->
                <div x-data="sub_dropdown" class="relative w-full ">
                    <div @click="sub_toggle()" class="flex items-center justify-between cursor-pointer">
                        <h1
                            class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:text-black hover:bg-white cursor-pointer pl-2">
                            Generales</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    
                    <div x-show="sub_open" @click.outside="sub_open = false"
                        x-bind:class="$store.sidebar.full ? sub_expandedClass : sub_shrinkedClass">
                        @can('admin.videogalerias.index')
                        <a href="{{ route('admin.videogalerias.index') }}"
                            class="bg-gray-dark hover:text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine pl-2 cursor-pointer ">
                            Video Galerias
                        </a>
                        @endcan
                    </div>
                </div>
                <h1
                    class="bg-gray-dark border-l-4 border-l-gray-dark hover:border-l-wine hover:text-black hover:bg-white cursor-pointer pl-2">
                    Item 4</h1>
            </div>
        </div>
        @endcan
        <!-- Promote -->
        @can('sudo.roles.index')
        <div x-data="dropdown" class="relative">
            <!-- Dropdown head -->
            <div @click="toggle('promote')" x-data="tooltip" x-on:mouseover="show = true"
                x-on:mouseleave="show = false"
                class="flex justify-between text-white hover:text-black hover:bg-white items-center space-x-2 rounded-md p-2 cursor-pointer"
                x-bind:class="{
                    'justify-start': $store.sidebar.full,
                    'sm:justify-center': !$store.sidebar
                        .full,
                    'text-black bg-white': $store.sidebar.active == 'promote',
                    'text-white ': $store.sidebar
                        .active != 'promote'
                }">
                <div class="relative flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <h1 x-cloak
                        x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ?
                            'sm:hidden' : ''">
                        Super Do</h1>
                </div>
                <svg x-cloak x-bind:class="$store.sidebar.full ? '' : 'sm:hidden'" xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <!-- Dropdown content -->
            <div x-cloak x-show="open" @click.outside="open=false"
                x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
                class="text-white bg-gray-dark space-y-3">
                @can('sudo.roles.index')
                <div>
                    <a href="{{ route('sudo.roles.index') }}"
                        class="bg-gray-dark text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine ml-2 cursor-pointer block">
                        Roles</a>
                </div>
                @endcan
                @can('sudo.permissions.index')
                <div>
                    <a href="{{ route('sudo.permissions.index') }}"
                        class="bg-gray-dark text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine ml-2 cursor-pointer block">
                        Permisos</a>
                </div>
                @endcan
                @can('sudo.asign.permissions.index')
                <div>
                    <a href="{{ route('sudo.asign.permissions.index') }}"
                        class="bg-gray-dark text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine ml-2 cursor-pointer block">
                        Asignar Roles</a>
                </div>
                @endcan
                @can('admin.categorias.index')
                <div>
                    <a href="{{ route('admin.categorias.index') }}"
                        class="bg-gray-dark text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine ml-2 cursor-pointer block">
                        Categorías
                    </a>
                </div>
                @endcan
                @can('admin.notas.estatus.index')
                <div>
                    <a class="bg-gray-dark text-black hover:bg-white border-l-4 border-l-gray-dark hover:border-l-wine ml-2 cursor-pointer block"
                        href="{{ route('admin.notas.estatus.index') }}">
                        Catalogo de estados
                    </a>
                </div>
                @endcan
            </div>
        </div>
        @endcan
        <!-- Suscriptors -->
        @can('admin.suscriptores.index')
        <div x-data="tooltip" x-on:mouseover="show = true" x-on:mouseleave="show = false"
            @click="$store.sidebar.active = 'suscriptors' "
            class=" relative flex items-center hover:text-black hover:bg-white space-x-2 rounded-md p-2 cursor-pointer"
            x-bind:class="{
                'justify-start': $store.sidebar.full,
                'sm:justify-center': !$store.sidebar
                    .full,
                'text-black bg-white': $store.sidebar.active == 'suscriptors',
                'text-black bg-white ': $store.sidebar
                    .active != 'suscriptors'
            }">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <a href="{{ route('admin.suscriptores.index') }}" x-cloak
                x-bind:class="!$store.sidebar.full && show ? visibleClass : '' || !$store.sidebar.full && !show ? 'sm:hidden' : ''">
                Suscriptores</a>
        </div>
        @endcan
    </div>
</div>
