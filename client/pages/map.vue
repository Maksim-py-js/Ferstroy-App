<template>
    <div class="map-body">  
        <div class="position-relative">
            <yandex-map 
                :map-was-initialized="ymapInitialized()"
                :coords="coords" 
                :zoom="14" 
                :controls="['zoomControl']"
                ymap-class="mainYmap"
                >
                <ymap-marker 
                    v-for="complex in getMarkers"
                    :key="complex.index"

                    marker-id="123" 
                    :coords="[complex.map_marker[0].markerX, complex.map_marker[0].markerY]"
                    :icon="markerIcon(complex.map_marker[0].image)"
                    :options="balloonOptions"
                    class="mapMarker"

                    @mouseenter="markerMouseEnter()"  
                    @mouseleave="markerMouseLeave()"
                >
                    <nuxt-link :to="`/developers/developer/object/${complex.residential_complex_value.id}`" class="buildCard" slot="balloon">
                        <h6 class="buildName">{{complex.residential_complex_value.name}}</h6>
                        <div class="buildImage">
                            <img :src="`${complex.map_marker[0].image}`"/>
                        </div>
                        <span class="buildText">880 квартир До 18 Этажей Квартиры от 52 м2 Начало строительства 2018 год</span>
                    </nuxt-link>
                </ymap-marker>
            </yandex-map>
            <div class="position-absolute h-99 bg-white filterBox">
                <div class="mb-2">
                    <div class="cityBtn">Фергана и Обл</div>
                </div>
                <div class="filter">
                    <div class="filterName">Цена</div>
                    <div class="justify-content-between inputBox">
                        <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                            <div class="main__text filter__inpputText">от {{sale[0]}} млрд сум</div>
                            <div class="line">-</div>
                            <div class="main__text filter__inpputText text-right">до {{sale[1]}} млрд сум</div>
                        </b-input-group>
                    </div>
                    <no-ssr>
                        <div class="filter__rangeSlider">
                            <vue-range-slider v-model="sale" :dotSize="30" :height="10" :min="0" :max="300"></vue-range-slider>
                        </div>
                    </no-ssr>
                </div>
                <div class="filter">
                    <div class="filterName">Срок сдачи</div>
                    <div class="justify-content-between inputBox">
                        <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                            <div class="main__text filter__inpputText">{{deadline[0] == map_deadlineRangeMinValue ? 'Сданы' : deadline[0]}}</div>
                            <div class="line">-</div>
                            <div class="main__text filter__inpputText text-right">по {{deadline[1]}}</div>
                        </b-input-group>
                    </div>
                    <no-ssr>
                        <div class="filter__rangeSlider">
                            <vue-range-slider v-model="deadline" :dotSize="30" :height="10" :min="2021" :max="2024"></vue-range-slider>
                        </div>
                    </no-ssr>
                </div>
                
                <div class="filter">
                    <b-form-group v-slot="{ ariaDescribedby }">
                        <b-form-radio-group
                            id="btn-radios-1"
                            v-model="selected"
                            :options="options"
                            :aria-describedby="ariaDescribedby"
                            name="radios-btn-default"
                            buttons
                        ></b-form-radio-group>
                    </b-form-group>
                </div>
                <div class="filter">
                    <div class="filterName">Площадь</div>
                    <div class="justify-content-between inputBox">
                        <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                            <div class="main__text filter__inpputText">от {{square[0]}}</div>
                            <div class="line">-</div>
                            <div class="main__text filter__inpputText text-right">до {{square[1]}}</div>
                        </b-input-group>
                    </div>
                    <no-ssr>
                        <div class="filter__rangeSlider">
                            <vue-range-slider v-model="square" :dotSize="30" :height="10" :min="20" :max="200"></vue-range-slider>
                        </div>
                    </no-ssr>
                </div>
                <div class="filter" @click="filterMarkers()">
                    <div class="filterName">Застройщики</div>
                    <v-selectize 
                        placeholder="Выберите застройщика"
                        v-model="selected_developer" 
                        :options="developers_name"
                        class="searchResult__leftRow_selectize select-260"
                        style="margin: 0;"
                    />
                </div>
                <div class="filter houseFilter">
                    <b-form-group v-slot="{ ariaDescribedby }">
                        <b-form-radio-group
                            id="btn-radios-2"
                            v-model="selected2"
                            :options="options2"
                            :aria-describedby="ariaDescribedby"
                            name="radios-btn-default"
                            buttons
                        ></b-form-radio-group>
                    </b-form-group>
                </div>
            </div>
        </div>
        <div class="container_1290">
            <b-breadcrumb :items="breadcrumbItems" variant="transparent" class="mt-5 mb-4"></b-breadcrumb>
            <h3 class="main__title">Карта Новостроек или как найти идеальное жильё в Фергане</h3>
            <b-row>
                <b-col>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">
                        пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                    </span>
                    <div class="map">
                        <div class="position-absolute h-100 bg-white p-3 miniFilter">
                            <div class="mb-2">
                                <div class="cityBtn">Фергана и Обл</div>
                            </div>
                            <div class="filter">
                                <div class="filterName">Цена</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">от {{sale[0]}} млрд</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">до {{sale[1]}} млрд</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="sale" :dotSize="30" :height="10" :min="0" :max="300"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                            <div class="filter">
                                <div class="filterName">Срок сдачи</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">{{deadline[0] == map_deadlineRangeMinValue ? 'Сданы' : deadline[0]}}</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">по {{deadline[1]}}</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="deadline" :dotSize="30" :height="10" :min="2021" :max="2024"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                        </div>
                    </div>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">
                        пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                    </span>
                    <div class="map">
                        
                        <div class="position-absolute h-100 bg-white p-3 miniFilter">
                            <div class="mb-2">
                                <div class="cityBtn">Фергана и Обл</div>
                            </div>
                            <div class="filter">
                                <div class="filterName">Цена</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">от {{sale[0]}} млрд</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">до {{sale[1]}} млрд</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="sale" :dotSize="30" :height="10" :min="0" :max="300"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                            <div class="filter">
                                <div class="filterName">Срок сдачи</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">{{deadline[0] == map_deadlineRangeMinValue ? 'Сданы' : deadline[0]}}</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">по {{deadline[1]}}</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="deadline" :dotSize="30" :height="10" :min="2021" :max="2024"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                        </div>
                    </div>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">
                        пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                    </span>
                </b-col>
                <b-col>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">
                        пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                    </span>
                    <div class="map">
                        
                        <div class="position-absolute h-100 bg-white p-3 miniFilter">
                            <div class="mb-2">
                                <div class="cityBtn">Фергана и Обл</div>
                            </div>
                            <div class="filter">
                                <div class="filterName">Цена</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">от {{sale[0]}} млрд</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">до {{sale[1]}} млрд</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="sale" :dotSize="30" :height="10" :min="0" :max="300"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                            <div class="filter">
                                <div class="filterName">Срок сдачи</div>
                                <div class="justify-content-between inputBox">
                                    <b-input-group class="d-flex shadow-none justify-content-between align-items-center">
                                        <div class="main__text filter__inpputText" style="width: 105px">{{deadline[0] == map_deadlineRangeMinValue ? 'Сданы' : deadline[0]}}</div>
                                        <div class="line">-</div>
                                        <div class="main__text filter__inpputText text-right" style="width: 105px">по {{deadline[1]}}</div>
                                    </b-input-group>
                                </div>
                                <no-ssr>
                                    <div class="filter__rangeSlider">
                                        <vue-range-slider v-model="deadline" :dotSize="30" :height="10" :min="2021" :max="2024"></vue-range-slider>
                                    </div>
                                </no-ssr>
                            </div>
                        </div>
                    </div>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">
                        пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                        <br/>
                        <br/>
                        Квартиры в новостройках Ферганы пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!
                    </span>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
    import 'selectize/dist/css/selectize.css'
    import 'vue-range-component/dist/vue-range-slider.css'
    import VSelectize from '@isneezy/vue-selectize'
    import VueRangeSlider from 'vue-range-component'
    import {mapActions, mapGetters} from 'vuex'
    import { loadYmap } from 'vue-yandex-maps'
    export default { 
        layout: 'main',
        components: {
            VSelectize,
            VueRangeSlider
        },
        data() {
            return {
                breadcrumbItems: [
                    {
                        text: 'Главная',
                        href: '/'
                    },
                    {
                        text: 'Карта новостроек',
                        active: true
                    }
                ],
                map_deadlineRangeMinValue: '2021',
                map_deadlineRangeMaxValue: '2024',
                map_deadlineRangeValue: 'Сдана',
                map_priceRangeValue: '200',
                map_selected_roominessOptions: null,
                map_selected_deadlineOptions: null,
                map_roominessOptions: [
                    { value: null, text: 'Выбрать' },
                    { value: '1', text: '1' },
                    { value: '2', text: '2' },
                    { value: '3', text: '3' },
                    { value: '4', text: '4' },
                    { value: '5', text: '5+' },
                ],
                map_deadlineOptions: [
                    { value: null, text: 'Выбрать' },
                    { value: '1', text: '1 месяц' },
                    { value: '2', text: '2 месяца' },
                    { value: '3', text: '3 месяца' },
                    { value: '4', text: '4 месяца' },
                    { value: '5', text: '5+ месяцев' },
                ],
                selected: 'radio1',
                options: [
                    { text: 'Студия', value: 'radio1' },
                    { text: '1', value: 'radio2' },
                    { text: '2', value: 'radio3' },
                    { text: '3', value: 'radio4' },
                    { text: '4', value: 'radio5' }
                ],
                selected2: 'radio21',
                options2: [
                    { text: 'Квартиры', value: 'radio21' },
                    { text: 'Апартаменты', value: 'radio22' },
                    { text: 'Таунхаусы', value: 'radio23' },
                ],
                developers_name: [
                    'все'
                ],
                selected_developer: null,
                selected_finishing: null,
                sale: [0, 300],
                deadline: [2021, 2024],
                square: [20, 200],
                coords: [40.388404, 71.780839],
                markers: [
                    [40.381318, 71.804794],
                    [40.377401, 71.786434]          
                ],
                balloonOptions: {
                    hideIconOnBalloonOpen: false,
                    balloonOffset: [3, -104]
                },
                showMap: false,
                searchMarker: '',
                getMarkers: [],
                markers: []
            }
        },
        mounted() { 
            this.GET_RESIDENTIAL_COMPLEXES_FROM_API(),
            this.GET_DEVELOPERS_FROM_API()
                .then(() => {
                    let arr = [];
                    this.RESIDENTIAL_COMPLEXES.forEach(complex => {
                        arr.push(complex);
                    });
                    this.getMarkers = arr;
                    console.log(this.getMarkers);
                })
                .then(() => {
                    this.getDevelopersName()
                }),
            this.showMap = true
            // this.getMarkerTemplate()
        },
        computed: {
            ...mapGetters('dataBase/residential_complexes', [
                'RESIDENTIAL_COMPLEXES'
            ]),
            ...mapGetters('dataBase/developers', [
                'DEVELOPERS'
            ]),
            filterDevelopers() {
                return this.DEVELOPERS.filter(developer => {
                    return developer.developer_value.company_name.indexOf(this.selected_developer) !== -1
                })
            }
        },
        methods: {
            ...mapActions('dataBase/residential_complexes', [
                'GET_RESIDENTIAL_COMPLEXES_FROM_API'
            ]),
            ...mapActions('dataBase/developers', [
                'GET_DEVELOPERS_FROM_API'
            ]),
            filterMarkers() {
                if(this.selected_developer == 'все') {
                    let arr = [];
                    this.RESIDENTIAL_COMPLEXES.forEach(complex => {
                        arr.push(complex);
                    });
                    this.getMarkers = arr;
                } else {
                    this.filterDevelopers.forEach(item => {
                        this.getMarkers = this.RESIDENTIAL_COMPLEXES.filter(complex => {
                            return complex.residential_complex_value.developer_id.toString().indexOf(item.developer_value.id.toString()) !== -1
                        })
                    })
                }
            },
            filterByFloors() {
                this.filterMarkers();
            },
            getDevelopersName() {
                this.DEVELOPERS.forEach(item => {
                    this.developers_name.push(item.developer_value.company_name);
                });
            },
            // getFilterMarkers() {
            //     console.log(this.filterDevelopers);
            //     let arr = [];
            //     this.filterDevelopers.forEach(item => {
            //         arr = item.
            //     });
            //     return
            // },
            markerIcon(image) {
                let obj = {
                    layout: 'default#imageWithContent',
                    imageHref: ``,
                    imageSize: [89, 113],
                    imageOffset: [-40, -110],
                    content: '',
                    contentOffset: [0, 0],
                    contentLayout: `<div class="marksItem">
                        <svg width="89" height="114" viewBox="0 0 89 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M66.1622 67.2483C50.6719 59.392 34.1273 60.7714 29.2829 70.3232C27.3658 74.1032 27.4804 78.6769 29.6201 83.5506L41.6343 111.317C41.665 111.385 41.7361 111.441 41.7748 111.508C42.4647 112.719 44.049 113.306 45.0962 113.073C53.5679 111.187 69.1827 107.558 75.1525 106.23C75.1525 106.23 75.1553 106.228 75.1576 106.227L75.1944 106.219C80.08 105 83.6326 102.442 85.4696 98.8198C90.314 89.2681 81.6524 75.1046 66.1622 67.2483Z" fill="url(#paint0_linear)"/>
                            <path d="M44.5 0C19.9634 0 0 19.3071 0 43.0371C0 52.428 3.06708 61.3511 8.87718 68.8373L41.757 111.665C41.8391 111.769 41.9646 111.808 42.0559 111.901C43.699 113.603 46.0701 113.175 47.2407 111.665C56.709 99.4468 74.064 76.6281 80.7367 68.0207C80.7367 68.0207 80.739 68.0141 80.7413 68.0097L80.7823 67.9567C86.1588 60.6514 89 52.0352 89 43.0371C89 19.3071 69.0366 0 44.5 0ZM44.5 66.2551C31.2892 66.2551 20.4928 55.8136 20.4928 43.0371C20.4928 30.2606 31.2892 19.8191 44.5 19.8191C57.7108 19.8191 68.5072 30.2606 68.5072 43.0371C68.5072 55.8136 57.7108 66.2551 44.5 66.2551Z" fill="#77C85B"/>
                            <defs>
                                <linearGradient id="paint0_linear" x1="66.1622" y1="67.2483" x2="43.0934" y2="112.733" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.34375" stop-opacity="0"/>
                                    <stop offset="1" stop-opacity="0.28"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="markImage">
                            <img src="${image}">
                        </div>
                    </div>`
                };
                return obj
            },
            // getMarkerTemplate() {
            //     this.RESIDENTIAL_COMPLEXES.forEach(item => {
            //         item.map_marker.forEach(marker => {
            //             console.log(marker);
            //             this.getMarkers.push(marker);
            //         })
            //     });
            //     console.log(this.getMarkers);
            //     this.markerIcon.contentLayout = ;
            // },
            ymapInitialized() {
                console.log('ymaps');
            },
            markerMouseEnter() {
                this.markerIcon.markerColor = '#FF9800';
            },
            markerMouseLeave() {
                this.markerIcon.markerColor = '#77C85B';
            }
            // markerEnter() {
            //     this.markerIcon.markerColor = '#FF9800';
            //     console.log(this.markerIcon.markerColor);
            // }
        }
    }
</script>


<style>
    .mainYmap {
        height: 860px;
    }
</style>