<template>
    <div class="position-relative w-100">
        <VueSlickCarousel v-bind="mainSlider" class="p-0 m-0 border-0 position-absolute header__slider" style="">
            <div class="header__slide">
                <img src="@/assets/images/png/slide_1-min.png" alt="">
                <div class="header__slide_blackoutTop"></div>
                <div class="header__slide_blackout"></div>
            </div>
            <div class="header__slide">
                <img src="@/assets/images/png/slide_2-min.png" alt="">
                <div class="header__slide_blackoutTop"></div>
                <div class="header__slide_blackout"></div>
            </div>
            <div class="header__slide">
                <img src="@/assets/images/png/slide_3-min.png" alt="">
                <div class="header__slide_blackoutTop"></div>
                <div class="header__slide_blackout"></div>
            </div>
            <div class="header__slide">
                <img src="@/assets/images/png/slide_4-min.png" alt="">
                <div class="header__slide_blackoutTop"></div>
                <div class="header__slide_blackout"></div>
            </div>
        </VueSlickCarousel>
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

                            <div class="position-relative header__language">
                                <div class="header__language_block position-absolute">
                                    <b-button variant="transparent" class="header__language_btn shadow-none">Рус</b-button>
                                    <b-button variant="transparent" class="header__language_btn shadow-none">Eng</b-button>
                                    <b-button variant="transparent" class="header__language_btn shadow-none">Узб</b-button>
                                </div>
                            </div>
                        </b-navbar-nav>
                        <div>
                            <div><a href="tel:+712008822" class="header__phone text-decoration-none">(71) 200 88 22</a></div>
                            <div><a href="tel:+712008822" class="header__phone_text">Связаться с нами</a></div>                            
                        </div>
                    </div>
                </b-navbar> 
            </div>     
            <div class="container_1290 position-relative">
                <div v-bind:class="{ header__searchBar_open: SearcBarState }" class="header__searchBar_close bg-white">   
                    <div class="container_1290 px-20">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="m-0 h-100 searchBar__title">Поиск новостроек</div>
                            <b-button 
                                variant="transparent" 
                                @click="closeSearsearchBar__chckbxar(SearcBarState)"
                                class="header__searchBar_closeBtn align-items-center p-0 m-0 shadow-none d-flex algn-items-center"
                            >
                                <span>Скрыть поиск</span>
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-15">
                                    <path d="M16.772 0L19.9809 3.21199L3.20893 20L0 16.788L16.772 0Z"/>
                                    <path d="M3.22801 0L0.0190783 3.21199L16.7911 20L20 16.788L3.22801 0Z"/>
                                </svg>   
                            </b-button>
                        </div>
                    </div>
                    <div class="container_1290">
                        <div>                        
                            <input type="text" placeholder="Название новостройки или застройщика" class="searchBar__input"></input>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between">
                            <div>
                                <div class="searchBar__title_sm">Расположение</div>
                                <div class="d-flex mt-20">
                                    <v-selectize 
                                        placeholder="Город"
                                        v-model="selected_locationOptions.country" 
                                        :options="locationOptions.countries"
                                        class="searchBar__selectize select-300"
                                    />
                                    <v-selectize 
                                        placeholder="Район"
                                        v-model="selected_locationOptions.district" 
                                        :options="locationOptions.districts"
                                        class="searchBar__selectize select-200"
                                    />
                                    <v-selectize 
                                        placeholder="Улица"
                                        v-model="selected_locationOptions.street" 
                                        :options="locationOptions.streets"
                                        class="searchBar__selectize select-200"
                                    />
                                </div>
                            </div>
                            <div>
                                <div class="searchBar__title_sm">Цена за квартиру</div>
                                <div class="d-flex mt-20">          
                                    <b-form class="d-flex">
                                        <input
                                            id="input-1"
                                            type="number"
                                            placeholder="от"
                                            class="searchBar__input shadow-none width-200 mr-20"
                                        ></input>
                                        <input
                                            id="input-1"
                                            type="number"
                                            placeholder="до"
                                            class="searchBar__input shadow-none width-200"
                                        ></input>
                                    </b-form>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div>
                                <div class="searchBar__title_sm">Комнатность</div>
                                <div class="d-flex custom-radio-label mt-20">
                                    <div class="searchBar__txtRoom">Студии</div>
                                    <div class="mr-20" v-for="item in roominessItems" :key="item.id">
                                        <input 
                                            type="radio" 
                                            class="searchBar__radio" 
                                            :class="item.classDisabled"
                                            v-model="selected_roominess" 
                                            :value="item.size" 
                                            :id="item.id" 
                                            :name="item.id"
                                            :disabled="item.disabled"
                                        ></input>
                                        <label :for="item.id" class="searchBar__radio_label"><span>{{ item.size }}</span></label> 
                                    </div>
                                    <div class="searchBar__txtRoom p-13-56">Пентхаус</div>
                                </div>  
                            </div>
                            <div>
                                <div class="searchBar__title_sm">Срок сдачи</div>
                                <div class="d-flex mt-20">
                                    <v-selectize 
                                        placeholder="Любой"
                                        v-model="selected_deadline.deadline" 
                                        :options="deadlineItems.deadlines"
                                        class="searchBar__selectize select-190"
                                    />
                                    <v-selectize 
                                        placeholder="Есть скидки"
                                        v-model="selected_deadline.discount" 
                                        :options="deadlineItems.discounts"
                                        class="searchBar__selectize select-190"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap mt-32">
                            <div class="py-1 mt-2">
                                <div>
                                    <form class="d-flex flex-wrap">
                                        <span v-model="filterHouseState" v-for="item in filterHouse" :key="item.id">                                        
                                            <input type="checkbox" class="searchBar__checkbox" v-model="item.state" :class="item.class" :id="item.id" :name="item.id"></input>
                                            <label class="searchBar__checkbox-label" :for="item.id"><span>{{ item.name }}</span></label>
                                        </span> 
                                        <input type="checkbox" class="searchBar__checkbox searchBar__chckbx-250" id="checkbox-7984651235646" name="checkbox-7984651235646"></input>
                                        <label class="searchBar__checkbox-label" for="checkbox-7984651235646">
                                            <span>
                                                Онлайн покупка
                                                <svg class="ml-9" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4995 0C5.14908 0 0 5.14908 0 11.4995C0 17.8499 5.14908 23 11.4995 23C17.8499 23 23 17.8499 23 11.4995C23 5.14908 17.8499 0 11.4995 0ZM13.8935 17.8227C13.3015 18.0563 12.8303 18.2335 12.477 18.3562C12.1245 18.4789 11.7147 18.5402 11.2483 18.5402C10.5318 18.5402 9.97397 18.365 9.57676 18.0154C9.17955 17.6659 8.98193 17.223 8.98193 16.6846C8.98193 16.4753 8.99653 16.2611 9.02573 16.043C9.05591 15.825 9.10362 15.5796 9.16885 15.3041L9.90971 12.6872C9.97494 12.4361 10.0314 12.1975 10.0762 11.9756C10.121 11.7517 10.1424 11.5462 10.1424 11.3593C10.1424 11.0264 10.0733 10.7927 9.936 10.6613C9.79678 10.5299 9.5349 10.4656 9.14451 10.4656C8.95369 10.4656 8.75704 10.4938 8.55551 10.5532C8.35594 10.6146 8.18264 10.6701 8.04051 10.7246L8.23619 9.91848C8.72102 9.72085 9.1854 9.55145 9.62836 9.41126C10.0713 9.26912 10.4899 9.19903 10.8842 9.19903C11.5959 9.19903 12.145 9.37232 12.5315 9.715C12.916 10.0587 13.1098 10.5055 13.1098 11.0546C13.1098 11.1685 13.0961 11.3691 13.0698 11.6553C13.0436 11.9425 12.9939 12.2044 12.9219 12.4448L12.1849 15.0539C12.1245 15.2632 12.071 15.5027 12.0223 15.7705C11.9746 16.0382 11.9512 16.2426 11.9512 16.3799C11.9512 16.7265 12.0281 16.963 12.1839 17.0886C12.3377 17.2142 12.6074 17.2775 12.989 17.2775C13.1691 17.2775 13.3707 17.2454 13.5985 17.1831C13.8243 17.1208 13.9879 17.0653 14.0911 17.0176L13.8935 17.8227ZM13.763 7.23247C13.4193 7.55179 13.0056 7.71145 12.5217 7.71145C12.0389 7.71145 11.6222 7.55179 11.2756 7.23247C10.931 6.91314 10.7567 6.5247 10.7567 6.07103C10.7567 5.61833 10.9319 5.22891 11.2756 4.90667C11.6222 4.58345 12.0389 4.42281 12.5217 4.42281C13.0056 4.42281 13.4203 4.58345 13.763 4.90667C14.1067 5.22891 14.279 5.61833 14.279 6.07103C14.279 6.52567 14.1067 6.91314 13.763 7.23247Z"/>
                                                </svg>
                                            </span>
                                        </label> 
                                        <span class="width-320">
                                            <v-selectize 
                                                placeholder="Кол-во квартир на этаже"
                                                v-model="selected_apartmantPerFloor" 
                                                :options="apartmantPerFloor"
                                                class="searchBar__selectize select-300 m-0 width-320"
                                            />
                                        </span>
                                    </form>
                                </div>    
                            </div>   
                        </div>
                        <div class="d-flex justify-content-between mt-20">                    
                            <div class="d-flex flex-wrap">
                                <b-button variant="transparent" class="searchBar__sortingBtn shadow-none">Посмотреть 146 ЖКХ</b-button>
                                <b-button variant="transparent" class="searchBar__sortingBtn shadow-none">Новостройки премиум-класса</b-button>
                                <b-button variant="transparent" class="searchBar__sortingBtn shadow-none" to="/map">
                                    <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.72222 0C4.36154 0 0 4.27148 0 9.52149C0 11.5991 0.670086 13.5732 1.93946 15.2295L9.12293 24.7046C9.14088 24.7276 9.1683 24.7364 9.18825 24.7569C9.54722 25.1334 10.0652 25.0386 10.321 24.7046C12.3896 22.0015 16.1813 16.9531 17.6391 15.0488C17.6391 15.0488 17.6396 15.0474 17.6401 15.0464L17.6491 15.0347C18.8237 13.4185 19.4444 11.5122 19.4444 9.52149C19.4444 4.27148 15.0829 0 9.72222 0ZM9.72222 14.6582C6.83597 14.6582 4.47721 12.3481 4.47721 9.52149C4.47721 6.69482 6.83597 4.38477 9.72222 4.38477C12.6085 4.38477 14.9672 6.69482 14.9672 9.52149C14.9672 12.3481 12.6085 14.6582 9.72222 14.6582Z"/>
                                    </svg>
                                    Поиск на карте
                                </b-button>
                            </div>
                            <div>
                                <b-button variant="transparent" class="searchBar__confirmBtn shadow-none" to="/search_result">                          
                                    Найти
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.37201 14.7559C8.88978 14.7559 10.2919 14.2929 11.4628 13.5118L15.6981 17.7505C16.0307 18.0832 16.5799 18.0832 16.9267 17.7505L17.7507 16.9259C18.0831 16.5931 18.0831 16.0434 17.7507 15.6962L13.5009 11.472C14.2813 10.3002 14.744 8.89693 14.744 7.37794C14.744 3.31284 11.4338 0 7.37201 0C3.31018 0 0 3.31284 0 7.37794C0 11.4429 3.29572 14.7559 7.37201 14.7559ZM7.37201 2.89331C9.84381 2.89331 11.853 4.90416 11.853 7.37794C11.853 9.85172 9.84381 11.8626 7.37201 11.8626C4.90022 11.8626 2.89099 9.85172 2.89099 7.37794C2.89099 4.90416 4.90022 2.89331 7.37201 2.89331Z"/>
                                    </svg>
                                </b-button>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="header__selectProperty_btn">
                    <b-button @click="openSearsearchBar__chckbxar(SearcBarState)" variant="transparent" class="header__lightBtn shadow-none">Подобрать недвижимость</b-button>             
                </div>                
                <div class="header__selectProperty_name">Резеденция вашей мечты</div>            
            </div>                  
        </div>
        <div class="position-absolute d-flex align-items-center header__statusConstruction">
            <div class="header__statusConstruction_txt">ЖК Фергана</div>
            <b-button variant="transparent" class="header__lightBtn_md shadow-none">Идут продажи</b-button>  
        </div>

        <div class="header__mouse">
            <b-button variant="transparent" class="p-0 m-0 shadow-none" @click="moveToBuildings">
                <img src="@/assets/images/svg/mouse.svg">
            </b-button>
        </div>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'

import vClickOutside from 'v-click-outside'

  export default {
    directives: {
      clickOutside: vClickOutside.directive
    },
    components: { 
        VueSlickCarousel,
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
            const $bestsellers = document.getElementById('bestsellers');
            $bestsellers.scrollIntoView({ 
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
            speed: 1400,
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