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
                                    </b-input-group>
                                </b-form-group>
                            </b-col>
                        </b-row>

                        <!-- Main table element -->
                        <b-table
                            striped 
                            hover
                            :items="houses"
                            :fields="fields"
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

                            <template #cell(edit)="row">
                                 <b-button 
                                    variant="primary" 
                                    @click="
                                        house_id = row.item.house.id,
                                        $bvModal.show('postHouseForm')
                                    "
                                >
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <!-- <b-button 
                                    variant="success" 
                                    @click="
                                        $bvModal.show('editForm'), 
                                        edit(row.item, row.index, $event.target)
                                    "
                                >
                                    <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                </b-button> -->
                                <b-button 
                                    variant="primary" 
                                    @click="
                                            $bvModal.show('deleteObj'), 
                                            idDeleteObj=row.item.house.id
                                        "
                                    >
                                    <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                </b-button>
                            </template>
                        </b-table>

                        <!-- add floors -->
                        <!-- <h2 class="panelName">Добовление этажей:</h2>
                        <div class="dataItem">
                            <b-col md="auto" class="p-0">
                                <b-table
                                    striped 
                                    hover
                                    :items="FLOORS"
                                    :fields="fields_floors"
                                    stacked="md"
                                    show-empty
                                    small
                                    v-if="FLOORS.length >= 1"
                                >
                                </b-table>
                                <div class="dataItem">
                                    <div class="label">Номер этажа:</div>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="floor.floor_number"
                                        type="number"
                                        placeholder="1"
                                        class="searchBar__input br-0"
                                    ></b-form-input>
                                </div>
                                <div class="dataItem">
                                    <div class="label">Площадь этажа:</div>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="floor.square"
                                        type="number"
                                        placeholder="1"
                                        class="searchBar__input br-0"
                                    ></b-form-input>
                                </div>
                                <div class="dataItem">
                                    <div class="label">Описание этажа:</div>
                                    <b-form-textarea
                                        id="filter-textarea"
                                        v-model="floor.description"
                                        type="text"
                                        placeholder="Описание"
                                        class="searchBar__input br-0"
                                    ></b-form-textarea>
                                </div>
                                <div class="dataItem">
                                    <div class="label">Добавить обводку этажа:</div>
                                    <form ref="formData">
                                        <b-form-group            
                                            id="input"
                                        >
                                            <b-form-file 
                                                id="input-file" 
                                                v-model="floor.image"
                                            ></b-form-file>
                                        </b-form-group>
                                    </form>
                                </div>
                                <b-button 
                                    v-if="!edit_Floors_Data"
                                    variant="success" 
                                    @click="postFloors();"
                                >
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <b-row class="align-items-center pl-3" v-if="edit_Floors_Data">
                                    <b-button variant="primary" class="mr-2" @click="getEditFloors(edit_Floors_Id), edit_Floors_Data = false">
                                        Изменить
                                    </b-button>
                                    <b-button @click="getEditFloors(null), edit_Floors_Data = false">
                                        Отмена
                                    </b-button>
                                </b-row>
                            </b-col>
                        </div>  
                        
                        <h2 class="panelName">Добовление квартир:</h2>
                        <div class="dataItem">
                            <div class="label">Добавить изоброжение квартиры:</div>
                            <form ref="formData">
                                <b-form-group            
                                    id="input"
                                >
                                    <b-form-file 
                                        id="input-file" 
                                        v-model="appartments.image"
                                    ></b-form-file>
                                </b-form-group>
                            </form>
                        </div>
                        <div class="dataItem">
                            <div class="label">Номер квартиры:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.appartment_number"
                                type="number"
                                placeholder="1"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Описание квартиры:</div>
                            <b-form-textarea
                                id="filter-textarea"
                                v-model="appartments.description"
                                type="text"
                                placeholder="1"
                                class="searchBar__input br-0"
                            ></b-form-textarea>
                        </div>
                        <div class="dataItem">
                            <div class="label">Площадь квартиры:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.square"
                                type="number"
                                placeholder="1"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Цена квартиры:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.price"
                                type="number"
                                placeholder="1"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Телефон для оброщения:</div>
                            <div>
                                <b-form-input
                                    @change="hotLine = 'false'"
                                    id="filter-input"
                                    v-model="appartments.phone_number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                                <b-form-checkbox
                                    id="checkbox-1"
                                    v-model="hotLine"
                                    value="false"
                                    unchecked-value="true"
                                >
                                    Использовать телефон выбранной компании?
                                </b-form-checkbox>
                            </div>
                        </div>
                        <div class="dataItem">
                            <div class="label">Количество комнат:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.roomines"
                                type="number"
                                placeholder="1"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Вариант квартиры:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.veriety"
                                type="text"
                                placeholder="таун-хаус"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Дата начала постройки:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.construction_start_date"
                                type="number"
                                placeholder="2020"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <div class="dataItem">
                            <div class="label">Срок сдачи квартиры:</div>
                            <b-form-input
                                id="filter-input"
                                v-model="appartments.construction_finish_date"
                                type="number"
                                placeholder="2021"
                                class="searchBar__input br-0"
                            ></b-form-input>
                        </div>
                        <b-row class="align-items-center pl-3 mt-4">
                            <b-button variant="primary" v-b-modal.addHouseApprove>
                                Подтвердить!
                            </b-button>
                            <b-button class="ml-4" @click="$bvModal.hide('postHouseForm')">
                                Отмена
                            </b-button>
                        </b-row> -->

                        <!-- delete modal -->
                        <b-modal id="deleteObj" hide-header hide-footer centered>
                            <h1>Вы уверены что хотите удалить объект?</h1>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="deleteObject(), $bvModal.hide('deleteObj')">
                                    Удалить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('deleteObj')">
                                    Отмена
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
        async asyncData({ params }) {
            const id = params.id   
            return { id }    
        },
        data() {
            return {
                active: false,
                tabsItem: [
                    {
                        id: 1,
                        path: "/super_admin/add_developer",
                        name: 'Застройщики',
                        active: false
                    },
                    {
                        id: 2,
                        path: "/super_admin/edit_residential_complexes",
                        name: 'Жилые комплексы',
                        active: false
                    }
                ],

                // tables data 
                fields: [
                    { key: 'id', label: 'Номер дома', sortable: true },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
                ],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],

                // modal Data
                infoModal: {
                    title: 'title',
                    id: 'info',
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
                },
                editModal: {
                    companyName: '',
                    number: '',
                    address: '',
                    email: '',
                    selectImg: [],
                    id: 'edit',
                    content: ''
                },

                // axios Data
                residential_complex: [],
                residential_complex_value: [],
                houses: null,

                // form
                idDeleteObj: null,
                idPatchObj: null,
                idPostHouse: null,
                residential_complex_id: null,
                residential_complex_houses: {
                    residential_complex_id: null,
                    svg: []
                },
                // floors table
                floor: {
                    image: [],
                    floor_number: '',
                    square: '',
                    description: '',
                    phone_number: '',
                    house_id: ''
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
            ...mapGetters('dataBase/residential_complexes', [
                'RESIDENTIAL_COMPLEXES'
            ]),
            ...mapGetters('dataBase/floors', [
                'FLOORS'
            ]),
            ...mapGetters('dataBase/houses', [
                'HOUSES'
            ])
        },
        mounted() {
            this.GET_FLOORS_FROM_API(),
            this.GET_RESIDENTIAL_COMPLEXES_FROM_API(),
            this.GET_HOUSES_FROM_API(),
            this.getHousesById()
        },
        methods: {
            ...mapActions('dataBase/residential_complexes', [
                'GET_RESIDENTIAL_COMPLEXES_FROM_API'
            ]),
            ...mapActions('dataBase/floors', [
                'GET_FLOORS_FROM_API'
            ]),
            ...mapActions('dataBase/houses', [
                'GET_HOUSES_FROM_API'
            ]),

            // axios
            async getHousesById() {
                this.$axios.$get(`/api/residential_complexes/${this.id}`)
                    .then(response => {
                        this.houses = response[0].houses;
 ;                   })
            },
            async postFloors() {
                const formData = new FormData();
                formData.append("image", this.floor.image, this.floor.image.name);
                formData.append("floor_number", this.floor.floor_number);
                formData.append("square", this.floor.square);
                formData.append("description", this.floor.description);
                formData.append("phone_number", this.floor.phone_number);
                formData.append("house_id", this.floor.house_id);

                this.$axios.$post('/api/floors', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        this.floor.house_id = '';
                        // this.GET_RESIDENTIAL_COMPLEXES_FROM_API();
                    }
                })
            }

            // form
        }
    }
</script>

<style>
    .dataItem {
        margin: 20px 0;
    }
    .dataItem .searchBar__input {
        max-width: 300px;
        width: 100%;
        padding: 24px 35px 24px 20px;
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
        background: url('../../../assets/images/png/slide_1-min.png') no-repeat 50% 50%/cover;
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