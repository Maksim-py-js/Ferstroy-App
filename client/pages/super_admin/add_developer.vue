<template>
    <div class="h-panel">
        <div class="background-filter"></div>  
        <b-navbar class="panel-top p-0 mb-4">
            <b-navbar-nav class="align-items-center justify-content-between w-100 full-bar">
                <!-- <b-breadcr/umb variant="transparent" :items="bredcrumbsItems" class="custom-breadcrumbs mb-0 bg-transparent text-light"></b-breadcrumb> -->
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
                            <b-button variant="primary" class="ml-2"  @click="$bvModal.show('postDeveloperForm')">
                                <b-icon-plus variant="light"></b-icon-plus>
                            </b-button>
                        </b-row>
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
                                <div style="cursor: pointer" @click="row.toggleDetails">2020-20205</div>
                            </template>

                            <template #row-details="row">
                                <b-button size="sm" class="close_history" @click="row.toggleDetails">
                                    <img src="@/assets/images/svg/close.svg" alt="close">
                                </b-button>
                                <div class="woodBox">
                                    <Wood :objects="row.item"/>
                                </div>
                            </template>

                            <template #cell(edit)="row">
                                <b-button 
                                    variant="primary" 
                                    @click="
                                        $bvModal.show('postResidentialComplexesForm'), 
                                        residential_complexes.developer_id=row.item.developer_value.id,
                                        hotNumber = row.item.developer_value.company_number
                                    "
                                >
                                    <b-icon-plus variant="light"></b-icon-plus>
                                </b-button>
                                <b-button 
                                    variant="success" 
                                    title="Редактировать данные компании"
                                    @click="
                                        $bvModal.show('editForm'), 
                                        idPatchCompany=row.item.developer_value.id, 
                                        edit(row.item, row.index, $event.target)
                                    "
                                >
                                    <b-icon-pencil-fill variant="light"></b-icon-pencil-fill>
                                </b-button>
                                <b-button 
                                    variant="primary" 
                                    @click="
                                        $bvModal.show('deleteComp'), 
                                        idDeleteCompany=row.item.developer_value.id
                                    "
                                >
                                    <b-icon-backspace-fill variant="light"></b-icon-backspace-fill>
                                </b-button>
                            </template>
                        </b-table>

                        <!-- developers add modals -->
                        <b-modal id="postDeveloperForm" hide-header="true" hide-footer="true" centered>
                            <h2 class="panelName">
                                Добовление данных компании:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Название компании:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.company_name"
                                    type="text"
                                    placeholder="Имя"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Имя застройщика:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.name"
                                    type="text"
                                    placeholder="Имя"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон застройщика:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон компании:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.company_number"
                                    type="text"
                                    placeholder="+998 (90) 999-99-99"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Адресс офиса:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.company_address"
                                    type="text"
                                    placeholder="ул. А.Яссовий 39/10"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Дата основания компании:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.company_foundation_date"
                                    type="text"
                                    placeholder="12.03.2020"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Общее количство рабочих:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.count_workers"
                                    type="text"
                                    placeholder="100"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Общее количство рабочей техники:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="developer.count_machinery"
                                    type="text"
                                    placeholder="1000"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Выберите логотип:</div>
                                <form ref="formData">
                                    <b-form-group            
                                        id="input"
                                    >
                                        <b-form-file 
                                            id="input-file" 
                                            v-model="developer.logo"
                                        ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>

                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.postDeveloperAprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postDeveloperForm')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="postDeveloperAprove" hide-header hide-footer centered>
                            <ul class="model-data">
                                <li class="model-item">
                                    <strong class="model-itemName">Название компании:</strong>
                                    <span class="model-itemData">{{developer.company_name}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Дата основания компании:</strong>
                                    <span class="model-itemData">{{developer.company_foundation_date}}</span>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName mr-1">"Контакты компании"</strong>
                                    <div class="model-itemData">
                                        <div>*---------------------------------------*</div>
                                        <div>
                                            <strong>Номер компании:</strong>
                                            <span>{{developer.company_number}}</span>
                                        </div>
                                        <div>
                                            <strong>Адресс офиса:</strong>
                                            <span>{{developer.company_address}}</span>
                                        </div>
                                        <div>*---------------------------------------*</div>
                                        <div>
                                            <strong>Имя застройщика:</strong>
                                            <span>{{developer.name}}</span>
                                        </div>
                                        <div>
                                            <strong>Номер застройщика:</strong>
                                            <span>{{developer.number}}</span>
                                        </div>
                                        <div>*---------------------------------------*</div>
                                    </div>
                                </li>
                                <li class="model-item">
                                    <strong class="model-itemName">Общее количство рабочих:</strong>
                                    <span class="model-itemData">{{developer.count_workers}}</span>
                                </li>
                                <li class="model-item d-flex">
                                    <strong class="model-itemName mr-1">Общее количство рабочей техники:</strong>
                                    <div class="model-itemData">{{developer.count_machinery}}</div>
                                </li>
                            </ul>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="postDeveloper(), $bvModal.hide('postDeveloperAprove'), $bvModal.hide('postDeveloperForm')">
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postDeveloperAprove')">
                                    Назад
                                </b-button>
                            </b-row>
                        </b-modal>

                        <!-- add residential_complexes modals -->
                        <b-modal id="postResidentialComplexesForm" hide-header="true" hide-footer="true" centered>
                            <h2 class="panelName">
                                Добовление ЖК:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Название ЖК:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complexes.name"
                                    type="text"
                                    placeholder="ЖК Мир"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Телефон для оброщения:</div>
                                <div>
                                    <b-form-input
                                        @change="hotLine = 'false'"
                                        id="filter-input"
                                        v-model="residential_complexes.number"
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
                                <div class="label">Местонохождение объекта:</div>
                                <div class="map">
                                    <no-ssr>
                                        <yandex-map
                                            :coords="coords"
                                            :zoom="10"
                                            style="height: 300px"
                                            @click="onClick"
                                        >
                                            <ymap-marker
                                                marker-id="123"
                                                :coords="coords"
                                                :icon="markerIcon"
                                                class="mapMarker"
                                            />
                                        </yandex-map>
                                    </no-ssr>
                                </div>
                            </div>
                            <div class="dataItem">
                                <div class="label">Электронная почта:</div>
                                <b-form-input
                                    id="filter-input"
                                    v-model="residential_complexes.email"
                                    type="text"
                                    placeholder="primer@gmail.com"
                                    class="searchBar__input br-0"
                                ></b-form-input>
                            </div>
                            <div class="dataItem">
                                <div class="label">Дата постройки:</div>
                                <b-col md="auto" class="p-0">
                                    <b-form-input
                                        id="filter-input"
                                        v-model="date.year"
                                        type="number"
                                        placeholder="2021"
                                        class="searchBar__input br-0"
                                    ></b-form-input>
                                </b-col>
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
                                                v-model="residential_complexes.image"
                                            ></b-form-file>
                                    </b-form-group>
                                </form>
                            </div>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" v-b-modal.postResidentialComplexesApprove>
                                    Подтвердить!
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postResidentialComplexesForm')">
                                    Отмена
                                </b-button>
                            </b-row>
                        </b-modal>
                        <b-modal id="postResidentialComplexesApprove" hide-header hide-footer centered>
                            <ul class="model-data">
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
                            </ul>
                            <b-row class="align-items-center pl-3 mt-4">
                                <b-button variant="primary" class="ml-2" @click="postDate(), $bvModal.hide('postResidentialComplexesApprove'), $bvModal.hide('postResidentialComplexesForm')">
                                    Добавить
                                </b-button>
                                <b-button class="ml-4" @click="$bvModal.hide('postResidentialComplexesApprove')">
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

                        <!-- edit modals -->
                        <b-modal id="editForm" hide-header="true" hide-footer="true" centered>
                            <h2 class="panelName">
                                Редактирование объекта:
                            </h2>
                            <div class="dataItem">
                                <div class="label">Название жк:</div>
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
                        active: true
                    },
                    {
                        id: 2,
                        path: "/super_admin/edit_residential_complexes",
                        name: 'Жилые комплексы',
                        active: false
                    }
                ],
                fields: [
                    { key: 'developer_value.name', label: 'Имя', sortable: true },
                    { key: 'developer_value.rating', label: 'Рейтинг', sortable: true, class: 'centerBlock' },
                    { key: 'developer_value.number', label: 'Номер', sortable: false, class: 'centerBlock' },
                    { key: 'information', label: 'Доп. информация', sortable: false, class: 'centerBlock' },
                    { key: 'years', label: 'История', sortable: false, class: 'centerBlock' },
                    { key: 'edit', label: 'Редактирование', sortable: false, class: 'centerBlock' }
                ],
                // tables options begin
                totalRows: 100,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 20],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                // tables options end
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
                // developer_value: [],
                // hover on house
                houses_hover: [],
                // form
                hotLine: false,
                hotNumber: '',
                idDeleteCompany: null,
                idPatchCompany: null,
                idPostObject: null,
                value: '',
                coords: [40.385245, 71.786176],
                context: null,
                dateId: '',
                addObjectAct: false,
                markerIcon: {
                    layout: 'default#imageWithContent',
                    imageHref: ``,
                    imageSize: [89, 113],
                    imageOffset: [-40, -110],
                    content: '',
                    contentOffset: [0, 0],
                    contentLayout: '<div class="marksItem"><svg width="89" height="114" viewBox="0 0 89 114" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M66.1622 67.2483C50.6719 59.392 34.1273 60.7714 29.2829 70.3232C27.3658 74.1032 27.4804 78.6769 29.6201 83.5506L41.6343 111.317C41.665 111.385 41.7361 111.441 41.7748 111.508C42.4647 112.719 44.049 113.306 45.0962 113.073C53.5679 111.187 69.1827 107.558 75.1525 106.23C75.1525 106.23 75.1553 106.228 75.1576 106.227L75.1944 106.219C80.08 105 83.6326 102.442 85.4696 98.8198C90.314 89.2681 81.6524 75.1046 66.1622 67.2483Z" fill="url(#paint0_linear)"/><path d="M44.5 0C19.9634 0 0 19.3071 0 43.0371C0 52.428 3.06708 61.3511 8.87718 68.8373L41.757 111.665C41.8391 111.769 41.9646 111.808 42.0559 111.901C43.699 113.603 46.0701 113.175 47.2407 111.665C56.709 99.4468 74.064 76.6281 80.7367 68.0207C80.7367 68.0207 80.739 68.0141 80.7413 68.0097L80.7823 67.9567C86.1588 60.6514 89 52.0352 89 43.0371C89 19.3071 69.0366 0 44.5 0ZM44.5 66.2551C31.2892 66.2551 20.4928 55.8136 20.4928 43.0371C20.4928 30.2606 31.2892 19.8191 44.5 19.8191C57.7108 19.8191 68.5072 30.2606 68.5072 43.0371C68.5072 55.8136 57.7108 66.2551 44.5 66.2551Z" fill="#77C85B"/><defs><linearGradient id="paint0_linear" x1="66.1622" y1="67.2483" x2="43.0934" y2="112.733" gradientUnits="userSpaceOnUse"><stop offset="0.34375" stop-opacity="0"/><stop offset="1" stop-opacity="0.28"/></linearGradient></defs></svg></div>'
                },
                residential_complexes: {
                    image: [],
                    name: "ЖК мир",
                    title: "Новосторйки в центре Киргили",
                    rating: "5",
                    number: "",
                    address: "ул.Фароби",
                    email: "test@gmail.com",
                    about_title: "Заголовок",
                    about_description: "Описание описание которое описываеться в описании",
                    advantages_title: "Наши приемущества",
                    comments_title: "comments_title",
                    count_workers: "1000",
                    count_machinery: "1000",
                    construction_start_date: "20.12.2017",
                    construction_finish_date: "20.12.2022",
                    marker_id: "1",
                    year_id: "1",
                    developer_id: "1"
                },
                marker: {
                    markerX: '',
                    markerY: '',
                    image: ''
                },
                date: {
                    year: ''
                },
                developer: {
                    logo: [],
                    name: "Николай",
                    number: "+998 (76) 654-56-67",
                    rating: "5",
                    rating_votes: "5",
                    company_name: "Imperoya Group",
                    company_number: "+998 (90) 456-56-67",
                    company_history: "2019-2021",
                    company_foundation_date: "12.03.2020",
                    company_address: "ул.Яссавий 34/6",
                    company_website: "www.site.com",
                    company_about_title: "company_about_title",
                    company_about_text: "company_about_text",
                    count_workers: "1000",
                    count_machinery: "1000",
                    count_objects: "10",
                    count_constructed_objects: "100",
                    count_under_constructed_objects: "200"
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
            ]),
            ...mapGetters('dataBase/years', [
                'YEARS'
            ]),
            ...mapGetters('dataBase/markers', [
                'MARKERS'
            ])
        },
        mounted() {
            this.GET_DEVELOPERS_FROM_API()
                .then(() => {
                    this.totalRows = this.DEVELOPERS.length
                });
        },
        methods: {
            ...mapActions('dataBase/developers', [
                'GET_DEVELOPERS_FROM_API'
            ]),
            ...mapActions('dataBase/years', [
                'GET_YEARS_FROM_API'
            ]),
            ...mapActions('dataBase/markers', [
                'GET_MARKERS_FROM_API'
            ]),
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
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            // axios
            
            async postDeveloper() {
                const formData = new FormData();

                formData.append("logo", this.developer.logo, this.developer.logo.name);

                formData.append("name", this.developer.name);
                formData.append("number", this.developer.number);
                formData.append("rating", this.developer.rating);
                formData.append("rating_votes", this.developer.rating_votes);
                formData.append("company_name", this.developer.company_name);
                formData.append("company_number", this.developer.company_number);
                formData.append("company_history", this.developer.company_history);
                formData.append("company_foundation_date", this.developer.company_foundation_date);
                formData.append("company_address", this.developer.company_address);
                formData.append("company_website", this.developer.company_website);
                formData.append("company_about_title", this.developer.company_about_title);
                formData.append("company_about_text", this.developer.company_about_text);
                formData.append("count_workers", this.developer.count_workers);
                formData.append("count_machinery", this.developer.count_machinery);
                formData.append("count_objects", this.developer.count_objects);
                formData.append("count_constructed_objects", this.developer.count_constructed_objects);
                formData.append("count_under_constructed_objects", this.developer.count_under_constructed_objects);

                this.$axios.$post('/api/developers', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {

                        this.developer.name = '';
                        this.developer.number = '';
                        this.developer.company_name = ''
                        this.developer.company_number = ''
                        this.developer.company_foundation_date = '';
                        this.developer.company_address = '';
                        this.developer.company_number = '';
                        this.developer.company_address = '';

                        this.GET_DEVELOPERS_FROM_API();
                    }
                })
            },
            async patchCompany() {},
            async deleteCompany() {
                await this.$axios.delete(`/api/developers/${this.idDeleteCompany}`).then(response => {
                    this.GET_DEVELOPERS_FROM_API();
                });
            },
            async postResidentialComplexes() {
                const formData = new FormData();
                formData.append("image", this.residential_complexes.image, this.residential_complexes.image.name);

                formData.append("name", this.residential_complexes.name);
                formData.append("title", this.residential_complexes.title);
                formData.append("rating", this.residential_complexes.rating);
                formData.append("number", this.residential_complexes.number);
                formData.append("address", this.residential_complexes.address);
                formData.append("email", this.residential_complexes.email);
                formData.append("about_title", this.residential_complexes.about_title);
                formData.append("about_description", this.residential_complexes.about_description);
                formData.append("advantages_title", this.residential_complexes.advantages_title);
                formData.append("comments_title", this.residential_complexes.comments_title);
                formData.append("marker_id", this.residential_complexes.marker_id);
                formData.append("year_id", this.dateId);
                formData.append("count_workers", this.residential_complexes.count_workers);
                formData.append("count_machinery", this.residential_complexes.count_machinery);
                formData.append("construction_start_date", this.residential_complexes.construction_start_date);
                formData.append("construction_finish_date", this.residential_complexes.construction_finish_date);
                formData.append("developer_id", this.residential_complexes.developer_id);

                this.$axios.$post('/api/residential_complexes', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.created_at) {
                        this.residential_complexes.name = '';
                        this.residential_complexes.number = '';
                        this.residential_complexes.email = '';
                        this.residential_complexes.year = '';

                        this.hotLine = false;
                    }
                })
            },
            async postDate() {
                this.GET_YEARS_FROM_API()
                    .then(() => {
                        let array = this.YEARS.sort((a, b) => a.year_value.name.localeCompare(b.year_value.name)), //отсортированный массив
                            resultSearch = this.search(array.sort(), this.date.year); //результата поиска

                        if (resultSearch) { //если год найден
                            this.dateId = resultSearch; //записать id года
                            this.addObjectAct = true; //объявить что год добавлен
                        }
                    })
                    .then(() => {
                        if (this.addObjectAct) {
                            this.addObjectAct = false;
                            return this.postMarker(); //выйти из рекурсии
                        } 
                        // если год не найден добавть год
                        if (this.dateId == '') {
                            const formData = new FormData();
                            formData.append("name", this.date.year);

                            this.$axios.$post('/api/years', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(response => {
                                if (response.created_at) {
                                    this.postDate();//вход в рекурсию
                                }
                            })
                        }
                    })
            },
            async postMarker() {
                this.marker.markerX = this.coords[0];
                this.marker.markerY = this.coords[1];
                this.GET_MARKERS_FROM_API()
                    .then(() => {
                        let array = this.MARKERS;
                        
                        array.forEach(item => {
                            if(this.marker.markerX == item.markerX && this.marker.markerY == item.markerY) {
                                this.marker.marker_id = item.id //записать id маркера
                                this.postResidentialComplexes(); //добавить строищийся объект с маркером застройщику и году
                                this.dateId = ''; //обнулить id года
                                this.addObjectAct = true; //объявить что строищийся объект добавлен
                            }
                        })
                    })
                    .then(() => {
                        if (this.addObjectAct) {
                            this.addObjectAct = false;
                            this.date.year = '';
                            this.residential_complexes.name = '';
                            return this.GET_DEVELOPERS_FROM_API(); //выйти из рекурсии
                        } 
                        // если маркер не найден добавть маркер
                        if (this.addObjectAct == false) {
                            const formData = new FormData();
                            formData.append("image", this.residential_complexes.image, this.residential_complexes.image.name);

                            formData.append("markerX", this.marker.markerX);
                            formData.append("markerY", this.marker.markerY);

                            this.$axios.$post('/api/map_markers', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(response => {
                                if (response.created_at) {
                                    this.postDate();//вход в рекурсию
                                }
                            })
                        }
                    })
            },
            // search
            search(list, item) {
                let low = 0,
                    high = list.length - 1,
                    mid,
                    guess;

                while(high >= low) {
                    mid = Math.floor((high + low) / 2);
                    guess = list[mid].year_value.name;
                    if(guess == item) {
                        return list[mid].year_value.id;
                    } else if (guess > item) {
                        high = mid - 1;
                    } else {
                        low = mid + 1;
                    }
                }
                return false;
            },
            // form
            hotLineChange() {
                if(this.hotLine == "true") {
                    this.residential_complexes.number = this.hotNumber
                }
            },
            onClick(e) {
                this.coords = e.get('coords');
            },
            onContext(ctx) {
                this.context = ctx
            }
        }
    }
</script>

<style>
    .map {
        height: 300px;
    }
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