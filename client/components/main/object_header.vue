<template>
    <div class="position-relative w-100">
        <div class="p-0 m-0 border-0 position-absolute header__slider" style="">
            <div class="header_object__slide">
                <img src="@/assets/images/png/slide_1-min.png" alt="">
                <div class="header_object__slide_blackoutTop"></div>
                <div class="header_object__slide_blackout"></div>
            </div>
        </div>
        <div class="header" v-click-outside="externalClick">
            <div class="container_1290 position-relative">
                <b-navbar toggleable="lg" variant="transparent" class="p-0 text-center align-items-center">
                    <div class="d-flex justify-content-between align-items-center w-100 mt-20">
                        <nuxt-link to="/" class="header__logo">
                            <img src="@/assets/images/svg/logo/russian-light.svg">
                        </nuxt-link>
                        <b-navbar-nav class="text-center align-items-center h-100">
                            <nuxt-link to="/" class="header__navItem text-decoration-none">О компании</nuxt-link>
                            <nuxt-link to="/developers" class="header__navItem text-decoration-none">Застройщики</nuxt-link>
                            <nuxt-link to="/" class="header__navItem text-decoration-none">Уникальность проектов</nuxt-link>
                            <nuxt-link to="/" class="header__navItem text-decoration-none">Карьера</nuxt-link>
                            <nuxt-link to="/" class="header__navItem text-decoration-none">Тендеры</nuxt-link>
                            <nuxt-link to="/" class="header__navItem text-decoration-none">Контакты</nuxt-link>
                        </b-navbar-nav>
                        <div>
                            <a href="tel:+998732440535" class="d-block header__phone text-decoration-none">(73) 244 05 35</a>
                            <a href="tel:+998732440535" class="d-block header__phone_text">Связаться с нами</a>                           
                        </div>
                    </div>
                </b-navbar> 
            </div>     
            <div class="container_1290 position-relative">
                <div class="header_object__selectProperty_title">Жилой комплекс</div>                 
                <div class="header_object__selectProperty_name">Резеденция вашей мечты</div>                 
                <div class="header_object__selectProperty_btn">
                    <b-button @click="moveToBuildings" variant="transparent" class="header_object__lightBtn shadow-none">Выбрать квартиру</b-button>             
                </div>                             
            </div>                  
        </div>
    </div>
</template>

<script>
import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'
import vClickOutside from 'v-click-outside'

  export default {
    directives: {
      clickOutside: vClickOutside.directive
    },
    components: { 
        VSelectize
    },
    methods: {
        openSearsearchBar__chckbxar(SearcBarState) {
            this.SearcBarState = true;
            console.log(SearcBarState);
        },       
        closeSearsearchBar__chckbxar(SearcBarState) {
            this.SearcBarState = false;
            console.log(SearcBarState);
        },
        moveToBuildings () {
            const $appartments = document.getElementById('appartments');
            $appartments.scrollIntoView({ 
                block: 'nearest',
                behavior: 'smooth'
            });
        },
        externalClick (SearcBarState) {
            this.SearcBarState = false
        }
    },
    data() {
      return {
        SearcBarState: false,
        mainSlider: {
            arrows: false,
            dots: true,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 3500,
            vertical: true,
            speed: 2000,
            pauseOnHover: false
        },
        roominessItems: [
          {
            id: 'num-1',
            size: "1",
            value: '1'
          },
          {
            id: 'num-2',
            size: "2",
            value: '2'
          },
          {
            id: 'num-3',
            size: "3",
            value: '4'
          },
          {
            id: 'num-4',
            size: "4",
            value: '4'
          },
          {
            id: 'num-5',
            size: "5+",
            value: '5'
          }
        ],        
        selected_roominess: '', 
        deadlineItems: {
            deadlines: [
                '1 мес',
                '3 мес',
                '5+ мес'
            ],
            discounts: [
                'Да',
                'Нет'
            ]
        },   
        selected_deadline: {
            deadline: null,
            discount: null
        },
        locationOptions: {
            countries: [
                'Фергана',
                'Ташкент',
                'Самарканд'
            ],
            districts: [
                'Юнособадский',
                'Сергелийский',
                'Мирабадский'
            ],
            streets: [
                'Ислама Каримова',
                'Зухура Кобулова',
                'Лабзак'
            ]
        },
        selected_locationOptions: {
            country: null,
            district: null,
            street: null
        },
        apartmantPerFloor: [
          '1',
          '2',
          '3',
          '4',
          '5+'
        ],
        selected_apartmantPerFloor: null,
        filterHouseState: '',
        filterHouse: [
            {
                id: 'searchBar__chckbx-1',
                name: "С отделкой",
                class: "searchBar__chckbx-190",
                state: false
            },
            {
                id: 'searchBar__chckbx-2',
                name: "Ипотека",
                class: "",
                state: false
            },
            {
                id: 'searchBar__chckbx-3',
                name: "Матерински капитал",
                class: "searchBar__chckbx-280",
                state: false
            },
            {
                id: 'searchBar__chckbx-4',
                name: "Эскроу-счет",
                class: "searchBar__chckbx-175",
                state: false
            },
            {
                id: 'searchBar__chckbx-5',
                name: "Старт продаж",
                class: "searchBar__chckbx-175",
                state: false
            },
            {
                id: 'searchBar__chckbx-6',
                name: "Панорамные окна",
                class: "searchBar__chckbx-220",
                state: false
            },
            {
                id: 'searchBar__chckbx-7',
                name: "Ипотека с первым взносом 0%",
                class: "searchBar__chckbx-350",
                state: false
            },
            {
                id: 'searchBar__chckbx-8',
                name: "Рассрочка",
                class: "",
                state: false
            },
            {
                id: 'searchBar__chckbx-9',
                name: "Рядом парк",
                class: "searchBar__chckbx-160",
                state: false
            },
        ]
      }
    }
  }
</script>