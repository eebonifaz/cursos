<div>
    <div>
        <style>
            [x-cloak] {
                display: none;
            }
        </style>

    <div class="antialiased sans-serif bg-gray-100 h-screen">
        <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
            <div class="container mx-auto px-4 py-2  ">

                <!-- <div class="font-bold text-gray-800 text-xl mb-4">
                    Schedule Tasks
                </div> -->

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <div class="flex items-center justify-between py-2 px-6">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <div class="border-r inline-flex h-6"></div>
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="-mx-1 -mb-1">
                        <div class="flex flex-wrap" style="margin-bottom: -40px;">
                            <template x-for="(day, index) in DAYS" :key="index">
                                <div style="width: 14.26%" class="px-2 py-2">
                                    <div
                                        x-text="day"
                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in blankdays">
                                <div
                                    style="width: 14.28%; height: 120px"
                                    class="text-center border-r border-b px-4 pt-2"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                    <div
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center  text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"
                                    ></div>
                                    <div style="height: 80px;" class="overflow-y-auto mt-1">
                                        <div
                                            class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                            x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                                            x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div>

                                        <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">
                                            <div
                                                class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                                                :class="{
                                                    'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                                                    'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                                                    'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                                                    'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                                                    'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
                                                }"
                                            >
                                                <p @click="showEventModal(event.event_title, event.event_descripcion, event.event_fecha_inicio, event.event_fecha_fin )" x-text="event.event_title" class="cursor-pointer text-sm truncate leading-tight"></p>


                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
                <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
                    <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                        x-on:click="openEventModal = !openEventModal">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                        </svg>
                    </div>

                    <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">

                        <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Evento</h2>

                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Nombre</label>
                            <p x-text="event_title" class="cursor-pointer text-sm truncate leading-tight"></p>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Descripción</label>
                            <p x-text="event_descripcion" class="cursor-pointer text-sm truncate leading-tight"></p>
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Duración</label>
                            <p class="cursor-pointer text-sm truncate leading-tight">Desde: <span x-text="event_fecha_inicio"></span></p>
                            <p class="cursor-pointer text-sm truncate leading-tight">Hasta: <span x-text="event_fecha_fin"></span></p>
                        </div>

                        <div class="mt-8 text-right">
                            <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </div>


        <script>
            const MONTH_NAMES = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre",
            ];
            const DAYS = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];

            function app() {
                return {
                    month: '',
                    year: '',
                    no_of_days: [],
                    blankdays: [],
                    days: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],

                    events: [

                        @foreach ($eventos as $evento)
                            @php
                                $period = Carbon\CarbonPeriod::create($evento->fecha_inicio, $evento->fecha_fin);
                            @endphp
                            @foreach ($period as $date)
                            {
                                event_date: new Date({{ $date->format("Y") }},{{ $date->format("n") - 1 }},{{ $date->format("j") }}),
                                event_title: "{{ $evento->nombre }}",
                                event_descripcion: "{{ $evento->descripcion }}",
                                event_fecha_inicio: "{{ $evento->fecha_inicio }}",
                                event_fecha_fin: "{{ $evento->fecha_fin }}",
                                event_theme: 'blue',
                            },
                            @endforeach
                        @endforeach
                    ],
                    event_title: '',
                    event_descripcion: '',
                    event_fecha_inicio: '',
                    event_fecha_fin: '',
                    event_theme: 'blue',

                    themes: [
                        {
                            value: "blue",
                            label: "Blue Theme"
                        },
                        {
                            value: "red",
                            label: "Red Theme"
                        },
                        {
                            value: "yellow",
                            label: "Yellow Theme"
                        },
                        {
                            value: "green",
                            label: "Green Theme"
                        },
                        {
                            value: "purple",
                            label: "Purple Theme"
                        }
                    ],

                    openEventModal: false,

                    initDate() {
                        let today = new Date();
                        this.month = today.getMonth();
                        this.year = today.getFullYear();
                        this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                    },

                    isToday(date) {
                        const today = new Date();
                        const d = new Date(this.year, this.month, date);

                        return today.toDateString() === d.toDateString() ? true : false;
                    },

                    showEventModal(title, descripcion, fecha_inicio, fecha_fin) {
                        // open the modal
                        this.openEventModal = true;
                        this.event_title = title;
                        this.event_descripcion = descripcion;
                        this.event_fecha_inicio = fecha_inicio;
                        this.event_fecha_fin = fecha_fin;
                    },

                    getNoOfDays() {
                        let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                        // find where to start calendar day of week
                        let dayOfWeek = new Date(this.year, this.month).getDay();
                        let blankdaysArray = [];
                        for ( var i=1; i <= dayOfWeek; i++) {
                            blankdaysArray.push(i);
                        }

                        let daysArray = [];
                        for ( var i=1; i <= daysInMonth; i++) {
                            daysArray.push(i);
                        }

                        this.blankdays = blankdaysArray;
                        this.no_of_days = daysArray;
                    }
                }
            }
        </script>
    </div>
</div>
