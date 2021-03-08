<template>
    <div class="h-panel">
        <div class="background-filter"></div>  
        <b-navbar class="panel-top p-0 mb-4">
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
                            :items="DEVELOPERS"
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

                            <template #cell(years)="row">
                                <div style="cursor: pointer" @click="row.toggleDetails">{{row.item.developer_value.company_history}}</div>
                            </template>

                            <template #row-details="row">
                                <b-button size="sm" class="close_history" @click="row.toggleDetails">
                                    <img src="@/assets/images/svg/close.svg" alt="close">
                                </b-button>
                                <div class="woodBox">
                                    <Wood :objects="row.item"/>
                                </div>
                          </template>
                        </b-table>

                        <!-- Info modal -->
                        <b-modal :id="infoModal.id" :title="infoModal.title" ok-only centered body-class="admin-modal-body">
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Название компании:</strong>
                                    <span class="model-itemData">{{infoModal.comapanyName}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Рейтинг:</strong>
                                    <span class="model-itemData">{{infoModal.rating}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Дата основания:</strong>
                                    <span class="model-itemData">{{infoModal.foundationDate}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количество техники:</strong>
                                    <span class="model-itemData">{{infoModal.machinery}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количество рабочих:</strong>
                                    <span class="model-itemData">{{infoModal.numberWorkers}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{infoModal.phone}},<br/> {{infoModal.address}}</div>
                                </li>
                            </ul>
                        </b-modal>

                        <b-col>
                            <b-pagination
                                v-model="currentPage"
                                :total-rows="totalRows"
                                :per-page="perPage"
                                align="center"

                            ></b-pagination>
                        </b-col>
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
                        id: 1,
                        path: "/parlament/developer_users",
                        name: 'Застройщики',
                        active: true
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
                        active: false
                    }
                ],
                fields: [
                    { key: 'developer_value.name', label: 'Имя', sortable: true },
                    { key: 'developer_value.rating', label: 'Рейтинг', sortable: true, class: 'centerBlock' },
                    { key: 'developer_value.number', label: 'Контакт', sortable: false, class: 'centerBlock' },
                    { key: 'information', label: 'Доп. информация', sortable: false, class: 'centerBlock' },
                    { key: 'years', label: 'История', sortable: false, class: 'centerBlock' },
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
                    title: 'title',
                    id: 'id',
                    rating: 0,
                    phone: 'phone',
                    address: 'address',
                    history: 'history',
                    machinery: 0,
                    foundationDate: 0,
                    numberWorkers: 0,
                    constructedObjects: 0,
                    foreman: 'foreman',
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
            },
            ...mapGetters('dataBase/developers', [
                'DEVELOPERS'
            ])
        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.DEVELOPERS.length;
            this.GET_DEVELOPERS_FROM_API();
        },
        methods: {
            ...mapActions('dataBase/developers', [
                'GET_DEVELOPERS_FROM_API'
            ]),
            info(item, index, button) {
                this.infoModal.title = `${item.developer_value.name}`
                this.infoModal.rating = `${item.developer_value.rating}`
                this.infoModal.phone = `${item.developer_value.number}`
                this.infoModal.address = `${item.developer_value.company_address}`
                this.infoModal.history = `${item.developer_value.company_history}`
                this.infoModal.machinery = `${item.developer_value.count_machinery}`
                this.infoModal.foundationDate = `${item.developer_value.company_foundation_date}`
                this.infoModal.numberWorkers = `${item.developer_value.count_workers}`
                this.infoModal.constructedObjects = `${item.developer_value.count_constructed_objects}`
                this.infoModal.comapanyName = `${item.developer_value.company_name}`
                this.infoModal.foreman = `${item.developer_value.name}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
                this.infoModal.rating = ''
                this.infoModal.phone = ''
                this.infoModal.address = ''
                this.infoModal.history = ''
                this.infoModal.machinery = ''
                this.infoModal.foundationDate = ''
                this.infoModal.numberWorkers = ''
                this.infoModal.constructedObjects = ''
                this.infoModal.comapanyName = ''
                this.infoModal.foreman = ''
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
    .navbar .tabs .nav .tabs-item a:hover  {
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