<template>
    <div>
        <Header />  
            <div class="dev container_1290">
                <b-breadcrumb :items="breadcrumbItems" variant="transparent" class="mt-5"></b-breadcrumb>
                <div class="dev__data d-flex justify-content-center align-items-start">
                    <div class="dev__left">
                        <div class="dev__bigLogo d-flex align-items-center justify-content-center rounded">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="dev__name main__title">Ferghana MCJ Stroy</h2>
                        <div class="dev__dataRating d-flex">
                            <div>
                                <div class="dev__rating main__text">Рейтинг 4,8</div>
                                <div class="dev__vote">1079 голосов</div>
                            </div>
                            <div class="dev__stars">
                                <img src="@/assets/images/svg/stars/4.svg" alt="star">
                            </div> 
                        </div>
                        <div class="d-flex">
                            <div class="dev__reviewsIcon">
                                <img src="@/assets/images/svg/card-icons/blackMessage.svg" alt="message">
                            </div>
                            <div class="dev__reviewsText main__text">
                                <span class="dev__reviewsNum main__text">25</span>
                                <span>Отзывов</span>
                            </div>
                        </div>
                        <h6 class="dev__dataName">Контактная информация</h6>
                        <div class="dev__dataText main__text">
                            <span class="greyText">Адрес:</span>
                            г. Фергана, ул. Алишера Навои, дом 7
                        </div>
                        <div class="dev__dataText main__text">
                            <span class="greyText">Сайт:</span>
                            www.fergana-mcj.uz
                        </div>
                            <a href="tel:+998999158568">
                                <div class="dev__phoneBtn rounded text-center">
                                    Позвонить
                                </div>
                            </a>
                    </div>
                </div>
                <div class="dev__about">
                    <h5 class="main__title text-center">О застройщике</h5>
                    <h6 class="discription__title">Квартиры в новостройках Ферганы</h6>
                    <span class="main__text">пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи! Пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!</span>
                </div>
                <div class="dev__statistics">
                    <div class="main__title text-center">Количество объектов</div>
                    <div class="d-flex flex-wrap advantages__cards">
                        <div class="advantages__card_sm">
                            <div class="advantages__card_count">2274</div> 
                            <div class="advantages__card_name">Кол.во построенных объектов</div> 
                        </div>
                        <div class="advantages__card_sm">
                            <div class="advantages__card_count">350</div> 
                            <div class="advantages__card_name">Кол.во строящихся объектов</div> 
                        </div>
                        <div class="advantages__card_sm">
                            <div class="advantages__card_count">7850</div> 
                            <div class="advantages__card_name">Кол.во квартир в продаже</div> 
                        </div>  
                    </div>
                </div>

                <div class="dev__wood text-center">
                    <h6 class="dev__woodTitle main__title">Объекты застройщика</h6>
                    <div class="dev__woodBody text-center">
                        <b-row class="dev__woodYear position-relative align-items-center justify-content-center" v-for="object in objects" :key="object.year">
                            <div class="dev__arrowYear position-absolute left-50">
                                <img src="@/assets/images/svg/arrayYear.svg"/>
                            </div>
                            <div class="dev__woodObjects item position-absolute top-50">
                                <nuxt-link to="/developers/developer/object" class="dev__objectItem text-decoration-none"  v-for="item in object.data" :key="item.id">
                                    <img :src="require(`@/assets/images/png/${item.image}`)">
                                    <div class="dev__woodDevNameBox">
                                        <div class="dev__woodDevName rounded maint__text">{{item.name}}</div>
                                    </div>
                                </nuxt-link>
                            </div>
                            <div class="dev__woodDate item">{{object.year}}</div>
                        </b-row>
                    </div>
                </div>

                <div class="reviews">
                    <div class="container_1290">
                        <div class="main__title text-center">Отзывы наших клиентов</div>
                        <div class="reviews__container d-flex justify-content-between">
                            <div class="reviews__column_lg d-flex flex-wrap">
                                <div class="reviews__message" v-for="i in 3" :key="i">
                                    <div class="message__title d-flex justify-content-between align-items-center">
                                        <div class="message__name">Сардор Ибрагимов</div>
                                        <div class="message__rating d-flex">
                                            <div class="message__rating_title">Оценка к компании</div> 
                                            <div class="message__rating_stars">
                                                <img src="@/assets/images/svg/stars/4.svg">
                                            </div> 
                                        </div>    
                                    </div>
                                    <div class="reviews__text">Пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи! Пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий.</div>
                                </div>
                                <b-button variant="transparent" class="main__button_seeMore shadow-none">
                                    Показать ещё
                                    <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6278 1.08106e-05C10.5951 -0.00294753 8.60667 0.601323 6.91163 1.73714C6.64846 1.91337 6.46523 2.18822 6.40224 2.50122C6.33925 2.81422 6.40167 3.13973 6.57576 3.40614C6.74985 3.67255 7.02135 3.85805 7.33054 3.92181C7.63973 3.98558 7.96128 3.92239 8.22445 3.74616C9.53026 2.87143 11.062 2.40622 12.6278 2.40878C17.035 2.40878 20.6205 6.03876 20.6205 10.5C20.6205 14.9613 17.035 18.5912 12.6278 18.5912C8.22054 18.5912 4.63498 14.9615 4.63498 10.5C4.63496 10.2244 4.64861 9.94904 4.67588 9.67485L5.23758 10.487C5.41856 10.7486 5.69481 10.9268 6.00555 10.9823C6.31629 11.0377 6.63608 10.966 6.89456 10.7828C7.15303 10.5996 7.32903 10.3199 7.38383 10.0053C7.43863 9.69076 7.36774 9.36704 7.18676 9.10538L5.11776 6.11403C5.02815 5.98447 4.9142 5.87404 4.78243 5.78906C4.65066 5.70407 4.50364 5.6462 4.34978 5.61873C4.19591 5.59126 4.0382 5.59475 3.88567 5.62898C3.73313 5.66322 3.58875 5.72753 3.46076 5.81825L0.505861 7.91283C0.247916 8.09626 0.0724249 8.37582 0.0179228 8.69012C-0.0365794 9.00443 0.0343631 9.32778 0.215172 9.58918C0.395981 9.85058 0.671876 10.0286 0.982273 10.0843C1.29267 10.1399 1.61219 10.0686 1.87068 9.88597L2.29492 9.58527C2.26919 9.88803 2.25526 10.1929 2.25526 10.5C2.25526 16.2897 6.90826 21 12.6276 21C18.3469 21 23 16.2897 23 10.5C23 4.71027 18.3471 1.08106e-05 12.6278 1.08106e-05Z"/>
                                    </svg>
                                </b-button>
                                <div class="reviews__form">
                                    <form>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div class="reviews__form_label">Как вас зовут?</div>
                                                <div class="reviews__form_input reviews__form_input_md">
                                                    <input 
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
                                                        type="email" 
                                                        name="email"
                                                        placeholder="Ваша электронная почта"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__form_input">
                                            <input 
                                                type="text" 
                                                name="surname"
                                                placeholder="Ваша фамилия (указывать не обязательно)"
                                            >
                                        </div>
                                        <div class="reviews__form_label">Оценка компании</div>
                                        <img src="@/assets/images/svg/stars/0.svg" style="margin-top: 14px;">
                                        <div class="reviews__form_label">Отзывы</div>
                                        <div class="reviews__form_textarea">
                                            <textarea 
                                                type="text" 
                                                name="text"
                                                placeholder="Текст вашего сообщения"
                                            ></textarea>
                                        </div>
                                        <div class="reviews__form_btn d-flex align-items-center">
                                            <b-button variant="transparent" class="main__btnSubmit shadow-none">Оставить отзыв</b-button>
                                            <div class="reviews__form_text">Оставляя отзыв вы даёте согласие на обработку персональных данных</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="reviews__rating">
                                <div class="reviews__block">
                                    <div class="reviews__text reviews__text_pb20">Рейтинг от Ferghana MCJ Stroy</div>
                                    <div class="reviews__count">4,8</div>
                                </div>
                                <div class="reviews__block reviews__block_w">
                                    <div class="reviews__text reviews__text_pb15">Рейтинг от посетителей</div>
                                    <div class="reviews__count">4.2</div>
                                    <div class="reviews__rating_stars">                                
                                        <div class="reviews__starBlock">
                                            <img src="@/assets/images/svg/stars/5.svg">
                                            <div class="progressBar">
                                                <b-progress variant="transparent" value="60" max="100" class="mb-3"></b-progress>
                                            </div>
                                        </div>
                                        <div class="reviews__starBlock">
                                            <img src="@/assets/images/svg/stars/4.svg">
                                            <div class="progressBar">
                                                <b-progress variant="transparent" value="35" max="100" class="mb-3"></b-progress>
                                            </div>
                                        </div>
                                        <div class="reviews__starBlock">
                                            <img src="@/assets/images/svg/stars/3.svg">
                                            <div class="progressBar">
                                                <b-progress variant="transparent" value="15" max="100" class="mb-3"></b-progress>
                                            </div>
                                        </div>
                                        <div class="reviews__starBlock">
                                            <img src="@/assets/images/svg/stars/2.svg">
                                            <div class="progressBar">
                                                <b-progress variant="transparent" value="30" max="100" class="mb-3"></b-progress>
                                            </div>
                                        </div>
                                        <div class="reviews__starBlock">
                                            <img src="@/assets/images/svg/stars/1.svg">
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
            </div>
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/main/header'
import Footer from '@/components/main/footer'

export default {
    data() {
        return {
            objects: [
                {
                    year: '2020',
                    data: [
                        {
                            id: 1,
                            name: 'ЖК Фергана',
                            image: 'minBuild.png'
                        },
                        {
                            id: 3,
                            name: 'Gold House',
                            image: 'minBuild.png'
                        },
                        {
                            id: 2,
                            name: 'Yerevan',
                            image: 'minBuild.png'
                        }
                    ]
                },
                {
                    year: '2019',
                    data: [
                        {
                            id: 1,
                            name: 'ЖК Фергана',
                            image: 'minBuild.png'
                        },
                        {
                            id: 3,
                            name: 'Gold House',
                            image: 'minBuild.png'
                        },
                        {
                            id: 2,
                            name: 'Yerevan',
                            image: 'minBuild.png'
                        }
                    ]
                }
            ],
            breadcrumbItems: [
                {
                    text: 'Главная',
                    href: '/'
                },
                {
                    text: 'Застройщики Ферганы',
                    href: '/developers/'
                },
                {
                    text: 'Ferghana MCJ Stroy',
                    active: true
                }
            ],
            data: {
                2018: ['жк Фергана', 'жк Фергана', 'жк Фергана'],
                2019: ['жк Фергана', 'жк Фергана', 'жк Фергана', 'жк Фергана'],
                2020: ['жк Фергана', 'жк Фергана'],
                2021: ['жк Фергана', 'жк Фергана'],
                2022: ['жк Фергана', 'жк Фергана'],
                2023: ['жк Фергана', 'жк Фергана'],
            }
        }
    }
}
</script>