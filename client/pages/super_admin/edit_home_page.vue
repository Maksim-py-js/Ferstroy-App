<template>
    <div class="h-panel">
        <div class="background-filter"></div>  
        <b-navbar class="panel-top p-0 mb-4">
            <b-navbar-nav class="align-items-center justify-content-between w-100 full-bar">
                <nuxt-link to="/" class="header__logo admin-logo">
                    <img src="@/assets/images/svg/logo/russian-light.svg">
                </nuxt-link>
                <div class="tabs p-0">
                    <b-nav>                
                        <b-nav-item
                            v-for="item in tabsItem" 
                            :key="item.id" 
                            :to="item.path" 
                            class="tabs-item pl-0 pt-2 pb-2" 
                            :class="{active:item.active}"
                        >   
                            {{item.name}}
                        </b-nav-item>
                    </b-nav>
                </div>
                <div class="position-relative header__language admin-lenguage">
                    <div class="header__language_block position-absolute">
                        <b-button variant="transparent" class="header__language_btn shadow-none">Рус</b-button>
                        <b-button variant="transparent" class="header__language_btn shadow-none">Узб</b-button>
                    </div>
                </div>
            </b-navbar-nav>

            <b-navbar-nav class="align-items-center justify-content-between w-100 min-bar">
                <div class="d-flex align-items-center">
                    <div v-b-toggle.sidebar-1 style="outline: none;"><b-icon-list class="close-menu-icon"></b-icon-list></div>
                    <div class="position-relative header__language admin-lenguage">
                        <div class="header__language_block position-absolute">
                            <b-button variant="transparent" class="header__language_btn shadow-none">Рус</b-button>
                            <b-button variant="transparent" class="header__language_btn shadow-none">Узб</b-button>
                        </div>
                    </div>
                </div> 
                <b-sidebar 
                    id="sidebar-1" 
                    no-slide
                    shadow
                    body-class="sidebar-body"
                    header-class="sidebar-body"
                    class="sidebar-bg"
                    text-variant="light"
                >
                    <div class="px-3 py-2">
                        <div class="tabs p-0">
                            <b-nav>                
                                <b-nav-item
                                    v-for="item in tabsItem" 
                                    :key="item.id" 
                                    :to="item.path" 
                                    class="tabs-item pl-0 pt-2 pb-2" 
                                    :class="{active:item.active}"
                                >   
                                    {{item.name}}
                                </b-nav-item>
                            </b-nav>
                        </div>
                    </div>
                </b-sidebar>
                <nuxt-link to="/" class="header__logo admin-logo">
                    <img src="@/assets/images/svg/logo/russian-light.svg">
                </nuxt-link>
                
            </b-navbar-nav>
        </b-navbar>
        <b-col class="bg-light w-100 p-0">                
            <div class="main">
                <div no-body class="border-0 w-100 p-0">
                    <b-container fluid class="p-3">
                        <h2 class="panelName">
                            Главная страница:
                        </h2>

                        <div class="dataItem">
                            <div class="label">Заголовок главной страницы:</div>
                            <b-form-input
                                id="input-title"
                                v-model="home_home_page.header_title"
                                type="text"
                                placeholder="Резиденция вашей мечты"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>

                        <div class="dataItem">
                            <div class="label">Название кнопки поиска:</div>
                            <b-form-input
                                id="input-button"
                                v-model="home_home_page.header_search_button"
                                type="text"
                                placeholder="Подобрать недвижимость"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>

                        <div class="dataItem">
                            <div class="label">Номер в меню:</div>
                            <b-form-input
                                id="input-number"
                                v-model="home_home_page.header_number"
                                type="text"
                                placeholder="+998 (90) 345-45-56"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>

                        <div class="dataItem">
                            <div class="label">Наши приемущества:</div>
                            <b-col md="auto" class="p-0">
                                <b-table
                                    striped 
                                    hover
                                    :items="advantages"
                                    :fields="fieldsAdvant"
                                    stacked="md"
                                    show-empty
                                    small
                                    v-if="advantages.length >= 1"
                                >
                                    <template #cell(edit)="row">
                                        <b-button 
                                            variant="success" 
                                            @click="editAdvantage(row.index), editAdventageId = row.index"
                                        >
                                            <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                        </b-button>
                                        <b-button 
                                            variant="danger" 
                                            @click="
                                                delAdvantage(row.index), 
                                                getEditAdvantage(null), 
                                                editAdventageId = row.index,
                                                editData = false
                                            "
                                        >
                                            <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                        </b-button>
                                    </template>
                                </b-table>
                                <b-form-input
                                    id="filter-input-home_advantages-title"
                                    v-model="home_advantages.title"
                                    type="text"
                                    :value="home_advantages.title"
                                    placeholder="название"
                                    class="searchBar__input br-0 mb-2"
                                ></b-form-input>
                                <b-form-input
                                    id="filter-input-home_advantages-count"
                                    v-model="home_advantages.count"
                                    type="number"
                                    :value="home_advantages.count"
                                    placeholder="количество"
                                    class="searchBar__input br-0 mb-2"
                                ></b-form-input>
                                <b-button 
                                    v-if="!editData"
                                    variant="success" 
                                    @click="addAdvantage();"
                                >
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <b-row class="align-items-center pl-3" v-if="editData">
                                    <b-button variant="primary" class="mr-2" @click="getEditAdvantage(editAdventageId), editData = false">
                                        Изменить
                                    </b-button>
                                    <b-button @click="getEditAdvantage(null), editData = false">
                                        Отмена
                                    </b-button>
                                </b-row>
                            </b-col>
                        </div> 

                        <b-row class="align-items-center pl-3 mt-4" v-if="!havePage">
                            <b-button variant="primary" v-b-modal.postHomeDataApprove>
                                Подтвердить!
                            </b-button>
                        </b-row>
                        <b-row class="align-items-center pl-3 mt-4" v-if="havePage">
                            <b-button variant="primary"  @click="patchPage()">
                                Изменить!
                            </b-button>
                        </b-row>
                        <b-modal id="postHomeDataApprove" hide-header hide-footer centered>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="postHomePage(), $bvModal.hide('postHomeDataApprove'), $bvModal.hide('postResidentialComplexesForm')">
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postHomeDataApprove')">
                                    Назад
                                </b-button>
                            </b-row>
                        </b-modal>
                    </b-container>
                </div>
            </div>
        </b-col>
    </div>
</template>

<script>
    import 'selectize/dist/css/selectize.css'
    import VSelectize from '@isneezy/vue-selectize'
    import Wood from '@/components/wood'
    import axios from 'axios'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components: { 
            VSelectize,
            Wood
        },
        data() {
            return {
                active: false,
                tabsItem: [
                    {
                        id: 3,
                        path: "/super_admin/edit_home_page",
                        name: 'Главная страница',
                        active: true
                    },
                    {
                        id: 1,
                        path: "/super_admin/add_developer",
                        name: 'Застройщики',
                        active: false
                    }
                ],
                // advantages
                fieldsAdvant: [
                    { key: 'title', label: 'Название', sortable: false },
                    { key: 'count', label: 'Количество', sortable: false, class: 'centerBlock' },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
                ],
                home_advantages: {
                    title: '',
                    count: '',
                    text: '',
                    icon_id: '',
                    residential_complex_id: '',
                    page_id: '',
                    developer_id: ''
                },
                havePage: false,
                editData: false,
                editAdventageId: null,
                advantages: [],
                page_id: "",
                home_home_page: {
                	header_number: "",
                	header_search_button: "",
                	header_title: ""
                }
            }
        },
        computed: {
        },
        mounted() {
        	this.getPages();
        },
        methods: {
        	async getPages() {
        		this.$axios.$get('/api/pages')
        		.then(response => {
                    console.log(response);
                    this.home_home_page.header_number = response[0].page_value.header_number;
                    this.home_home_page.header_search_button = response[0].page_value.header_search_button;
                    this.home_home_page.header_title = response[0].page_value.header_title;
        			response.length == 1 ? this.havePage = true : this.havePage = false;
        		});
        	},
        	async postHomePage() {
        		const formData = new FormData();

                formData.append("header_number", this.home_home_page.header_number);
                formData.append("header_search_button", this.home_home_page.header_search_button);
                formData.append("header_title", this.home_home_page.header_title);

                this.$axios.$post('/api/pages', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.page_id = response.id;
                    if (response.created_at) {
                    	this.advantagesForEach();
                    	this.getPages();
                    }
                })
        	},
        	async patchPage() {
                this.$axios.$patch(`api/pages/1`, {
                    "header_number": this.home_home_page.header_number,
                    "header_search_button": this.home_home_page.header_search_button,
                    "header_title": this.home_home_page.header_title
                })
                .then(response => {
                    if (response.created_at) {
                    	this.getPages();
                    }
                })
        	},
            // home page advantages
            editAdvantage(item) {
                let obj = this.advantages[item];
                this.home_advantages.title = obj.title;
                this.home_advantages.count = obj.count;
                this.editData = true;
            },
            getEditAdvantage(item) {
                if(item != null) {
                    let obj = this.advantages[item];

                    obj.title = this.home_advantages.title;
                    obj.count = this.home_advantages.count;

                    this.home_advantages.title = '';
                    this.home_advantages.count = '';
                } else {
                    this.home_advantages.title = '';
                    this.home_advantages.count = '';
                }
            },
            delAdvantage(item) {
                this.advantages.splice(item, 1);

            },
            addAdvantage() {
                let obj = {
                    title: this.home_advantages.title,
                    count: this.home_advantages.count,
                    text: this.home_advantages.text,
                    icon_id: this.home_advantages.icon_id,
                    residential_complex_id: this.residential_complex_id,
                    page_id: this.page_id,
                    developer_id: this.home_advantages.developer_id
                };
                this.advantages.push(obj);
                this.home_advantages.title = '';
                this.home_advantages.count = '';

            },
            advantagesForEach() {
                this.advantages.forEach(item => {
                    this.home_advantages.title = item.title;
                    this.home_advantages.count = item.count;
                    this.home_advantages.text = item.text; 
                    this.home_advantages.icon_id = item.icon_id; 
                    this.home_advantages.residential_complex_id = item.residential_complex_id; 
                    this.home_advantages.page_id = this.page_id; 
                    this.home_advantages.developer_id = item.developer_id;

                    this.postAdvantages();
                })
            },
            async postAdvantages() {
                const formData = new FormData();

                formData.append("title", this.home_advantages.title);
                formData.append("count", this.home_advantages.count);
                formData.append("text", this.home_advantages.text);
                formData.append("icon_id", this.home_advantages.icon_id);
                formData.append("residential_complex_id", this.home_advantages.residential_complex_id);
                formData.append("page_id", this.home_advantages.page_id);
                formData.append("developer_id", this.home_advantages.developer_id);

                this.$axios.$post('/api/advantages', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                    }
                })
            },
            async getAdvantages() {
                this.$axios.$get('/api/advantages')
                    .then(advantage => {
                        // this.advantages = advantage;
                    });
            },
        }
    }
</script>

<style>
    .dataItem {
        margin: 20px 0;
    }
    .label {
        font-size: 20px;
        margin-bottom: 10px;
    }
    .dataItem:last-child {
        margin-bottom: 0;
    }
    .close-menu-icon {
        color: #fff;
        font-weight: bold;
        font-size: 30px;
    }
    .h-panel {
        background: url('../../assets/images/png/slide_1-min.png') no-repeat 50% 50%/cover;
        position: relative;
        transition: 0.5s;
        padding: 1.5rem;
        min-height: 100vh;
    }
    .background-filter {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.8) 34.9%);
        transition: 0.5s;
    }
    .panel-top .header__language_block:hover {
        height: 56px;
        transition: 0.5s;
    }
    .full-bar {
        display: flex;
    }
    .tabs .nav {
        display: flex;
        align-items: center;
    }
    .tabs-item {
        margin: 0 30px;
    }
    .navbar .tabs .nav .tabs-item a {
        color: #fff;
        font-family: "Montserrat";
        font-size: 18px;
        font-weight: 400;
        padding: 0;
        transition: 0.5s;
    }
    .navbar .tabs .nav .tabs-item a:hover, .navbar .tabs .nav .tabs-item.active a {
        color: #FF9800;
        transition: 0.5s;
    }
    .min-bar {
        display: none;
    }
    .sidebar-body {
        background: rgba(0, 0, 0, 0.9);
    }
    ul div .b-sidebar {
        background: transparent !important;
    }
    @media only screen and (max-width: 900px) {
        .h-panel {
            padding: 10px;
        }
    }
    @media only screen and (max-width: 820px) {
        .full-bar {
            display: none;
        }
        .min-bar {
            display: flex;
        }
        .tabs-item {
            margin: 0;
        }
        .tabs .nav {
            display: block;
        }
        .admin-lenguage {
            margin: -3px 15px 0;
        }
    }

    tr td div .close_history {
        display: block;
        border: none;
        margin: 0 0 0 auto;
        outline: none;
        box-shadow: none;
    }

    .main {
        display: flex;
        align-items: flex-start;
    }
    .model-data {
       padding: 0;
       list-style: none; 
    }

    .model-item {
        margin: 15px 0;
    }

    div div .admin-modal-body {
        padding: 16px;
    }
    .woodBox {
        margin: 50px auto 67px; 
        max-width: 1290px;
        width: 100%;
        /*display: none;*/
    }
    .woodBox.active {
        display: block;
    }
    div button, div input {
        outline: none;
        box-shadow: none !important;
    }
    .box-size {
        height: 100vh;
    }
    div .tableTitle {
        outline: none;
        cursor: pointer;
    }
    table#table-transition-example .flip-list-move {
        transition: transform 1s;
    }
    .infoBtn {
        max-width: 50px;
        width: 100%;
        font-size: 0; 
        margin: 0 auto;
        cursor: pointer;
    }
    .infoBtn img {
        width: 100%;
        transform: rotate(180deg);
    }
    div .table th, .table td {
        vertical-align: inherit;
    }
    .centerBlock {
        text-align: center;
    }
    @media only screen and (max-width: 767px) {
        .centerBlock {
            text-align: left;
        }
        .infoBtn {
            margin: 0;
        }
    }
</style>
