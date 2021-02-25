<template>
    <div>
        <div class=""></div>
        <div class="container_1290 searchResult">
            <b-breadcrumb :items="breadcrumbItems" variant="transparent"></b-breadcrumb>
            <div class="d-flex justify-content-between align-items-center searchResult__header">                
                <div class="main__title">Результаты поисков</div>            
                <div class="">
                    <v-selectize 
                        placeholder="Сортировать"
                        v-model="selected_sortingByPrice" 
                        :options="sortingByPrice"
                        class="searchResult__header_selectize select-300"
                    />
                </div>
            </div>
            <div class="d-flex">                
                <div class="searchResult__leftRow">
                    <div class="searchResult__leftRowCard">
                        <span v-model="filterHouseState" v-for="item in filterHouse" :key="item.id">                                        
                            <input type="checkbox" class="searchResult__checkbox" v-model="item.state" :class="item.class" :id="item.id" :name="item.id"></input>
                            <label class="searchResult__checkbox-label" :for="item.id"><span>{{ item.name }}</span></label>
                        </span>
                        <div>
                            <div class="searchResult__leftRow_mainTitle">Поиск новостроек</div>                        
                            <v-selectize 
                                placeholder="Выберите регион"
                                v-model="selected_apartmantPerFloor" 
                                :options="apartmantPerFloor"
                                class="searchResult__leftRow_selectize select-260 width-260 m-0"
                            />
                            <div class="position-relative">                        
                                <div class="position-absolute pos-a-left-20" style="top: 50%; transform: translateY(-50%);">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#77C85B" d="M7.37201 14.7559C8.88978 14.7559 10.2919 14.2929 11.4628 13.5118L15.6981 17.7505C16.0307 18.0832 16.5799 18.0832 16.9267 17.7505L17.7507 16.9259C18.0831 16.5931 18.0831 16.0434 17.7507 15.6962L13.5009 11.472C14.2813 10.3002 14.744 8.89693 14.744 7.37794C14.744 3.31284 11.4338 0 7.37201 0C3.31018 0 0 3.31284 0 7.37794C0 11.4429 3.29572 14.7559 7.37201 14.7559ZM7.37201 2.89331C9.84381 2.89331 11.853 4.90416 11.853 7.37794C11.853 9.85172 9.84381 11.8626 7.37201 11.8626C4.90022 11.8626 2.89099 9.85172 2.89099 7.37794C2.89099 4.90416 4.90022 2.89331 7.37201 2.89331Z"/>
                                    </svg>
                                </div>
                                <input type="text" placeholder="Поиск по названию ЖК" class="searchResult__leftRow_input"></input>
                            </div>
                        </div>
                        <div>
                            <div class="searchResult__leftRow_title">Комнат площадь</div>
                            <div class="d-flex mt-16">
                                <div class="searchResult__leftRow__txtRoom">Студия</div>
                                <div class="mr-6" v-for="item in roominessItems" :key="item.id">
                                    <input 
                                        type="radio" 
                                        class="searchResult__leftRow_radio" 
                                        :class="item.classDisabled"
                                        v-model="selected_roominess" 
                                        :value="item.size" 
                                        :id="item.id" 
                                        :name="item.id"
                                        :disabled="item.disabled"
                                    ></input>
                                    <label :for="item.id" class="searchResult__leftRow_radio_label"><span>{{ item.size }}</span></label> 
                                </div>
                            </div> 
                        </div>                        
                        <div>
                            <div class="searchResult__leftRow_title">Площадь</div>
                            <div class="d-flex justify-content-between searchResult__leftRow_squareInput">
                                <b-input-group class="shadow-none">
                                    <b-form-input type="number" min="0" class="border-0 shadow-none" placeholder="От 0"></b-form-input>
                                    <img src="@/assets/images/svg/inputNumberLine.svg">
                                    <b-form-input type="number" min="0" class="border-0 shadow-none" placeholder="До 0"></b-form-input>
                                </b-input-group>
                                <div class="searchResult__leftRow__txtRoom m-0">м2</div>
                            </div>
                            <v-selectize 
                                placeholder="Отделка"
                                v-model="selected_finishing" 
                                :options="finishing"
                                class="searchResult__leftRow_selectize select-260 mb-4p"
                            />
                            <v-selectize 
                                placeholder="Отделка"
                                v-model="selected_finishing" 
                                :options="finishing"
                                class="searchResult__leftRow_selectize select-260 mb-4p"
                            />
                            <v-selectize 
                                placeholder="Отделка"
                                v-model="selected_finishing" 
                                :options="finishing"
                                class="searchResult__leftRow_selectize select-260 mb-4p"
                            />
                            <v-selectize 
                                placeholder="Отделка"
                                v-model="selected_finishing" 
                                :options="finishing"
                                class="searchResult__leftRow_selectize select-260 mb-4p"
                            />
                        </div>
                        <b-button variant="transparent" class="searchResult__leftRow_confirmBtn shadow-none" to="/search_result">                          
                            Найти
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.37201 14.7559C8.88978 14.7559 10.2919 14.2929 11.4628 13.5118L15.6981 17.7505C16.0307 18.0832 16.5799 18.0832 16.9267 17.7505L17.7507 16.9259C18.0831 16.5931 18.0831 16.0434 17.7507 15.6962L13.5009 11.472C14.2813 10.3002 14.744 8.89693 14.744 7.37794C14.744 3.31284 11.4338 0 7.37201 0C3.31018 0 0 3.31284 0 7.37794C0 11.4429 3.29572 14.7559 7.37201 14.7559ZM7.37201 2.89331C9.84381 2.89331 11.853 4.90416 11.853 7.37794C11.853 9.85172 9.84381 11.8626 7.37201 11.8626C4.90022 11.8626 2.89099 9.85172 2.89099 7.37794C2.89099 4.90416 4.90022 2.89331 7.37201 2.89331Z"/>
                            </svg>
                        </b-button>
                        <div class="searchResult__leftRow_onMap position-relative">
                            <nuxt-link to="/map">
                                <img src="@/assets/images/png/map.png">
                                <div class="searcchOnMap">
                                    <div class="text-center"><img src="@/assets/images/svg/icon-mapLock.svg"></div>
                                    <div class="searcchOnMap__text">На карте</div>
                                </div>
                            </nuxt-link>
                        </div>
                    </div>
                    <div class="searchResult__leftRowCard_sm">
                        <div class="leftRowCard__title d-flex justify-content-between align-items-center">
                            <div class="leftRowCard__title_text">Вы просматривали</div>
                            <div class="leftRowCard__title_image"><img src="@/assets/images/svg/eye-icon.svg"></div>
                        </div>
                        <nuxt-link to="/developers/developer/object" class="text-decoration-none" v-for="i in 3" :key="i">
                            <div class="leftRowCard d-flex">
                                <div class="leftRowCard__image">
                                    <img src="@/assets/images/png/cards/image 52.png">
                                </div>
                                <div class="leftRowCard__description">
                                    <div class="leftRowCard__country">Москва</div>
                                    <div class="leftRowCard__name">Сказочный лес</div>  
                                </div>
                            </div>
                        </nuxt-link>
                        <div class="text-center">
                            <b-button variant="transparent" class="main__button_seeMore_sm shadow-none">
                            Показать ещё
                            <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.6278 1.08106e-05C10.5951 -0.00294753 8.60667 0.601323 6.91163 1.73714C6.64846 1.91337 6.46523 2.18822 6.40224 2.50122C6.33925 2.81422 6.40167 3.13973 6.57576 3.40614C6.74985 3.67255 7.02135 3.85805 7.33054 3.92181C7.63973 3.98558 7.96128 3.92239 8.22445 3.74616C9.53026 2.87143 11.062 2.40622 12.6278 2.40878C17.035 2.40878 20.6205 6.03876 20.6205 10.5C20.6205 14.9613 17.035 18.5912 12.6278 18.5912C8.22054 18.5912 4.63498 14.9615 4.63498 10.5C4.63496 10.2244 4.64861 9.94904 4.67588 9.67485L5.23758 10.487C5.41856 10.7486 5.69481 10.9268 6.00555 10.9823C6.31629 11.0377 6.63608 10.966 6.89456 10.7828C7.15303 10.5996 7.32903 10.3199 7.38383 10.0053C7.43863 9.69076 7.36774 9.36704 7.18676 9.10538L5.11776 6.11403C5.02815 5.98447 4.9142 5.87404 4.78243 5.78906C4.65066 5.70407 4.50364 5.6462 4.34978 5.61873C4.19591 5.59126 4.0382 5.59475 3.88567 5.62898C3.73313 5.66322 3.58875 5.72753 3.46076 5.81825L0.505861 7.91283C0.247916 8.09626 0.0724249 8.37582 0.0179228 8.69012C-0.0365794 9.00443 0.0343631 9.32778 0.215172 9.58918C0.395981 9.85058 0.671876 10.0286 0.982273 10.0843C1.29267 10.1399 1.61219 10.0686 1.87068 9.88597L2.29492 9.58527C2.26919 9.88803 2.25526 10.1929 2.25526 10.5C2.25526 16.2897 6.90826 21 12.6276 21C18.3469 21 23 16.2897 23 10.5C23 4.71027 18.3471 1.08106e-05 12.6278 1.08106e-05Z"/>
                            </svg>
                            </b-button>
                        </div>
                    </div>
                    <div class="searchResult__leftRow_mainTitle mt-43 mb-0">Популярные новостройки</div>
                    <div class="searchResult__leftRowCard_sm mt-15">
                        <div class="leftRowCard__title d-flex justify-content-between align-items-center">
                            <div class="leftRowCard__title_text">Вы просматривали</div>
                            <div class="leftRowCard__title_image"><img src="@/assets/images/svg/eye-icon.svg"></div>
                        </div>
                        <nuxt-link to="/developers/developer/object" class="text-decoration-none" v-for="i in 3" :key="i">
                            <div class="leftRowCard d-flex">
                                <div class="leftRowCard__image">
                                    <img src="@/assets/images/png/cards/image 52.png">
                                </div>
                                <div class="leftRowCard__description">
                                    <div class="leftRowCard__country">Москва</div>
                                    <div class="leftRowCard__name">Сказочный лес</div>  
                                </div>
                            </div>
                        </nuxt-link>                        
                        <div class="text-center">
                            <b-button variant="transparent" class="main__button_seeMore_sm shadow-none">
                            Показать ещё
                            <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.6278 1.08106e-05C10.5951 -0.00294753 8.60667 0.601323 6.91163 1.73714C6.64846 1.91337 6.46523 2.18822 6.40224 2.50122C6.33925 2.81422 6.40167 3.13973 6.57576 3.40614C6.74985 3.67255 7.02135 3.85805 7.33054 3.92181C7.63973 3.98558 7.96128 3.92239 8.22445 3.74616C9.53026 2.87143 11.062 2.40622 12.6278 2.40878C17.035 2.40878 20.6205 6.03876 20.6205 10.5C20.6205 14.9613 17.035 18.5912 12.6278 18.5912C8.22054 18.5912 4.63498 14.9615 4.63498 10.5C4.63496 10.2244 4.64861 9.94904 4.67588 9.67485L5.23758 10.487C5.41856 10.7486 5.69481 10.9268 6.00555 10.9823C6.31629 11.0377 6.63608 10.966 6.89456 10.7828C7.15303 10.5996 7.32903 10.3199 7.38383 10.0053C7.43863 9.69076 7.36774 9.36704 7.18676 9.10538L5.11776 6.11403C5.02815 5.98447 4.9142 5.87404 4.78243 5.78906C4.65066 5.70407 4.50364 5.6462 4.34978 5.61873C4.19591 5.59126 4.0382 5.59475 3.88567 5.62898C3.73313 5.66322 3.58875 5.72753 3.46076 5.81825L0.505861 7.91283C0.247916 8.09626 0.0724249 8.37582 0.0179228 8.69012C-0.0365794 9.00443 0.0343631 9.32778 0.215172 9.58918C0.395981 9.85058 0.671876 10.0286 0.982273 10.0843C1.29267 10.1399 1.61219 10.0686 1.87068 9.88597L2.29492 9.58527C2.26919 9.88803 2.25526 10.1929 2.25526 10.5C2.25526 16.2897 6.90826 21 12.6276 21C18.3469 21 23 16.2897 23 10.5C23 4.71027 18.3471 1.08106e-05 12.6278 1.08106e-05Z"/>
                            </svg>
                            </b-button>
                        </div>
                    </div>
                </div>                  
                <div class="h-100">          
                    <div class="d-flex flex-wrap searchResult__cards">
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 52.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 53.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textActive">Построено</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 54.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 55.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 56.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textActive">Построено</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 57.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textActive">Построено</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 58.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textActive">Построено</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 59.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 52.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 53.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textActive">Построено</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 54.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/developers/developer/object" class="linkCard">
                            <div class="card">
                                <div class="card__image">
                                <img src="@/assets/images/png/cards/image 55.png">
                                </div>
                                <div class="card__image_bg"></div>
                                <div class="card__content_top d-flex justify-content-between align-items-top">
                                <div>
                                    <div class="card__companyName">BudCapital</div>
                                    <div class="card__buildName">ЖК Star City</div>
                                </div>
                                <div class="card__rating d-flex">
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/star.svg"></div>
                                    <div class="card__rating_text">4.5</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="card__rating_image"><img src="@/assets/images/svg/card-icons/message.svg"></div>
                                    <div class="card__rating_text">25</div>
                                    </div>
                                </div>
                                </div>
                                <div class="card__content_bottom">
                                <b-button variant="transparent" class="card__btnStay shadow-none">Осталось - 100 квартир</b-button>
                                <div class="card__price">от <span>2.07</span> млн сум м2</div>
                                <div class="card__status d-flex justify-content-between">
                                    <div class="d-flex">
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/discount.svg">
                                        <span class="card__status_tooltip">В рассрочку</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/clock.svg">
                                        <span class="card__status_tooltip">Время</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/key.svg">
                                        <span class="card__status_tooltip">Под ключ</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/warranty.svg">
                                        <span class="card__status_tooltip">Гарантия</span>
                                    </div>
                                    <div class="card__status_image">
                                        <img src="@/assets/images/svg/card-icons/without_finishing.svg">
                                        <span class="card__status_tooltip">Без отделки</span>
                                    </div>
                                    </div>
                                    <div class="card__status_text card__status_textDisactive">Строиться</div>
                                </div>
                                </div>
                            </div>
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
                            <div class="mr-20" v-for="item in pagination" :key="item.id">
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'

export default {
    layout: 'main',
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
                    text: 'Результат поисков',
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
            selected_pagination: 1,
            filterHouseState: '',
            filterHouse: [
                {
                    id: 'searchResult__chckbx-1',
                    name: "Новостройки",
                    class: "searchResult__chckbx-130",
                    state: false
                },
                {
                    id: 'searchResult__chckbx-2',
                    name: "Апартменты",
                    class: "searchResult__chckbx-120",
                    state: false
                },
                {
                    id: 'searchResult__chckbx-3',
                    name: "Таунхаусы",
                    class: "searchResult__chckbx-130",
                    state: false
                }
            ],
            apartmantPerFloor: [
                '1',
                '2',
                '3',
                '4',
                '5+'
            ],
            selected_apartmantPerFloor: null,
            finishing: [
                'Да',
                'Нет'
            ],
            selected_finishing: null,
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
                    size: "4+",
                    value: '4'
                }
            ],        
            selected_roominess: '',
        }
    }
}
</script>