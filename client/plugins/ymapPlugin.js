import Vue from 'vue'
import YmapPlugin from 'vue-yandex-maps'

const settings = {
    apiKey: 'dbf56513-031b-4471-b832-a60218a14223',
    lang: 'ru_RU',
    coordorder: 'latlong',
    version: '2.1'
}

Vue.use(YmapPlugin, settings);