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
                        <b-row class="align-items-center mb-4 pt-3 pl-3">
                            <span>Добавить Застройщика: </span>
                            <b-button variant="primary" class="ml-2"  @click="$bvModal.show('post')">
                                <b-icon-plus variant="light"></b-icon-plus>
                            </b-button>
                        </b-row>
                        <b-modal id="post" hide-header="true" hide-footer="true" centered>
                            <h2 class="panelName">
                                Добовление данных застройщика:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Имя застройщика:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.developerName"
                                    type="text"
                                    placeholder="Имя"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон застройщика:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Адресс офиса:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.company_address"
                                    type="text"
                                    placeholder="ул. А.Яссовий 39/10"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Дата основания:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.company_foundation_date"
                                    type="text"
                                    placeholder="12.03.2020"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Количство рабочих:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.count_workers"
                                    type="text"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Количство рабочей техники:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.count_machinery"
                                    type="text"
                                    placeholder="1000"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <form ref="formData">
                                <b-form-group            
                                    id="input"
                                >
                                    <b-form-file 
                                        id="input-file" 
                                        v-model="form.selectLogo"
                                    ></b-form-file>
                                </b-form-group>
                            </form>

                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.postApprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('post')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="postApprove" hide-header hide-footer centered>
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Имя застройщика:</strong>
                                    <span class="model-itemData">{{form.developerName}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Дата основания:</strong>
                                    <span class="model-itemData">{{form.company_foundation_date}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{form.number}},<br/> {{form.company_address}}</div>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количство рабочих:</strong>
                                    <span class="model-itemData">{{form.count_workers}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Количство рабочей техники:</strong>
                                    <div class="model-itemData">{{form.count_machinery}}</div>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Изоброжения:</strong>
                                    <div class="model-itemData">{{form.selectLogo}}</div>
                                </li>
                            </ul>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="postCompany(), $bvModal.hide('postApprove'), $bvModal.hide('post')">
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postApprove')">
                                    Назад
                                </b-button>
                            </b-row>
                        </b-modal>

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
                            :items="developers"
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

                            <template #cell(edit)="row">
                                <b-button variant="primary" @click="$bvModal.show('postObject'), form.developer_id=row.item.developer_value.id">
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <b-button variant="success" @click="$bvModal.show('editForm'), idPatchCompany=row.item.developer_value.id, edit(row.item, row.index, $event.target)">
                                    <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                </b-button>
                                <b-button variant="primary" @click="$bvModal.show('deleteComp'), idDeleteCompany=row.item.developer_value.id">
                                    <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                </b-button>
                            </template>
                        </b-table>

                        <!-- add object modal -->
                        <b-modal id="postObject" hide-header="true" hide-footer="true" centered>
                            <h2 class="panelName">
                                Добовление объекта:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Название объекта:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.companyName"
                                    type="text"
                                    placeholder="ЖК Мир"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Адресс офиса:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.address"
                                    type="text"
                                    placeholder="ул. А.Яссовий 39/10"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Электронная почта:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="form.email"
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
                                                v-model="form.selectLogo"
                                            ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.postObjectApprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postObject')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="postObjectApprove" hide-header hide-footer centered>
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Имя застройщика:</strong>
                                    <span class="model-itemData">{{form.companyName}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Электронная почта:</strong>
                                    <span class="model-itemData">{{form.email}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{form.number}},<br/> {{form.address}}</div>
                                </li>
                            </ul>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="postObject(), $bvModal.hide('postObjectApprove'), $bvModal.hide('postObject')">
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postObjectApprove')">
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
                                <!-- <li class="model-item">
                                    <strong class="model-itemName">Дата основания:</strong>
                                    <span class="model-itemData">{{infoModal.foundationDate}}</span>
                                </li> -->
                                <!-- <li class="model-item">
                                    <strong class="model-itemName">Количество техники:</strong>
                                    <span class="model-itemData">{{infoModal.machinery}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Количество рабочих:</strong>
                                    <span class="model-itemData">{{infoModal.numberWorkers}}</span>
                                </li> -->
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Контакты:</strong>
                                    <div class="model-itemData">{{infoModal.phone}},<br/> {{infoModal.address}}</div>
                                </li>
                            </ul>
                        </b-modal>

                        <!-- edit modal -->
                        <b-modal id="editForm" hide-header="true" hide-footer="true" centered>
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
                                                v-model="editModal.selectLogo"
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
                                    <div class="model-itemData">{{editModal.selectLogo}}</div>
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
                        <b-modal id="deleteComp" hide-header="true" hide-footer="true" centered>
                            <h1>Вы уверены что хотите удалить объект?</h1>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="deleteCompany(), $bvModal.hide('deleteComp')">
                                    Удалить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('deleteComp')">
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
                        path: "/super_admin/add_company",
                        name: 'Застройщики',
                        active: true
                    },
                    {
                        id: 2,
                        path: "/super_admin/edit_object",
                        name: 'Жилые комплексы',
                        active: false
                    }
                ],
                dataTables: [
                    {
                        comapanyName: 'Anol Group',//Название компании
                        rating: 5, //рейтинг
                        phone: '+998 90 987 43 21',//номер телефона 
                        address: 'А.Яссавий 36/5',//адресс офиса застройщика
                        historyWood: [
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
                        history: '2018-2020',
                        machinery: 5,//количество техники
                        foundationDate: 2005,//дата основания компании
                        numberWorkers: 5,//количество рабочих
                        constructedObjects: 6,//количество построенных объектов
                        foreman: 'Захридин'//имя застройщика
                    },{
                        comapanyName: 'Stroy Company',//Название компании
                        rating: 3, //рейтинг
                        phone: '+998 95 456 34 09',//номер телефона 
                        address: 'Кадыри 10.7',//адресс офиса застройщика
                        historyWood: [
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
                        ],//дерево истории застроек
                        history: '2018-2019',
                        machinery: 100,//количество техники
                        foundationDate: 2003,//дата основания компании
                        numberWorkers: 1000,//количество рабочих
                        constructedObjects: 12,//количество построенных объектов
                        foreman: 'Бобур'//имя застройщика
                    }
                ],
                fields: [
                    { key: 'developer_value.name', label: 'Имя', sortable: true },
                    { key: 'developer_value.rating', label: 'Рейтинг', sortable: true, class: 'centerBlock' },
                    { key: 'developer_value.number', label: 'Номер', sortable: false, class: 'centerBlock' },
                    { key: 'information', label: 'Доп. информация', sortable: false, class: 'centerBlock' },
                    { key: 'developer_value.history', label: 'История', sortable: false, class: 'centerBlock' },
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
                developers: [],
                developer_value: [],
                // form
                idDeleteCompany: null,
                idPatchCompany: null,
                idPostObject: null,
                form: {
                    // object
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
                    advantages_title: "Наши приемущества",
                    construction_start_date: "20.12.2017",
                    construction_finish_date: "20.12.2022",
                    developer_id: "1",

                    // developer
                    developerName: '',
                    selectLogo: [],
                    company_name: 'assdassd',
                    rating_votes: '5',
                    company_number: '+998 (90) 456-56-67',
                    company_history: '2019-2021',
                    company_foundation_date: '',
                    company_address: '',
                    company_website: 'www.site.com',
                    company_about_title: 'company_about_title',
                    company_about_text: 'company_about_text',
                    count_workers: '1000',
                    count_machinery: '1000',
                    count_objects: '10',
                    count_constructed_objects: '100',
                    count_under_constructed_objects: '200',
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
            this.loadCompanies();
        },
        methods: {
            info(item, index, button) {
                this.infoModal.title = `${item.developer_value.name}`
                this.infoModal.rating = `${item.developer_value.rating}`
                this.infoModal.phone = `${item.developer_value.number}`
                this.infoModal.address = `${item.developer_value.company_address}`
                // this.infoModal.history = `${item.developer_value.history}`
                // this.infoModal.machinery = `${item.developer_value.machinery}`
                // this.infoModal.foundationDate = `${item.developer_value.foundationDate}`
                // this.infoModal.numberWorkers = `${item.developer_value.numberWorkers}`
                // this.infoModal.constructedObjects = `${item.developer_value.constructedObjects}`
                this.infoModal.comapanyName = `${item.developer_value.name}`
                // this.infoModal.foreman = `${item.developer_value.foreman}`
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
                this.editModal.companyName = `${item.developer_value.name}`
                this.editModal.number = `${item.developer_value.number}`
                this.editModal.address = `${item.developer_value.address}`
                this.editModal.email = `${item.developer_value.email}`
                this.editModal.selectLogo = `${item.developer_value.image}`
                this.editModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.editModal.id, button)
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            // axios
            async loadCompanies() {
                axios
                    .get('http://213.230.96.125/api/developers')
                    .then(response => {
                        this.developers = response.data; 
                    })
                    .then(response => {
                        // this.allCompany();
                        // this.allObjects();
                        let data = this.developers;
                        data.forEach(item => {
                            this.developer_value.push(item.developer_value);
                        })
                        console.log(this.developer_value);
                    })
                    .then(() => {
                        this.totalRows = this.developers.length
                    })
            },
            async postCompany() {
                const formData = new FormData();

                formData.append("logo", this.form.selectLogo, this.form.selectLogo.name);

                formData.append("name", this.form.developerName);
                formData.append("number", this.form.number);
                formData.append("rating", this.form.rating);
                formData.append("rating_votes", this.form.rating_votes);
                formData.append("company_name", this.form.company_name);
                formData.append("company_number", this.form.company_number);
                formData.append("company_history", this.form.company_history);
                formData.append("company_foundation_date", this.form.company_foundation_date);
                formData.append("company_address", this.form.company_address);
                formData.append("company_website", this.form.company_website);
                formData.append("company_about_title", this.form.company_about_title);
                formData.append("company_about_text", this.form.company_about_text);
                formData.append("count_workers", this.form.count_workers);
                formData.append("count_machinery", this.form.count_machinery);
                formData.append("count_objects", this.form.count_objects);
                formData.append("count_constructed_objects", this.form.count_constructed_objects);
                formData.append("count_under_constructed_objects", this.form.count_under_constructed_objects);

                this.$axios.$post('/api/developers', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        console.log(this.form.selectLogo);

                        this.form.comapanyName = '';
                        this.form.number = '';
                        this.form.address = '';
                        this.form.email = '';
                        this.form.developerName = '';
                        this.form.company_number = '';
                        this.form.company_foundation_date = '';
                        this.form.company_address = '';

                        this.loadCompanies();
                        // this.$notify({
                        //     group: 'admin-notification',
                        //     title: 'Post successfully created',
                        //     type: 'success'
                        // });
                    }
                })
            },
            async patchCompany() {
                const formData = new FormData();
                formData.append("image", this.editModal.selectLogo, this.editModal.selectLogo.name);

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

                this.$axios.$patch(`/api/developers/${this.idPatchCompany}`, formData, {
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
                    }
                })
                console.log(this.idPatchCompany);
            },
            async deleteCompany() {
                console.log(this.idDeleteCompany);
                await this.$axios.delete(`/api/developers/${this.idDeleteCompany}`).then(response => {
                    // this.$notify({
                    //     group: 'admin-notification',
                    //     title: 'Product was deleted',
                    //     type: 'success'
                    // });
                    this.loadCompanies();
                });
            },
            async postObject() {
                const formData = new FormData();
                formData.append("image", this.form.selectLogo, this.form.selectLogo.name);

                formData.append("name", this.form.companyName);
                formData.append("title", this.form.title);
                formData.append("rating", this.form.rating);
                formData.append("number", this.form.number);
                formData.append("address", this.form.address);
                formData.append("email", this.form.email);
                formData.append("about_title", this.form.about_title);
                formData.append("about_description", this.form.about_description);
                formData.append("advantages_title", this.form.advantages_title);
                formData.append("comments_title", this.form.comments_title);
                formData.append("marker_id", this.form.marker_id);
                formData.append("year_id", this.form.year_id);
                formData.append("count_workers", this.form.count_workers);
                formData.append("count_machinery", this.form.count_machinery);
                formData.append("construction_start_date", this.form.construction_start_date);
                formData.append("construction_finish_date", this.form.construction_finish_date);
                formData.append("developer_id", this.form.developer_id);

                this.$axios.$post('/api/residential_complexes', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        this.form.comapanyName = '';
                        this.form.number = '';
                        this.form.address = '';
                        this.form.email = '';

                        this.loadCompanies();
                        // this.$notify({
                        //     group: 'admin-notification',
                        //     title: 'Post successfully created',
                        //     type: 'success'
                        // });
                    }
                })
            },
            // form
            onFileChange(e) {
                console.log(this.form.selectLogo);
                // const file = this.form.selectLogo;
                // this.url = URL.createObjectURL(file);
                // this.form.previewImg.push({
                //     name: this.url,
                //     id: Math.floor(Math.random() * Math.floor(1000))
                // });
                console.log('выбранный файл:' + this.form.selectLogo, 'Превью:' + this.form.previewImg);
            },
            onFileChangeTwo(e) {
                console.log(e.target.files);
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
                this.form.previewImg.push({
                    name: this.url,
                    id: Math.floor(Math.random() * Math.floor(1000))
                });
            },
            daleteImage(id) {
                let arr = this.form.selectLogo;
                arr.forEach(item => {
                    // item.id == id ?  : console.log('false');
                    if (item.id == id) {
                        const index =  arr.indexOf(item);
                        let removed = arr.splice(index, 1);
                        // var myFish = ['angel', 'clown', 'mandarin', 'sturgeon'];
                        // var removed = myFish.splice(1, 1);
                        // console.log(myFish);
                    }
                })
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