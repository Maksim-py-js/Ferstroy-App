<template>
    <div>
        <Header />  
            <div class="content container_1290">
                <b-breadcrumb :items="breadcrumbItems" variant="transparent" class="mt-5"></b-breadcrumb>
                <div class="content__name d-flex justify-content-between align-items-center searchResult__header">                
                    <div class="main__title">Застройщики Ферганы</div>            
                    <div>
                        <v-selectize 
                            placeholder="Сортировать"
                            v-model="selected_sortingByPrice" 
                            :options="sortingByPrice"
                            class="searchResult__header_selectize select-300"
                        />
                    </div>
                </div>
                <div class="devCards d-flex flex-wrap justify-content-center">
                    
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>
                    <nuxt-link to="/developers/developer" class="devCards__card text-decoration-none text-center rounded">
                        <div class="card__rating d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackStar.svg"></div>
                                <div class="card__rating_text">4.5</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/blackMessage.svg"></div>
                                <div class="card__rating_text">25</div>
                            </div>
                        </div>
                        <div class="devCards__logo">
                            <img src="@/assets/images/svg/logo/devLogo.svg" alt="Logo">
                        </div>
                        <div class="devCards__name card__buildName">
                            Ferghana MCJ Stroy
                        </div>
                        <div class="devCards__line bg-dark"></div>
                        <div class="devCards__text main__text">31 Дом сдан</div>
                        <div class="devCards__text main__text">25 домов в процесе</div>
                    </nuxt-link>

                </div>
                <div class="buildings__block">
                    <div class="text-center">
                        <b-button variant="transparent" class="main__button_seeMore shadow-none">
                        Показать ещё
                        <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6278 1.08106e-05C10.5951 -0.00294753 8.60667 0.601323 6.91163 1.73714C6.64846 1.91337 6.46523 2.18822 6.40224 2.50122C6.33925 2.81422 6.40167 3.13973 6.57576 3.40614C6.74985 3.67255 7.02135 3.85805 7.33054 3.92181C7.63973 3.98558 7.96128 3.92239 8.22445 3.74616C9.53026 2.87143 11.062 2.40622 12.6278 2.40878C17.035 2.40878 20.6205 6.03876 20.6205 10.5C20.6205 14.9613 17.035 18.5912 12.6278 18.5912C8.22054 18.5912 4.63498 14.9615 4.63498 10.5C4.63496 10.2244 4.64861 9.94904 4.67588 9.67485L5.23758 10.487C5.41856 10.7486 5.69481 10.9268 6.00555 10.9823C6.31629 11.0377 6.63608 10.966 6.89456 10.7828C7.15303 10.5996 7.32903 10.3199 7.38383 10.0053C7.43863 9.69076 7.36774 9.36704 7.18676 9.10538L5.11776 6.11403C5.02815 5.98447 4.9142 5.87404 4.78243 5.78906C4.65066 5.70407 4.50364 5.6462 4.34978 5.61873C4.19591 5.59126 4.0382 5.59475 3.88567 5.62898C3.73313 5.66322 3.58875 5.72753 3.46076 5.81825L0.505861 7.91283C0.247916 8.09626 0.0724249 8.37582 0.0179228 8.69012C-0.0365794 9.00443 0.0343631 9.32778 0.215172 9.58918C0.395981 9.85058 0.671876 10.0286 0.982273 10.0843C1.29267 10.1399 1.61219 10.0686 1.87068 9.88597L2.29492 9.58527C2.26919 9.88803 2.25526 10.1929 2.25526 10.5C2.25526 16.2897 6.90826 21 12.6276 21C18.3469 21 23 16.2897 23 10.5C23 4.71027 18.3471 1.08106e-05 12.6278 1.08106e-05Z"/>
                        </svg>
                        </b-button>
                    </div>
                    <div class="buildings__block_pagination d-flex justify-content-center">
                        <div style="margin-right: 20px;" v-for="item in pagination" :key="item.id">
                        <input 
                            type="radio" 
                            class="buildings__radio" 
                            v-model="selected_pagination" 
                            :value="item.size" 
                            :id="item.id" 
                            :name="item.id"
                            :disabled="item.disabled"
                        ></input>
                        <label :for="item.id" class="buildings__radio_label"><span>{{ item.size }}</span></label> 
                        </div>
                        <b-button variant="transparent" class="buildings__pagination_btn shadow-none"><img src="@/assets/images/svg/pagination-arrow.svg"></b-button>
                    </div>
                </div>
                <div class="content__text">
                    <h6 class="discription__title">Квартиры в новостройках Ферганы </h6>
                    <span class="main__text">пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи! Пользуются большим спросом, на нашем сайте можете размещать не ограниченное колличество квартир в любой из категорий. А так же размещать рекламные и информационные статьи. Удачи!</span>
                </div>
            </div>
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/main/header'
import Footer from '@/components/main/footer'
import VSelectize from '@isneezy/vue-selectize'

export default {
    components: { 
        VSelectize
    },
    data() {
        return {
            breadcrumbItems: [
                {
                    text: 'Главная',
                    href: '/'
                },
                {
                    text: 'Застройщики Ферганы',
                    active: true
                }
            ],
            sortingByPrice: [
                'По убыванию',
                'По возрастанию'
            ],
            selected_sortingByPrice: '',
            pagination: [
                {
                    id: 'pagination-1',
                    size: "1",
                    value: '1'
                },
                {
                    id: 'pagination-2',
                    size: "2",
                    value: '2'
                },
                {
                    id: 'pagination-3',
                    size: "3",
                    value: '4'
                },
                {
                    id: 'pagination-4',
                    size: "4",
                    value: '4'
                },
                {
                    id: 'pagination',
                    size: "...",
                    value: null,
                    disabled: true
                },
                {
                    id: 'pagination-5',
                    size: "20",
                    value: '20'
                }
            ],        
            selected_pagination: 1
        }
    }
}
</script>