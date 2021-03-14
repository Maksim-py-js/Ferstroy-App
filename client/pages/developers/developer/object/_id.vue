<template>
    <div v-if="this.objectData != ''">
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
                                <div><a href="tel:+712008822" class="header__phone text-decoration-none">(71) 200 88 22</a></div>
                                <div><a href="tel:+712008822" class="header__phone_text">Связаться с нами</a></div>                            
                            </div>
                        </div>
                    </b-navbar> 
                </div>     
                <div class="container_1290 position-relative">
                    <div class="header_object__selectProperty_title">Жилой комплекс</div>                 
                    <div class="header_object__selectProperty_name">{{this.objectData.residential_complex.name}}</div>                 
                    <div class="header_object__selectProperty_btn">
                        <b-button @click="moveToBuildings" variant="transparent" class="header_object__lightBtn shadow-none">Выбрать квартиру</b-button>             
                    </div>                             
                </div>                  
            </div>
        </div>
        <div class="object__card_orange">
            <div class="container_1290">
                <div class="object__card_title">Особености жилого комплекса</div>
                <div class="object__card_row d-flex">
                    <div class="object__card_column" v-for="item in objectData.features_appartments" :key="item.index">
                        <div class="object__card_count">{{item.name}}</div>
                        <div class="object__card_name">{{item.description}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="svg__object position-relative" id="appartments">
            
            <div :class="{active:objectDescription.is_open}" v-for="objectDescription in objectDescriptions" :key="objectDescription.id">
                <div class="svg__object_block" :class="objectDescription.class">
                    <div class="svg__object_title">{{ objectDescription.name }}</div>
                    <div class="svg__object_text">{{ objectDescription.text }}</div>
                </div>
            </div>
        </div>
        <div class="object__card_orange">
            <div class="container_1290">
                <div class="object__card_title">Особености квартир</div>
                <div class="object__card_row d-flex">
                    <div class="object__card_columnLg" v-for="item in objectData.features_residential_complex" :key="item.index">
                        <div class="object__card_count">{{item.name}}</div>
                        <div class="object__card_nameLg">{{item.description}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="object__card_90">
            <div class="container_1290">
                <div class="main__title">{{this.objectData.residential_complex.about_title}}</div>
                <div class="main__text object__card_text">
                    {{this.objectData.residential_complex.about_description}}
                </div>
            </div>
        </div>
        <div class="advantages advantages__md container_1290">
            <div class="main__title">{{this.objectData.residential_complex.about_description}}</div>
            <div class="d-flex flex-wrap advantages__cards">
                <div class="advantages__card_sm" 
                    v-for="item in objectData.residential_complex_advantages" 
                    :key="item.index" 
                    v-if="item.advantage.count != null"
                >
                    <div class="advantages__card_count">{{item.advantage.count}}</div>
                    <div class="advantages__card_name">{{item.advantage.title}}</div>
                </div>
            </div>
            <div class="d-flex flex-wrap advantages__cards" >
                <div class="advantages__card"
                    v-for="item in objectData.residential_complex_advantages" 
                    :key="item.index" 
                    v-if="item.advantage.count == null"
                >
                    <div class="advantages__card_image" 
                        v-for="i in item.advantages_icons"
                        :key="i.index"
                        v-if="i.id == item.advantages_icons.icon_id"
                    >
                        <img :src="i.name">
                    </div>
                    <div class="advantages__card_name">{{item.advantage.title}}</div>
                    <div class="advantages__card_description">{{item.advantage.text}}</div>
                </div>
            </div>
        </div>
        <div class="gallery">
            <div class="container_1290">
                <div class="main__title">Галерея</div>
                <div class="gallery__row d-flex">

                    <div class="gallery__column">
                        <div class="gallery__image gallery__image_md">
                            <img src="@/assets/images/png/gallery/1.png">
                            <div class="gallery__image_bg">
                                <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                            </div>
                        </div>
                        <div class="gallery__image gallery__image_md">
                            <img src="@/assets/images/png/gallery/2.png">
                            <div class="gallery__image_bg">
                                <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                            </div>
                        </div>
                    </div>
                    <div class="gallery__column">
                        <div class="gallery__image gallery__image_lg">
                            <img src="@/assets/images/png/gallery/3.png">
                            <div class="gallery__image_bg">
                                <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                            </div>
                        </div>
                    </div>
                    <div class="gallery__column">
                        <div class="gallery__image gallery__image_md">
                            <img src="@/assets/images/png/gallery/4.png">
                            <div class="gallery__image_bg">
                                <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                            </div>
                        </div>
                        <div class="gallery__image gallery__image_md">
                            <img src="@/assets/images/png/gallery/5.png">
                            <div class="gallery__image_bg">
                                <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="constructionProgress">
            <div class="container_1290">
                <div class="main__title">Ход строительства</div>
                <div class="constructionProgress__tabs">
                    <b-card no-body class="position-relative">
                        <b-button variant="transparent" class="shadow-none constructionProgress__btn constructionProgress__btn_prev"></b-button>
                        <b-button variant="transparent" class="shadow-none constructionProgress__btn constructionProgress__btn_next"></b-button>

                        <b-tabs pills>
                            <b-tab title="2020 05 12" active>
                                <div class="gallery">
                                    <div class="container_1290">
                                        <div class="gallery__row d-flex">
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/1.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/2.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/3.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/4.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                            <b-tab title="2021 05 1" active>
                                <div class="gallery">
                                    <div class="container_1290">
                                        <div class="gallery__row d-flex">
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/5.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/1.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/2.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/3.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                            <b-tab title="2021 05 2" active>
                                <div class="gallery">
                                    <div class="container_1290">
                                        <div class="gallery__row d-flex">
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/4.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/5.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/1.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/2.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                            <b-tab title="2021 05 3" active>
                                <div class="gallery">
                                    <div class="container_1290">
                                        <div class="gallery__row d-flex">
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/3.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/4.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/5.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/1.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                            <b-tab title="2021 05 4" active>
                                <div class="gallery">
                                    <div class="container_1290">
                                        <div class="gallery__row d-flex">
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/2.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/3.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/4.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                            <div class="gallery__image gallery__image_sm">
                                                <img src="@/assets/images/png/gallery/5.png">
                                                <div class="gallery__image_bg">
                                                    <b-button variant="transparent" class="gallery__image_btn shadow-none"></b-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                        </b-tabs>
                    </b-card>
                </div>
            </div>
        </div>
        <div class="reviews">
            <div class="container_1290">
                <div class="main__title text-center">Отзывы наших клиентов</div>
                <div class="reviews__container d-flex justify-content-between">
                    <div class="reviews__column_lg d-flex flex-wrap">
                        <div v-if="this.objectData.comments.length >= 1">
                            <div class="reviews__message" v-for="i in objectData.comments" :key="i.index">
                                <div class="message__title d-flex justify-content-between align-items-center">
                                    <div class="message__name">{{i.name}} {{i.surname}}</div>
                                    <div class="message__rating d-flex">
                                        <div class="message__rating_title">Оценка к компании</div> 
                                        <div class="message__rating_stars">
                                            <get-star-rating :value="`${i.rating}`"></get-star-rating>
                                        </div> 
                                    </div>    
                                </div>
                                <div class="reviews__text">{{i.text}}</div>
                            </div>
                            <b-button variant="transparent" class="main__button_seeMore shadow-none">
                                Показать ещё
                                <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6278 1.08106e-05C10.5951 -0.00294753 8.60667 0.601323 6.91163 1.73714C6.64846 1.91337 6.46523 2.18822 6.40224 2.50122C6.33925 2.81422 6.40167 3.13973 6.57576 3.40614C6.74985 3.67255 7.02135 3.85805 7.33054 3.92181C7.63973 3.98558 7.96128 3.92239 8.22445 3.74616C9.53026 2.87143 11.062 2.40622 12.6278 2.40878C17.035 2.40878 20.6205 6.03876 20.6205 10.5C20.6205 14.9613 17.035 18.5912 12.6278 18.5912C8.22054 18.5912 4.63498 14.9615 4.63498 10.5C4.63496 10.2244 4.64861 9.94904 4.67588 9.67485L5.23758 10.487C5.41856 10.7486 5.69481 10.9268 6.00555 10.9823C6.31629 11.0377 6.63608 10.966 6.89456 10.7828C7.15303 10.5996 7.32903 10.3199 7.38383 10.0053C7.43863 9.69076 7.36774 9.36704 7.18676 9.10538L5.11776 6.11403C5.02815 5.98447 4.9142 5.87404 4.78243 5.78906C4.65066 5.70407 4.50364 5.6462 4.34978 5.61873C4.19591 5.59126 4.0382 5.59475 3.88567 5.62898C3.73313 5.66322 3.58875 5.72753 3.46076 5.81825L0.505861 7.91283C0.247916 8.09626 0.0724249 8.37582 0.0179228 8.69012C-0.0365794 9.00443 0.0343631 9.32778 0.215172 9.58918C0.395981 9.85058 0.671876 10.0286 0.982273 10.0843C1.29267 10.1399 1.61219 10.0686 1.87068 9.88597L2.29492 9.58527C2.26919 9.88803 2.25526 10.1929 2.25526 10.5C2.25526 16.2897 6.90826 21 12.6276 21C18.3469 21 23 16.2897 23 10.5C23 4.71027 18.3471 1.08106e-05 12.6278 1.08106e-05Z"/>
                                </svg>
                            </b-button>
                        </div>
                        <div v-else>
                            <div class="main__title text-center">Отзывов пока нет, но вы можете исправить это:)</div>
                        </div>
                        <div class="reviews__form">
                            <form>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <div class="reviews__form_label">Как вас зовут?</div>
                                        <div class="reviews__form_input reviews__form_input_md">
                                            <input 
                                                v-model="comment.name"
                                                type="text" 
                                                name="name"
                                                placeholder="Ваше имя"
                                            >
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="reviews__form_label">Email</div>
                                        <div class="reviews__form_input reviews__form_input_md">
                                            <input 
                                                v-model="comment.email"
                                                type="email" 
                                                name="email"
                                                placeholder="Ваша электронная почта"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews__form_input">
                                    <input 
                                        v-model="comment.surname"
                                        type="text" 
                                        name="surname"
                                        placeholder="Ваша фамилия (указывать не обязательно)"
                                    >
                                </div>
                                <div class="reviews__form_label">Оценка компании</div>
                                <set-star-rating @rating='getRating'></set-star-rating>
                                <div class="reviews__form_label">Отзывы</div>
                                <div class="reviews__form_textarea">
                                    <textarea 
                                        v-model="comment.text"
                                        type="text" 
                                        name="text"
                                        placeholder="Текст вашего сообщения"
                                    ></textarea>
                                </div>
                                <div class="reviews__form_btn d-flex align-items-center">
                                    <b-button variant="transparent" class="main__btnSubmit shadow-none" @click="postComment()">Оставить отзыв</b-button>
                                    <div class="reviews__form_text">Оставляя отзыв вы даёте согласие на обработку персональных данных</div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="reviews__rating">
                        <div class="reviews__block">
                            <div class="reviews__text reviews__text_pb20">Рейтинг от {{this.objectData.residential_complex.name}}</div>
                            <div class="reviews__count">{{this.objectData.residential_complex.rating}}</div>
                        </div>
                        <div class="reviews__block reviews__block_w">
                            <div class="reviews__text reviews__text_pb15">Рейтинг от посетителей</div>
                            <div class="reviews__count">{{this.objectData.residential_complex.rating}}</div>
                            <div class="reviews__rating_stars">                                
                                <div class="reviews__starBlock">
                                    <get-star-rating :value="5"></get-star-rating>
                                    <div class="progressBar">
                                        <b-progress variant="transparent" value="60" max="100" class="mb-3"></b-progress>
                                    </div>
                                </div>
                                <div class="reviews__starBlock">
                                    <get-star-rating :value="4"></get-star-rating>
                                    <div class="progressBar">
                                        <b-progress variant="transparent" value="35" max="100" class="mb-3"></b-progress>
                                    </div>
                                </div>
                                <div class="reviews__starBlock">
                                    <get-star-rating :value="3"></get-star-rating>
                                    <div class="progressBar">
                                        <b-progress variant="transparent" value="15" max="100" class="mb-3"></b-progress>
                                    </div>
                                </div>
                                <div class="reviews__starBlock">
                                    <get-star-rating :value="2"></get-star-rating>
                                    <div class="progressBar">
                                        <b-progress variant="transparent" value="30" max="100" class="mb-3"></b-progress>
                                    </div>
                                </div>
                                <div class="reviews__starBlock">
                                    <get-star-rating :value="1"></get-star-rating>
                                    <div class="progressBar">
                                        <b-progress variant="transparent" value="12" max="100" class="mb-3"></b-progress>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map">
            <no-ssr>
                <yandex-map
                    :coords="coords"
                    :zoom="10"
                    style="height: 860px"
                >
                    <ymap-marker
                        marker-id="123"
                        :coords="coords"
                        :icon="markerIcon"
                        :balloon-template="balloonTemplate"
                        :options="balloonOptions"
                        class="mapMarker"
                    />
                </yandex-map>
            </no-ssr>
            <div class="container_1290">
                <div class="map__container">
                    <div class="map__container_title">Мы на карте</div>
                    <div class="d-flex align-items-center map__block">
                        <div class="map__container_icon"><img src="@/assets/images/svg/map-icons/1.svg"></div>
                        <div class="map__container_name">{{this.objectData.residential_complex.address}}</div>
                    </div>
                    <div class="d-flex align-items-center map__block">
                        <div class="map__container_icon"><img src="@/assets/images/svg/map-icons/2.svg"></div>
                        <div class="map__container_name"><a href="tell:+998909000000">{{this.objectData.residential_complex.number}}</a></div>
                    </div>
                    <div class="d-flex align-items-center map__block">
                        <div class="map__container_icon"><img src="@/assets/images/svg/map-icons/3.svg"></div>
                        <div class="map__container_name">E-mail: {{this.objectData.residential_complex.email}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'
import SetStarRating from '@/components/setRatingValStars'
import GetStarRating from '@/components/getRatingValStars'

export default {
    layout: 'object',
    components: { 
        VSelectize
    },
    components: { 
        SetStarRating,
        GetStarRating
    },
    async asyncData({ params }) {
        const id = params.id   
        return { id }    
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
            ],


            coords: [40.388404, 71.780839],
            markerImage: '',
            markerIcon: {
                layout: 'default#imageWithContent',
                imageHref: ``,
                imageSize: [89, 113],
                imageOffset: [-40, -110],
                content: '',
                contentOffset: [0, 0],
                contentLayout: ''
            },
            balloonOptions: {
                hideIconOnBalloonOpen: false,
                balloonOffset: [3, -104]
            },
            showMap: false,
            object: [
                {
                    id: 1,
                    description: 0,
                    d: "M433.5 668L367.5 635L317.5 448L329.5 437.5L317.5 429.5L342.5 411L340.5 406L352 397.5L356.5 400L386 373.5L371 366.5L404 341.5L408.5 343L449.5 312.5L445.5 309L475.5 286L492 293L504 285L501 280.5L509.5 274H517.5L537.5 257L551.5 263L564.5 252.5L600 269L603 267L610.5 270.5V265L615 262L636.5 272L658.5 435L650.5 443.5L653.5 467.5L644.5 475.5L646.5 478L631 489.5L603.5 474.5L579 497L574.5 494.5L558.5 508L561.5 511L552 519L555.5 521L490 579.5L487 577L477 585L472.5 583L460 592L463.5 596L457 603L465.5 644L433.5 668Z"
                },
                {
                    id: 2,
                    description: 1,
                    d: "M712.5 819L919.5 587L916.5 584L914 393L900.5 386L897.5 388.5V393L851.5 376.5L825.5 402L810.5 396.5L782.5 424V443L707 515L692 509L659 540L662 558L624 596.5L627.5 627L624 630.5L647.5 784L712.5 819Z"
                },
                {
                    id: 3,
                    description: 2,
                    d: "M972 958L952.5 947L948.5 756.5L967.5 733.5L973.5 736L974.5 739L983 729.5L1019 747.5V743L1016 740.5L1046 704L1069 713.5L1080 700L1076 696.5L1085 685L1080 682L1091.5 669L1096 671L1101.5 664.5L1104.5 656.5L1091.5 649.5L1118 616.5L1131 620.5L1136 614.5V600.5V584.5V577V569.5V560.5V550.5L1140.5 544L1142.5 536L1150.5 525.5L1152 510.5L1167.5 493.5L1194 505.5V516.5L1208 522V525.5L1218.5 529.5L1221 527L1238 534.5V538.5L1253 545.5L1244 558L1261 565.5L1237.5 748.5L1242 751L1226 773L1228 778.5L1217.5 793L1213.5 791.5L1196.5 815L1199 818L1185.5 837L1182.5 835L1173 848.5L1175 853L1165 866L1162.5 864.5L1137.5 897.5L1138.5 904.5L1128.5 917.5H1124L1105.5 944.5L1110.5 949.5L1099.5 963.5L1090.5 965L1071.5 991.5L1053 983L1040 997L1025 988.5L1020.5 991.5L968 962.5L972 958Z"
                },
                {
                    id: 4,
                    description: 3,
                    d: "M749 362.5C715 360.5 699.167 339 695.5 328.5C688.3 299.7 679.5 188.5 679.5 139.5L683.5 135V121L708 101.5L713.5 103L744.5 78.5L741 76L765 58.5L797 68L845 38L860.5 43L864.5 40.5L878 43V33.5L906.5 43V234.5L900.5 239.5V245.5L889.5 255.5L874 248.5L845 273.5H839L825 286.5V291.5L782 328.5L783.5 336L749 362.5Z"
                },
                {
                    id: 5,
                    description: 4,
                    d: "M1020.5 475L1012 483L924.5 449V434.5L918.5 430.5L916 228.5L918.5 225.5L915 222L940 197V186.5L948 180.5L963.5 187.5V194L973 199.5L994.5 181L1033 195.5L1025.5 201L1026.5 210.5L1039.5 217L1038.5 222.5L1050.5 228.5L1051.5 220L1067 228.5V430.5L1059 439V450L1027 478L1020.5 475Z"
                },
                {
                    id: 6,
                    description: 5,
                    d: "M1270 589L1260.5 586V565.5L1252 560.5L1253 545.5L1238.5 538L1237 534L1221 527L1218 528.5L1210 524.5L1233 348L1228.5 345L1241.5 331L1247 332.5L1256.5 322L1262 315.5L1261 306L1283.5 280.5L1295 284.5L1303.5 276.5L1305 261L1318.5 246H1327.5L1329 232.5L1338 224L1345.5 226L1349.5 222L1350.5 207.5L1358 199.5L1391.5 211L1390.5 222L1405 230L1401.5 234L1419.5 240.5L1413.5 246L1419.5 250L1387.5 431L1379.5 447L1368 461L1370.5 462.5L1361 475H1358L1341.5 498.5L1344.5 502L1334.5 513.5H1330.5L1321 524.5L1322.5 528.5L1305.5 550L1303 549L1295.5 558L1297.5 561.5L1290 569.5L1291.5 572L1285.5 579.5L1281.5 577.5L1270 589Z"
                }
            ],
            objectDescriptions: [
                {
                    id: 1,
                    is_open: false,
                    class: "descr1",
                    name: "1 корпус",
                    text: "Первый корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                },
                {
                    id: 2,
                    is_open: false,
                    class: "descr2",
                    name: "2 корпус",
                    text: "Второй корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                },
                {
                    id: 3,
                    is_open: false,
                    class: "descr3",
                    name: "3 корпус",
                    text: "Третий корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                },
                {
                    id: 4,
                    is_open: false,
                    class: "descr4",
                    name: "4 корпус",
                    text: "Четвертый корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                },
                {
                    id: 5,
                    is_open: false,
                    class: "descr5",
                    name: "5 корпус",
                    text: "Пятый корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                },
                {
                    id: 6,
                    is_open: false,
                    class: "descr6",
                    name: "6 корпус",
                    text: "Шестой корпус ЖК Фергана находится в южной части улицы Алишева Навои 8 этажный дом с отличным видом"
                }
            ],
            comment: {
                name: null,
                surname: null,
                email: null,
                rating: null,
                text: null,
                residential_complex_id: null,
                developer_id: null
            },
            objectData: ''
        }
    },
    mounted() {
        this.getObject();
        const pathHouseTwo = document.getElementById('pathHouseTwo');
        const blockHouseTwo = document.getElementById('blockHouseTwo');
        // pathHouseTwo.onmouseover = function(){
        //     blockHouseTwo.classList.add("active")
        // };
        // pathHouseTwo.onmouseout = function(){
        //     blockHouseTwo.classList.remove("active")
        // };
        this.showMap = true;

    },
    computed: {
        balloonTemplate() {
            return `
                <a href="/developers/developer/object" class="buildCard">
                    <h6 class="buildName">ЖК Фергана</h6>
                    <div class="buildImage">
                        <img src="https://mirabad.uz/upload/kelnik.adminpage/c0c/c0cf81c2a22ec8ec0c77335fe14b9533.jpg"/>
                    </div>
                    <span class="buildText">880 квартир До 18 Этажей Квартиры от 52 м2 Начало строительства 2018 год</span>
                </a>
            `
        },
        dataObject() {
            // сортируем массив застройщиков по id
            this.objects = this.OBJECTS;
            console.log(this.objects);
            let arr = this.objects.sort((a, b) => {return a.residential_complex_value.id - b.residential_complex_value.id});
            // ищем данные нужного застройщика по id
            return this.search(arr, this.id);
        },
    },
    methods: {
        openSearsearchBar__chckbxar(SearcBarState) {
            this.SearcBarState = true;
        },       
        closeSearsearchBar__chckbxar(SearcBarState) {
            this.SearcBarState = false;
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
        },




        mouseenterObjectdescription(descriptionNum) {
            this.objectDescriptions[descriptionNum].is_open = true;
        },
        mouseleaveObjectdescription(descriptionNum) {
            this.objectDescriptions[descriptionNum].is_open = false;
        },
        getRating(value) {
            this.comment.rating = value.rating
        },
        async getObject() {
            axios
                .get(`http://213.230.96.125/api/residential_complexes/${this.id}`)
                .then(response => {
                    this.objectData = response.data[0];
                })
                .then(() => {
                    this.getMarker();
                });
        },
        async postComment() {
            const formData = new FormData();

            formData.append("name", this.comment.name);
            formData.append("surname", this.comment.surname);
            formData.append("email", this.comment.email);
            formData.append("rating", this.comment.rating);
            formData.append("text", this.comment.text);
            formData.append("residential_complex_id", this.id);
            formData.append("developer_id", this.comment.developer_id);

            this.$axios.$post('/api/comments', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                if (response.created_at) {
                    this.comment.name = '';
                    this.comment.surname = '';
                    this.comment.address = '';
                    this.comment.email = '';
                    this.comment.rating = '';
                    this.comment.text = '';

                    this.getObject();
                }
            })
        },
        async getMarker() {
            let arr = this.objectData.map_marker;
            arr.forEach(item => {
                this.coords = [item.markerX, item.markerY];
                this.markerImage = item.image;
                console.log(this.coords);
            })

            this.markerIcon.contentLayout = `
                <div class="marksItem">
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
                        <img src="${this.markerImage}">
                    </div>
                </div>
            `

        },
        // search
        search(list, item) {
            let low = 0,
                high = list.length - 1,
                mid,
                guess;

            while(high >= low) {
                mid = Math.floor((high + low) / 2);
                guess = list[mid];
                if(guess.residential_complex_value.id == item) {
                    return guess;
                } else if (guess.residential_complex_value.id > item) {
                    high = mid - 1;
                } else {
                    low = mid + 1;
                }
            }
            return false;
        }
    }
}
</script>
