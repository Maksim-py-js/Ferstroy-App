<template>
	<div class="wood">
        <h6 class="woodTitle main__title text-center">Объекты застройщика</h6>
        <div class="woodBody">
            <div class="woodItem" v-for="object in woodData" :key="object.year.id">
                <div class="woodLinks"></div>
                <div class="woodMiddle text-center">
                    <div class="woodYear">{{object.year.name}}  г.</div>
                    <div class="woodArrow">
                        <img src="@/assets/images/svg/arrayYear.svg"/>
                    </div>
                </div>
                <div class="woodLinks">
                    <!-- <nuxt-link 
                        class="objectItem text-decoration-none"
                        v-for="item in object.year_residential_complexes" 
                        :key="item.id"
                        :to="`/developers/developer/object/${item.id}`" 
                    > -->
                    <nuxt-link 
                        class="objectItem text-decoration-none"
                        v-for="item in object.year_residential_complexes" 
                        :key="item.id"
                        :to="`/developers/developer/object/bud`" 
                    >
                        <div class="woodImage">
                            <img :src="item.image">
                        </div>
                        <div class="woodDevNameBox">
                            <div class="woodDevName rounded maint__text">{{item.name}}</div>
                        </div>
                        <div class="line"></div>   
                    </nuxt-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
	    props: ['objects'],
		metaInfo () {
			return {
				objects: this.object
			}
	    },
        data() {
            return {
                woodData: null
            }
        },
        mounted() {
            this.getWood();
        },
        methods: {
            
            getWood() {
                this.woodData = this.objects.years;
                // let arr = this.objects;
                // console.log(arr);
            }
        }
	}
</script>

<style>
	.wood {
        margin: 50px 0 67px;
    }
   
    .woodTitle {
        font-size: 30px;
        font-weight: 500;
        line-height: 36.57px;
        margin-bottom: 50px;
    }
    .woodYear {
        font-size: 66px;
        font-weight: 500;
        font-family: 'Oswald';
        margin: 0 30px 41px;
        direction: ltr;
    }
    .woodEmpty {
        max-width: 520px;
        width: 100%;
    }
    .woodItem {
        margin-top: 10px;
        text-align: right;
    }
    .woodItem:last-child .woodArrow{
        display: none;
    }
    .woodItem:nth-child(2n) .woodLinks{
        text-align: right;
    }
    .woodItem:nth-child(2n) {
        direction: rtl;
    }
    .objectItem {
        position: relative;
    }
    .objectItem:last-child .line{
        display: none;
    }
    .woodImage {
        border: 2px solid transparent;
        display: inline-block;
        vertical-align: middle;
        font-size: 0;
        transition: 1s;
        max-width: 150px;
        width: 100%;
        max-height: 150px;
        height: 100%;
        overflow: hidden;
    }
    .woodImage img {
        width: 100%;
    }
    .woodImage:hover {
        transition: 1s;
        border: 2px solid #FF9800;
    }
    .woodImage:hover .woodDevNameBox { 
        display: block;
    }
    .line {
        width: 13px;
        height: 2px;
        background: #000;
        display: inline-block;
        margin: 0 11px;
        vertical-align: middle;
    }
    .woodMiddle {
        display: inline-block;
        vertical-align: top;
    }
    .woodLinks {
        padding-bottom: 10px;
        width: calc(100% / 2 - 113px);
        text-align: left;
        display: inline-block;
        vertical-align: top;
        box-sizing: border-box;
        overflow: auto;
        white-space: nowrap;
        font-size: 0;
    }
    .woodLinks::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .woodLinks::-webkit-scrollbar-track {
        background: #f6f6f6;
        border-radius: 0;
    }
    .woodLinks::-webkit-scrollbar-thumb {
        background: #FF9800;
        border-radius: 0px;
    }
    .woodDevNameBox {
        display: none;
        position: absolute;
        top: -131px;
        left: 50%;
        transform: translateX(-50%);
    }
    .woodDevName {
        background: #F6F6F6;
        border: 1px solid #D8DAE1;
        padding: 18px 31px;
        font-size: 20px;
        font-weight: 600;
        text-transform: uppercase;
        color: #000;
        transform: translate(0, 0px);
    }
    .woodDevName:after {
        content: '';
        transform: rotate(45deg);
        width: 22px;
        height: 22px;
        background: #f6f6f6;
        border: 1px solid #D8DAE1;
        border-top: 0px;
        border-left: 0px;
        position: absolute;
        left: 15px;
        bottom: -11px;
    }
</style>