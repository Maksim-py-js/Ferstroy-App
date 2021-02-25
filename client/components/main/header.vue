<template>
    <div class="position-relative w-100">
        <div class="p-0 m-0 border-0 position-absolute" style="">
            <div class="header_sm__slide">
                <img src="@/assets/images/png/slide_1-min.png" alt="">
                <div class="header_sm__slide_blackoutTop"></div>
                <div class="header_sm__slide_blackout"></div>
            </div>
        </div>
        <div class="header_sm">
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
        </div>
    </div>
</template>

<script>
  export default {

  }
</script>