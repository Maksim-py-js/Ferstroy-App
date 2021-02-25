<template>
  <div>
<!--    <div class="preloader">-->
<!--      <div class="preloader__row">-->
<!--          <div class="preloader__item"></div>-->
<!--          <div class="preloader__item"></div>-->
<!--      </div>-->
<!--    </div>-->
    <HomeHeader />
    <Nuxt />
    <Footer />
  </div>
</template>

<script>
import HomeHeader from '@/components/main/home_header'
import Footer from '@/components/main/footer'

export default {
  mounted() {
    window.onload = function () {
        document.body.classList.add('loaded_hiding');
        window.setTimeout(function () {
        document.body.classList.add('loaded');
        document.body.classList.remove('loaded_hiding');
        }, 500);
    }
  }
}
</script>
