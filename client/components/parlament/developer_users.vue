<template>
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
                        <div style="cursor: pointer" @click="active = !active">{{row.value}}</div>
                    </template>

                    
                </b-table>

                <b-col>
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="center"

                    ></b-pagination>
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
            <div class="dev__wood text-center" :class="{active:active}">
                <h6 class="dev__woodTitle main__title">Объекты застройщика</h6>
                <div class="dev__woodBody text-center">
                    <b-row class="dev__woodYear position-relative align-items-center justify-content-center" v-for="object in objects" :key="object.year">
                        <div class="dev__arrowYear position-absolute left-50">
                            <img src="@/assets/images/svg/arrayYear.svg"/>
                        </div>
                        <div class="dev__woodObjects item position-absolute top-50">
                            <nuxt-link to="/developers/developer/object" class="dev__objectItem text-decoration-none"  v-for="item in object.data" :key="item.id">
                                <img :src="require(`@/assets/images/png/${item.image}`)">
                                <div class="dev__woodDevNameBox">
                                    <div class="dev__woodDevName rounded maint__text">{{item.name}}</div>
                                </div>
                            </nuxt-link>
                        </div>
                        <div class="dev__woodDate item">{{object.year}}</div>
                    </b-row>
                </div>
            </div>
        </div>
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
                objects: [
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
                    { name: 'Давид', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Иван', rating: 4, phone: '+998 99 985 45 65', history: '2016-2024' },
                    { name: 'Илья', rating: 3, phone: '+998 95 943 56 72', history: '2016-2024' },
                    { name: 'Ким', rating: 5, phone: '+998 95 847 34 23', history: '2016-2024' },
                    { name: 'Карим', rating: 3, phone: '+998 90 987 43 21', history: '2016-2024' },
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
                    { name: 'Golden House', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Иван', rating: 4, phone: '+998 99 985 45 65', history: '2016-2024' },
                    { name: 'Илья', rating: 3, phone: '+998 95 943 56 72', history: '2016-2024' },
                    { name: 'Ким', rating: 5, phone: '+998 95 847 34 23', history: '2016-2024' },
                    { name: 'Карим', rating: 3, phone: '+998 90 987 43 21', history: '2016-2024' },
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
                    { name: 'Golden House', rating: 5, phone: '+998 90 987 43 21', history: '2016-2024' },
                    { name: 'Иван', rating: 4, phone: '+998 99 985 45 65', history: '2016-2024' },
                    { name: 'Илья', rating: 3, phone: '+998 95 943 56 72', history: '2016-2024' },
                    { name: 'Ким', rating: 5, phone: '+998 95 847 34 23', history: '2016-2024' },
                    { name: 'Карим', rating: 3, phone: '+998 90 987 43 21', history: '2016-2024' },
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
                pageOptions: [5, 10, 100],
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
    .dev__wood {
        margin: 50px auto 67px; 
        max-width: 1280px;
        width: 100%;
        display: none;
        opacity: 0;
        transition: 1s;
    }
    .dev__wood.active {
        display: block;
        opacity: 1;
        transition: 0.5s;
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