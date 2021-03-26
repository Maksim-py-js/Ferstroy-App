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
                        <b-col class="p-0">
                            <b-form-group
                                class="mb-3 mr-0 ml-0"
                            >
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
                            :items="RESIDENTIAL_COMPLEXES"
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
                                <div class="woodBox">
                                    <!-- <Wood :objects="row.item.historyWood"/> -->
                                    asd
                                </div>
                            </template>

                            <template #cell(houses)="row">
                                <nuxt-link :to="`/super_admin/edit_houses/${row.item.residential_complex_value.id}`">
                                    <b-button variant="primary">
                                        <b-icon-arrow-right-short variant="light"></b-icon-arrow-right-short>
                                    </b-button>
                                </nuxt-link>
                            </template>

                            <template #cell(edit)="row">
                            	 <b-button 
                            	 	variant="primary" 
                                    @click="
                                		residential_complex_id = row.item.residential_complex_value.id,
                                        r_c_house_id = row.item.residential_complex_houses[0].residential_complex_house[0].id,
                                        $bvModal.show('postHouseForm')
                                    "
                                >
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <b-button variant="success" @click="$bvModal.show('editForm'), idPatchObj=row.item.residential_complex_value.id, edit(row.item, row.index, $event.target)">
                                    <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                </b-button>
                                <b-button variant="danger" @click="$bvModal.show('deleteObj'), idDeleteObj=row.item.residential_complex_value.id">
                                    <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                </b-button>
                            </template>
                        </b-table>

                        <!-- add house modal -->
                        <b-modal id="postHouseForm" hide-header hide-footer centered>
                            <h2 class="panelName">
                                Добовление дома:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Добавить изброжение дома:</div>
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file" 
                                            v-model="house.svg"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <div class="dataItem">
                                <div class="label">Добавить ободку дома:</div>
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file-excretion" 
                                            v-model="r_c_house_hovers.svg"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <h2 class="panelName">
                                Описание дома:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Заголовок описания:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complex_house_description.name"
                                    type="text"
                                    placeholder="заголовок"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Текст описания:</div>
                                <b-form-textarea
                                    id="filter-textarea"
                                    v-model="residential_complex_house_description.text"
                                    type="text"
                                    placeholder="описание"
                                    class="searchBar__input br-0"
                                ></b-form-textarea>
                            </div>
                            <h2 class="panelName">
                                Позиционирование таблички описания относительно дома:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Расстояние до верха:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complex_house_description.positionTop"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до правой стороны:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complex_house_description.positionRight"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до низа:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complex_house_description.positionBottom"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Расстояние до левой стороны:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complex_house_description.positionLeft"
                                    type="number"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>

                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.addHouseApprove>
                                    Добавить дом
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postHouseForm')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="addHouseApprove" hide-header hide-footer centered>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button 
                                	variant="primary" 
                                	class="ml-2" 
                                	@click="
                                		postHouse(), 
                                		$bvModal.hide('addHouseApprove'), 
                                		$bvModal.hide('postHouseForm')
                            		"
                                >
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('addHouseApprove')">
                                    Назад
                                </b-button>
                            </b-row>
                        </b-modal>

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
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{infoModal.phone}},<br/> {{infoModal.address}}</div>
                                </li>
                            </ul>
                        </b-modal>

                        <!-- edit modal -->
                        <b-modal id="editForm" hide-header hide-footer centered>
                            <h2 class="panelName">
                                Редактирование объекта:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Название объекта:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="editModal.companyName"
                                    type="text"
                                    placeholder="ЖК мир"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="editModal.number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Адресс:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="editModal.address"
                                    type="text"
                                    placeholder="ул. А.Яссовий 39/10"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Электронная почта:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="editModal.email"
                                    type="text"
                                    placeholder="primer@gmail.com"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Выберете изоброжение:</div>
                                <!-- <input type="file" @change="onFileChangeTwo" /> -->
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file" 
                                            v-model="editModal.selectImg"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.editApprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('editForm')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="editApprove" hide-header hide-footer centered>
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Название объекта:</strong>
                                    <span class="model-itemData">{{editModal.companyName}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Электронная почта:</strong>
                                    <span class="model-itemData">{{editModal.email}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{editModal.number}},<br/> {{editModal.address}}</div>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Изоброжения:</strong>
                                    <div class="model-itemData">{{editModal.selectImg}}</div>
                                </li>
                            </ul>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="patchObject(), $bvModal.hide('editApprove'), $bvModal.hide('editForm')">
                                    Добавить изменения
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('editApprove')">
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
                        id: 1,
                        path: "/super_admin/add_developer",
                        name: 'Застройщики',
                        active: false
                    },
                    {
                        id: 2,
                        path: "/super_admin/edit_residential_complexes",
                        name: 'Жилые комплексы',
                        active: true
                    }
                ],
                fields: [
                    { key: 'residential_complex_value.name', label: 'Жилой комплекс', sortable: true },
                    { key: 'residential_complex_value.rating', label: 'Рейтинг', sortable: true, class: 'centerBlock' },
                    { key: 'residential_complex_value.number', label: 'Контакт', sortable: false, class: 'centerBlock' },
                    { key: 'information', label: 'Доп. информация', sortable: false, class: 'centerBlock' },
                    { key: 'houses', label: 'Ссылка на дома', sortable: false, class: 'centerBlock' },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
                ],
                fields_floors: [
                    { key: 'floor_number', label: 'Номер этажа', sortable: false },
                    { key: 'square', label: 'Площадь этажа', sortable: false, class: 'centerBlock' },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
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
                // axios
                residential_complex: [],
                residential_complex_value: [],
                // form
                idDeleteObj: null,
                idPatchObj: null,
                idPostHouse: null,
                residential_complex_id: null,
                r_c_house_id: null,
                residential_complex_houses: {
                	residential_complex_id: null,
                	svg: []
                },
                residential_complex_house_description: {
                    name: '',
                    text: '',
                    is_open: false,
                    positionTop: '',
                    positionRight: '',
                    positionBottom: '',
                    positionLeft: '',
                    residential_complex_house_id: ''
                },

                house: {
                    residential_complex_id: null,
                    svg: []
                },

                r_c_house_hovers: {
                    svg: [],
                    r_c_house_id: '',
                    r_c_house_description_id: '',
                    house_link_id: ''
                },

                appartment: {
                    image: [],
                    appartment_number: '',
                    square: '',
                    dascription: '',
                    phone_number: '',
                    price: '',
                    roomines: '',
                    veriety: '',
                    construction_start_date: '',
                    construction_finish_date: '',
                    floor_id: ''
                },

                form: {
                    companyName: '',
                    number: '',
                    address: '',
                    email: '',
                    selectImg: [],
                    marker_id: '1',
                    year_id: '1',
                    about_title: 'Заголовок',
                    about_description: 'Описание описание которое описываеться в описании',
                    comments_title: 'comments_title',
                    title: "Новосторйки в центре Киргили",
                    rating: "5",
                    advantages_title: "Наши приемущества"
                },
                hotLine: ''
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
            ])
        },
        mounted() {
            this.GET_FLOORS_FROM_API(),
            this.GET_RESIDENTIAL_COMPLEXES_FROM_API()
                .then(() => {
                    this.totalRows = this.RESIDENTIAL_COMPLEXES.length
                })
        },
        methods: {
        	...mapActions('dataBase/residential_complexes', [
                'GET_RESIDENTIAL_COMPLEXES_FROM_API'
            ]),
            ...mapActions('dataBase/floors', [
                'GET_FLOORS_FROM_API'
            ]),
            info(item, index, button) {
                this.infoModal.title = `${item.residential_complex_value.name}`
                this.infoModal.rating = `${item.residential_complex_value.rating}`
                this.infoModal.phone = `${item.residential_complex_value.number}`
                this.infoModal.address = `${item.residential_complex_value.address}`
                // this.infoModal.history = `${item.residential_complex_value.history}`
                // this.infoModal.machinery = `${item.residential_complex_value.machinery}`
                // this.infoModal.foundationDate = `${item.residential_complex_value.foundationDate}`
                // this.infoModal.numberWorkers = `${item.residential_complex_value.numberWorkers}`
                // this.infoModal.constructedObjects = `${item.residential_complex_value.constructedObjects}`
                this.infoModal.comapanyName = `${item.residential_complex_value.name}`
                // this.infoModal.foreman = `${item.residential_complex_value.foreman}`
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
            edit(item, index, button) {
                this.editModal.companyName = `${item.residential_complex_value.name}`
                this.editModal.number = `${item.residential_complex_value.number}`
                this.editModal.address = `${item.residential_complex_value.address}`
                this.editModal.email = `${item.residential_complex_value.email}`
                this.editModal.selectImg = `${item.residential_complex_value.image}`
                this.editModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.editModal.id, button)
            },

            // axios
            async postHouse() {
            	const formData = new FormData();

                formData.append("svg", this.house.svg, this.house.svg.name);
                formData.append("residential_complex_id", this.residential_complex_id);

                this.$axios.$post('/api/houses', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.r_c_house_hovers.house_link_id = response.id;
                    this.postHouseDiscription();
                })
            },
            async postHouseExcretion() {
                const formData = new FormData();

                formData.append("svg", this.r_c_house_hovers.svg, this.r_c_house_hovers.svg.name);

                formData.append("r_c_house_id", this.r_c_house_id);
                formData.append("r_c_house_description_id", this.residential_complex_id);
                formData.append("house_link_id", this.residential_complex_id);

                this.$axios.$post('/api/r_c_house_hovers', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },
            async postHouseDiscription() {
                const formData = new FormData();

                formData.append("name", this.residential_complex_house_description.name);
                formData.append("text", this.residential_complex_house_description.text);

                formData.append("is_open", this.residential_complex_house_description.is_open);

                formData.append("positionTop", this.residential_complex_house_description.positionTop);
                formData.append("positionRight", this.residential_complex_house_description.positionRight);
                formData.append("positionBottom", this.residential_complex_house_description.positionBottom);
                formData.append("positionLeft", this.residential_complex_house_description.positionLeft);

                formData.append("residential_complex_house_id", this.r_c_house_id);

                this.$axios.$post('/api/residential_house_descriptions', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.r_c_house_hovers.r_c_house_description_id = response.id;
                    if (response.created_at) {
                        this.residential_complex_house_description.name = '';
                        this.residential_complex_house_description.text = '';
                        this.residential_complex_house_description.positionTop = '';
                        this.residential_complex_house_description.positionRight = '';
                        this.residential_complex_house_description.positionBottom = '';
                        this.residential_complex_house_description.positionLeft = '';

                        this.GET_RESIDENTIAL_COMPLEXES_FROM_API();
                        this.postHouseExcretion();
                    }
                })
            },
            async patchObject() {
                const formData = new FormData();
                formData.append("image", this.editModal.selectImg, this.editModal.selectImg.name);

                formData.append("name", this.editModal.companyName);
                formData.append("title", this.form.title);
                formData.append("rating", this.form.rating);
                formData.append("number", this.editModal.number);
                formData.append("address", this.editModal.address);
                formData.append("email", this.editModal.email);
                formData.append("about_title", this.form.about_title);
                formData.append("about_description", this.form.about_description);
                formData.append("advantages_title", this.form.advantages_title);
                formData.append("comments_title", this.form.comments_title);
                formData.append("marker_id", this.form.marker_id);
                formData.append("year_id", this.form.year_id);

                this.$axios.$patch(`/api/residential_complexes/${this.idPatchObj}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        this.editModal.comapanyName = '';
                        this.editModal.number = '';
                        this.editModal.address = '';
                        this.editModal.email = '';

                        // this.$notify({
                        //     group: 'admin-notification',
                        //     title: 'Post successfully created',
                        //     type: 'success'
                        // });
                        this.GET_RESIDENTIAL_COMPLEXES_FROM_API();
                    }
                })
            },
            async deleteObject() {
                await this.$axios.delete(`/api/residential_complexes/${this.idDeleteObj}`).then(response => {
                    // this.$notify({
                    //     group: 'admin-notification',
                    //     title: 'Product was deleted',
                    //     type: 'success'
                    // });
                    this.GET_RESIDENTIAL_COMPLEXES_FROM_API();
                });
            }
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