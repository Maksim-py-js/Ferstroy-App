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
                                            :value="filter"
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
                            <template #cell(floor)="row">
                                <b-button 
                                    variant="success" 
                                >
                                    {{row.item.floors.length}}
                                </b-button>
                            </template>

                            <template #cell(edit)="row">
                                <b-button 
                                    variant="primary" 
                                    @click="
                                        floor.house_id = row.item.house.id,
                                        getHousesFloors(),
                                        appartmentsNull(),
                                        appartments = [],
                                        $bvModal.show('postFloorsForm')
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
                                    variant="danger" 
                                    @click="
                                            $bvModal.show('deleteObj'), 
                                            idDeleteObj=row.item.house.id
                                        "
                                    >
                                    <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                </b-button>
                            </template>
                        </b-table>


                        <!-- add residential_complexes modals -->
                        <b-modal id="postFloorsForm" hide-header hide-footer centered>
                            <h2 class="panelName">Добовление этажей:</h2>
                            <div class="dataItem">
                                <div class="label">Номер этажа:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="floor.floor_number"
                                    :value="floor.floor_number"
                                    type="number"
                                    placeholder="1"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон для оброщений:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="floor.phone_number"
                                    :value="floor.phone_number"
                                    type="number"
                                    placeholder="+998 (90) 456-56-67"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Площадь этажа:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="floor.square"
                                    :value="floor.square"
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
                                    :value="floor.description"
                                    class="searchBar__input br-0"
                                ></b-form-textarea>
                            </div>
                            <div class="dataItem">
                                <div class="label">Количество квртир на этаже:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="house_floor_descriptions.count_appartments"
                                    :value="house_floor_descriptions.count_appartments"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Добавить изоброжение этажа:</div>
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file" 
                                            v-model="floor.image"
                                            :value="floor.image"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <div class="dataItem">
                                <div class="label">Добавить обводку этажа:</div>
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file-floor-hover" 
                                            v-model="house_hovers.svg"
                                            :value="house_hovers.svg"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <h2 class="panelName">
                                Позиционирование таблички описания относительно дома:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Расстояние до верха:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="house_floor_descriptions.positionTop"
                                    :value="house_floor_descriptions.positionTop"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до правой стороны:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="house_floor_descriptions.positionRight"
                                    :value="house_floor_descriptions.positionRight"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до низа:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="house_floor_descriptions.positionBottom"
                                    :value="house_floor_descriptions.positionBottom"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до левой стороны:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="house_floor_descriptions.positionLeft"
                                    :value="house_floor_descriptions.positionLeft"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <h2 class="panelName">Добовление квартир:</h2>
                            <div class="dataItem">
                                <b-col md="auto" class="p-0">
                                    <b-table
                                        striped 
                                        hover
                                        :items="appartments"
                                        :fields="fields_appartments"
                                        stacked="md"
                                        show-empty
                                        small
                                        v-if="appartments.length >= 1"
                                    >
                                        <template #cell(edit)="row">
                                            <b-button 
                                                variant="success" 
                                                @click="editAppartments(row.index), edit_appartments_Id = row.index"
                                            >
                                                <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                            </b-button>
                                            <b-button 
                                                variant="danger" 
                                                @click="
                                                    delAppartments(row.index), 
                                                    getEditAppartments(null), 
                                                    edit_appartments_Id = row.index,
                                                    edit_appartments_Data = false
                                                "
                                            >
                                                <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                            </b-button>
                                        </template>
                                    </b-table>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.appartment_number"
                                        type="text"
                                        :value="appartment.appartment_number"
                                        placeholder="Номер квартиры"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.square"
                                        type="number"
                                        :value="appartment.square"
                                        placeholder="Площадь квартиры"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <b-form-textarea
                                        id="filter-textarea"
                                        v-model="appartment.description"
                                        type="text"
                                        :value="appartment.description"
                                        placeholder="Описание квартиры"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-textarea>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.phone_number"
                                        type="text"
                                        :value="appartment.phone_number"
                                        placeholder="Телефон для оброщений"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.price"
                                        type="number"
                                        :value="appartment.price"
                                        placeholder="Цена"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.roomines"
                                        type="number"
                                        :value="appartment.roomines"
                                        placeholder="Количество комнат"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <b-form-input
                                        id="filter-input"
                                        v-model="appartment.variety"
                                        type="text"
                                        :value="appartment.variety"
                                        placeholder="Тип квартиры"
                                        class="searchBar__input br-0 mb-2"
                                    ></b-form-input>
                                    <div class="dataItem">
                                        <div class="label">Добавить изоброжение квартиры:</div>
                                        <form ref="formData">
                                            <b-form-group            
                                                id="input"
                                            >
                                                <b-form-file 
                                                    id="input-file-appartments" 
                                                    v-model="appartment.image"
                                                ></b-form-file>
                                            </b-form-group>
                                        </form>
                                    </div>
                                    <div class="dataItem">
                                        <div class="label">Забронированно:</div>
                                        <form ref="formData">
                                            <b-form-group            
                                                id="input"
                                            >
                                                <b-form-file 
                                                    id="input-file-appartments-type1" 
                                                    v-model="floor_hovers[0].image"
                                                ></b-form-file>                         
                                            </b-form-group>
                                        </form>
                                    </div>
                                    <div class="dataItem">
                                        <div class="label">Продано:</div>
                                        <form ref="formData">
                                            <b-form-group            
                                                id="input"
                                            >
                                                <b-form-file 
                                                    id="input-file-appartments-type2" 
                                                    v-model="floor_hovers[1].image"
                                                ></b-form-file>
                                            </b-form-group>
                                        </form>
                                    </div>
                                    <div class="dataItem">
                                        <div class="label">Свободно:</div>
                                        <form ref="formData">
                                            <b-form-group            
                                                id="input"
                                            >
                                                <b-form-file 
                                                    id="input-file-appartments-type3" 
                                                    v-model="floor_hovers[2].image"
                                                ></b-form-file>
                                            </b-form-group>
                                        </form>
                                    </div>
                                    <b-button 
                                        v-if="!edit_appartments_Data"
                                        variant="success" 
                                        @click="addAppartments()"
                                    >
                                        <b-icon-plus variant="light"></b-icon-plus>
                                    </b-button>
                                    <!-- <div class="model-itemName" v-if="!edit_appartments_Data">Лимит ограничен</div> -->
                                    <b-row class="align-items-center pl-3" v-if="edit_appartments_Data">
                                        <b-button variant="primary" class="mr-2" @click="getEditAppartments(edit_appartments_Id), edit_appartments_Data = false">
                                            Изменить
                                        </b-button>
                                        <b-button @click="getEditAppartments(null), edit_appartments_Data = false">
                                            Отмена
                                        </b-button>
                                    </b-row>
                                </b-col>
                            </div>   
                            
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.postFloorsApprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postFloorsForm')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="postFloorsApprove" hide-header hide-footer centered>
                            <!-- <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Название ЖК:</strong>
                                    <span class="model-itemData">{{residential_complexes.name}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Электронная почта:</strong>
                                    <span class="model-itemData">{{residential_complexes.email}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Номер для связи:</strong>
                                    <span class="model-itemData">{{residential_complexes.email}}</span>
                                </li>
                            </ul> -->
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button 
                                    variant="primary" 
                                    class="ml-2" 
                                    @click="
                                        postFloors(),
                                        postFloorDescriptions(),
                                        $bvModal.hide('postFloorsApprove'), 
                                        $bvModal.hide('postFloorsForm') 
                                    "
                                >
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postFloorsApprove')">
                                    Назад
                                </b-button>
                            </b-row>
                        </b-modal>

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
                    { key: 'number', label: 'Номер дома', sortable: true },
                    { key: 'floor', label: 'Количество этажей', sortable: false, class: 'centerBlock' },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
                ],
                // features_appartments  tables
                fields_appartments: [
                    { key: 'appartment_number', label: 'Номер квартиры', sortable: false },
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
                house: {
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
                },
                floors: [],
                edit_Floors_Data: false,

                // houses floor hovers
                house_hovers: {
                    svg: [],
                    house_id: '',
                    floor_id: ''
                },

                // house floor descriptions
                house_floor_descriptions: {
                    number: '',
                    count_appartments: '',
                    positionTop: '',
                    positionRight: '',
                    positionBottom: '',
                    positionLeft: '',
                    house_id: ''
                },

                // apartment hovers
                floor_hovers: [
                    {
                        image: [],
                        state: '1',
                        floor_id: '',
                        appartment_id: ''
                    },
                    {
                        image: [],
                        state: '2',
                        floor_id: '',
                        appartment_id: ''
                    },
                    {
                        image: [],
                        state: '3',
                        floor_id: '',
                        appartment_id: ''
                    }
                ],


                // Features Residential Complexes
                appartment: {
                    image: '',
                    appartment_number: '',
                    square: '',
                    description: '',
                    phone_number: '',
                    price: '',
                    roomines: '',
                    variety: '',
                    construction_start_date: '2020',
                    construction_finish_date: '2021',
                    floor_id: ''

                },
                edit_appartments_Data: false,
                edit_appartments_Id: null,
                appartments: []
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
            this.getComplexesHouse()
        },
        methods: {
            ...mapActions('dataBase/residential_complexes', [
                'GET_RESIDENTIAL_COMPLEXES_FROM_API'
            ]),
            ...mapActions('dataBase/houses', [
                'GET_HOUSES_FROM_API'
            ]),
            ...mapActions('dataBase/floors', [
                'GET_FLOORS_FROM_API'
            ]),

            // axios
            async getComplexesHouse() {
                this.$axios.$get(`/api/residential_complexes/${this.id}`)
                    .then(response => {
                        this.houses = response[0].houses;
                })
            },
            async getHousesFloors() {
                this.$axios.$get(`/api/houses/${this.floor.house_id}`)
                    .then(response => {
                        this.floors = response[0].floors;
                })
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
                    this.appartment.floor_id = response.id;
                    if (response.created_at) {
                        this.floor.image = [],
                        this.floor.square = '',
                        this.floor.description = '',
                        this.floor.phone_number = '',

                        this.getHousesFloors();
                        this.appArtmentsForEach();
                        // this.GET_RESIDENTIAL_COMPLEXES_FROM_API();
                    }
                })
                .then(() => {
                    this.postHousesFloorHovers();
                })
            },
            async patchFloor(id) {
                console.log(id);
                // this.$axios.$patch(`/api/floors/${id}`)
            },
            async deleteFloor(id) {
                this.$axios.$delete(`/api/floors/${id}`)
                    .then(() => {
                        this.getHousesFloors();
                    })
            },

            async postFloorDescriptions() {
                const formData = new FormData();
                formData.append("number", this.floor.floor_number);
                formData.append("count_appartments", this.house_floor_descriptions.count_appartments);

                formData.append("positionTop", this.house_floor_descriptions.positionTop);
                formData.append("positionRight", this.house_floor_descriptions.positionRight);
                formData.append("positionBottom", this.house_floor_descriptions.positionBottom);
                formData.append("positionLeft", this.house_floor_descriptions.positionLeft);

                formData.append("house_id", this.floor.house_id);

                this.$axios.$post('/api/house_floor_descriptions', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        this.house_floor_descriptions.count_appartments = '',

                        this.house_floor_descriptions.positionTop = '',
                        this.house_floor_descriptions.positionRight = '',
                        this.house_floor_descriptions.positionBottom = '',
                        this.house_floor_descriptions.positionLeft = ''
                    }
                })  
            },

            async postHousesFloorHovers() {
                const formData = new FormData();
                formData.append("svg", this.house_hovers.svg, this.house_hovers.svg.name);

                formData.append("house_id", this.floor.house_id);
                formData.append("floor_id", this.appartment.floor_id);

                this.$axios.$post('/api/house_hovers', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.postHouseNavigations(response.id);
                })
            },

            async postHouseNavigations(house_hover_id) {
                const formData = new FormData();
                formData.append("number", this.floor.floor_number);
                formData.append("house_id", this.floor.house_id);
                formData.append("floor_id", this.appartment.floor_id);
                formData.append("house_hover_id", house_hover_id);

                this.$axios.$post('/api/house_navigations', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },

            async postFloorsApertmentHovers(item, appartment_id) {
                const formData = new FormData();
                formData.append("image", item.image, item.image.name);

                formData.append("state", item.state);
                formData.append("floor_id", this.appartment.floor_id);
                formData.append("appartment_id", appartment_id);

                this.$axios.$post('/api/floor_hovers', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },

            // appartments complexes
            appartmentsNull() {
                this.appartment.appartment_number = '';
                this.appartment.square = '';
                this.appartment.description = '';
                this.appartment.phone_number = '';
                this.appartment.price = '';
                this.appartment.roomines = '';
                this.appartment.variety = '';
            },
            editAppartments(item) {
                let obj = this.appartments[item];

                this.appartment.appartment_number = obj.appartment_number;
                this.appartment.square = obj.square;
                this.appartment.description = obj.description;
                this.appartment.phone_number = obj.phone_number;
                this.appartment.price = obj.price;
                this.appartment.roomines = obj.roomines;
                this.appartment.variety = obj.variety;
                this.appartment.construction_start_date = obj.construction_start_date;
                this.appartment.construction_finish_date = obj.construction_finish_date;

                this.edit_appartments_Data = true;
            },
            getEditAppartments(item) {
                if(item != null) {
                    let obj = this.appartments[item];
                    obj.appartment_number = this.appartment.appartment_number;
                    obj.square = this.appartment.square;
                    obj.description = this.appartment.description;
                    obj.phone_number = this.appartment.phone_number;
                    obj.price = this.appartment.price;
                    obj.roomines = this.appartment.roomines;
                    obj.variety = this.appartment.variety;
                    obj.construction_start_date = this.appartment.construction_start_date;
                    obj.construction_finish_date = this.appartment.construction_finish_date;

                    this.appartmentsNull();
                } else {
                    this.appartmentsNull();
                }
            },
            delAppartments(item) {
                this.appartments.splice(item, 1);

            },
            addAppartments() {
                let obj = {
                    image: this.appartment.image,
                    appartment_number: this.appartment.appartment_number,
                    square: this.appartment.square,
                    description: this.appartment.description,
                    phone_number: this.appartment.phone_number,
                    price: this.appartment.price,
                    roomines: this.appartment.roomines,
                    variety: this.appartment.variety,
                    construction_start_date: this.appartment.construction_start_date,
                    construction_finish_date: this.appartment.construction_finish_date,
                    floor_id: this.appartment.floor_id
                };
                this.appartments.push(obj);
                this.appartmentsNull();

            },
            appArtmentsForEach() {
                this.appartments.forEach(item => {
                    this.appartment.image = item.image;
                    this.appartment.appartment_number = item.appartment_number;
                    this.appartment.square = item.square;
                    this.appartment.description = item.description;
                    this.appartment.phone_number = item.phone_number;
                    this.appartment.price = item.price;
                    this.appartment.roomines = item.roomines;
                    this.appartment.variety = item.variety;
                    this.appartment.construction_start_date = item.construction_start_date;
                    this.appartment.construction_finish_date = item.construction_finish_date;

                    this.postAppartments();
                })
            },
            async postAppartments() {
                const formData = new FormData();

                formData.append("image", this.appartment.image, this.appartment.image.name);

                formData.append("appartment_number", this.appartment.appartment_number);
                formData.append("square", this.appartment.square);
                formData.append("description", this.description);
                formData.append("phone_number", this.phone_number);
                formData.append("price", this.appartment.price);
                formData.append("roomines", this.appartment.roomines);
                formData.append("variety", this.appartment.variety);
                formData.append("construction_start_date", this.appartment.construction_start_date);
                formData.append("construction_finish_date", this.appartment.construction_finish_date);
                formData.append("floor_id", this.appartment.floor_id);

                this.$axios.$post('/api/appartments', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                .then(response => {
                    this.floor_hovers.forEach(item => {
                        this.postFloorsApertmentHovers(item, response.id);
                    })
                })
            },

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