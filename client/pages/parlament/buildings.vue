<template>
    <div class="h-panel">
        <div class="background-filter"></div>  
        <b-navbar class="panel-top p-0 mb-4">
            <!-- Right aligned nav items -->
            <b-navbar-nav class="align-items-center justify-content-between w-100 full-bar">
                <!-- <b-breadcrumb variant="transparent" :items="bredcrumbsItems" class="custom-breadcrumbs mb-0 bg-transparent text-light"></b-breadcrumb> -->
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
                    no-slide="true"
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
                <!-- <b-breadcrumb variant="transparent" :items="bredcrumbsItems" class="custom-breadcrumbs mb-0 bg-transparent text-light"></b-breadcrumb> -->
                <nuxt-link to="/" class="header__logo admin-logo">
                    <img src="@/assets/images/svg/logo/russian-light.svg">
                </nuxt-link>
                
            </b-navbar-nav>
        </b-navbar>
        <b-col class="bg-light w-100 p-0">                
            <div class="main">
                <div no-body class="border-0 w-100 p-0">
                    <b-container fluid class="p-3">
                        <!-- User Interface controls -->
                        <b-row class="mb-4">
                            <b-col lg="6" class="my-1">
                                <b-form-group
                                    class="mb-0"
                                >
                                    <b-input-group size="sm">
                                        <b-form-input
                                            id="filter-input"
                                            v-model="filter"
                                            type="text"
                                            placeholder="Поиск по таблице"
                                            class="searchBar__input br-0"
                                        ></b-form-input>
                                        <!-- <b-button 
                                            variant="transparent" 
                                            :disabled="!filter" 
                                            @click="filter = ''"
                                            class="m-0 bl-0 border"
                                        >
                                              
                                        </b-button> -->
                                    </b-input-group>
                                </b-form-group>
                            </b-col>
                        </b-row>
                        <b-col class="p-0">
                            <b-form-group
                                class="mb-3 mr-0 ml-0"
                            >
                                <!-- <b-form-select
                                    id="per-page-select"
                                    v-model="perPage"
                                    :options="pageOptions"
                                ></b-form-select> -->
                                <v-selectize 
                                    id="per-page-select"
                                    v-model="perPage"
                                    :options="pageOptions"
                                    class="searchBar__selectize select-300"
                                />
                            </b-form-group>
                        </b-col>

                        <!-- Main table element -->
                        <b-table
                            striped 
                            hover
                            :items="items"
                            :fields="fields"
                            :current-page="currentPage"
                            :per-page="perPage"
                            :filter="filter"
                            :filter-included-fields="filterOn"
                            :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc"
                            :sort-direction="sortDirection"
                            stacked="md"
                            show-empty
                            small
                        >
                            <template #cell(name)="row">
                                {{ row.value }}
                            </template>

                            <template #cell(information)="row">
                                <div @click="info(row.item, row.index, $event.target)" class="infoBtn border-0 rounded-circle">
                                    <div class="h4 mb-0">
                                        <b-icon-exclamation-circle-fill variant="secondary"></b-icon-exclamation-circle-fill>
                                    </div>
                                </div>
                            </template>

                            <template #cell(history)="row">
                                <div style="cursor: pointer" @click="row.toggleDetails">{{row.value}}</div>
                            </template>

                            <template #row-details="row">
                                <b-button size="sm" class="close_history" @click="row.toggleDetails">
                                    <img src="@/assets/images/svg/close.svg" alt="close">
                                </b-button>
                                
                          </template>
                        </b-table>

                        <b-col>
                            <b-pagination
                                v-model="currentPage"
                                :total-rows="totalRows"
                                :per-page="perPage"
                                align="center"
                                first-number
                                last-number
                            >
                                <template #prev-text><img class="ratate-180" src="@/assets/images/svg/pagination-arrow.svg"></template>
                                <template #next-text><img src="@/assets/images/svg/pagination-arrow.svg"></template>
                            </b-pagination>
                        </b-col>

                        <!-- Info modal -->
                        <b-modal :id="infoModal.id" :title="infoModal.title" ok-only centered body-class="admin-modal-body">
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Имя застройщика:</strong>
                                    <span class="model-itemData">{{dataBuilds.name}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Рейтинг:</strong>
                                    <span class="model-itemData">{{dataBuilds.rating}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Дата основания:</strong>
                                    <span class="model-itemData">{{dataBuilds.foundationDate}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количество техники:</strong>
                                    <span class="model-itemData">{{dataBuilds.machinery}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количество рабочих:</strong>
                                    <span class="model-itemData">{{dataBuilds.numberWorkers}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{dataBuilds.phone}},<br/> {{dataBuilds.address}}</div>
                                </li>
                            </ul>
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
    export default {
        components: { 
            VSelectize
        },
        data() {
            return {
                active: false,
                tabsItem: [
                    {
                        id: 1,
                        path: "/parlament/developer_users",
                        name: 'Застройщики',
                        active: false
                    },
                    {
                        id: 2,
                        path: "/parlament/area",
                        name: 'Жилые комплексы',
                        active: false
                    },
                    {
                        id: 3,
                        path: "/parlament/buildings",
                        name: 'Процесс',
                        active: true
                    }
                ],
                dataProcess: [
                    {
                        name: 'Anol Group',//Название компании
                        rating: 5, //рейтинг
                        phone: '+998 90 987 43 21',//номер телефона 
                        address: 'А.Яссавий 36/5',//адресс офиса застройщика
                        history: [
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
                                    },
                                    {
                                        id: 5,
                                        name: 'Gold House',
                                        image: 'minBuild.png'
                                    },
                                    {
                                        id: 6,
                                        name: 'Yerevan',
                                        image: 'minBuild.png'
                                    }
                                ]
                            },
                            {
                                year: '2018',
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
                                    },
                                    {
                                        id: 5,
                                        name: 'Gold House',
                                        image: 'minBuild.png'
                                    },
                                    {
                                        id: 6,
                                        name: 'Yerevan',
                                        image: 'minBuild.png'
                                    }
                                ]
                            }
                        ],//история застроек
                        machinery: 5,//количество техники
                        foundationDate: 2005,//дата основания компании
                        numberWorkers: 5,//количество рабочих
                        constructedObjects: 6,//количество построенных объектов
                        foreman: 'Захридин'//имя застройщика
                    }
                ],
                dataBuilds: {
                    name: 'Anol Group',//Название компании
                    rating: 5, //рейтинг
                    phone: '+998 90 987 43 21',//номер телефона 
                    history: '2016-2024',//история застроек
                    machinery: 5,//количество техники
                    foundationDate: 2005,//дата основания компании
                    numberWorkers: 5,//количество рабочих
                    constructedObjects: 6,//количество построенных объектов
                    address: 'А.Яссавий 36/5',//адресс офиса застройщика
                    foreman: 'Захридин'//имя застройщика
                },
                items: [
                    { name: 'Anol Group', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'AkayCity', rating: 4, phone: '+998 99 985 45 65', history: '2016-2024' },
                    { name: 'Aparto', rating: 3, phone: '+998 95 943 56 72', history: '2016-2024' },
                    { name: 'Aristocrat Home', rating: 5, phone: '+998 95 847 34 23', history: '2016-2024' },
                    { name: 'Arjun', rating: 3, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Asklepiy svift', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Asser Stroy Servis', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'BB-Stroy', rating: 2, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Murad Buildings', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Bizning Uylar Development', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Akay City', rating: 4, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'NOVASTROY', rating: 2, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'GENESYS', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Dream House', rating: 3, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Real House', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'First Development Group', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'NRG', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Future House', rating: 1, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Golden House', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' }
                ],
                fields: [
                    { key: 'name', label: 'Имя', sortable: true },
                    { key: 'rating', label: 'Рейтинг', sortable: true, class: 'centerBlock' },
                    { key: 'phone', label: 'Контакт', sortable: false, class: 'centerBlock' },
                    { key: 'information', label: 'Доп. информация', sortable: false, class: 'centerBlock' },
                    { key: 'history', label: 'История', sortable: false, class: 'centerBlock' },
                ],
                totalRows: 100,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 20],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'info-modal',
                    title: 'Golden House',
                    content: ''
                }
            }
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key }
                })
            }
        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.items.length
        },
        methods: {
            info(item, index, button) {
                this.infoModal.title = `${item.name}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>

<style>
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
    .navbar .tabs .nav .tabs-item a:hover, .navbar .tabs .nav .tabs-item.active a  {
        color: #FF9800;
        transition: 0.5s;
    }
   /* .tabs-item a:hover, .tabs-item.active a {
        color: #FF9800;
        transition: 0.5s;
    }*/
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
        max-width: 500px;
        width: 100%;
        padding: 16px;
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