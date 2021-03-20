<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('pages', 'App\Http\Controllers\PagesController');
// страница со всеми страницами тоесть тут данные от главной и тд
Route::apiResource('footers', 'App\Http\Controllers\FootersController');
// это футеры
Route::apiResource('years', 'App\Http\Controllers\YearsController');
// это года для дерева



Route::apiResource('menus', 'App\Http\Controllers\MenusController');
// это менюшки для хэдера и футера
Route::apiResource('menu_items', 'App\Http\Controllers\MenuItemsController');
// это контент менюшки для хэдера и футера тоесть(название значение и тд)

Route::apiResource('features_residential_complexes', 'App\Http\Controllers\FeaturesResidentialComplexesController');
// особенности ЖК
Route::apiResource('features_appartments', 'App\Http\Controllers\FeaturesAppartmentsController');
// особенности квартир в ЖК
Route::apiResource('construction_progress', 'App\Http\Controllers\ConstructionProgressController');
// прогресс стройки
Route::apiResource('residential_house_descriptions', 'App\Http\Controllers\ResidentialComplexHouseDescriptionsController');
// описание дома на большой svg там где можно в ЖК выбрать дом
Route::apiResource('comments', 'App\Http\Controllers\CommentsController');
// все коментарии
Route::apiResource('advantages', 'App\Http\Controllers\AdvantagesController');
// это такое штуки по типу как на главной странице есть тип наши преимущества это вот эта штука

Route::apiResource('house_floor_descriptions', 'App\Http\Controllers\HouseFloorDescriptionsController');
Route::apiResource('house_navigations', 'App\Http\Controllers\HouseNavigationsController');

// with images
Route::apiResource('advantages_icons', 'App\Http\Controllers\AdvantagesIconsController');
// это иконки для преимущест (смотри выше это для них иконки)
Route::apiResource('advertisements', 'App\Http\Controllers\AdvertisementsController');
// это блоки рекламы на главной странице
Route::apiResource('construction_progress_gallery', 'App\Http\Controllers\ConstructionProgressGalleryController');
// это галерея для прогресса стройки
Route::apiResource('developers', 'App\Http\Controllers\DevelopersController');
// это застройщики
Route::apiResource('gallery_residential_complexes', 'App\Http\Controllers\GalleryResidentialComplexesController');
// это галерея для ЖК
Route::apiResource('map_markers', 'App\Http\Controllers\MapMarkersController');
// это маркеры на карту тоесть тут храниться фотка круглая и координаты
Route::apiResource('residential_complexes', 'App\Http\Controllers\ResidentialComplexesController');
// это ЖК
Route::apiResource('residential_complex_houses', 'App\Http\Controllers\ResidentialComplexHousesController');
// это большая svg на странице с ЖК там где при наведении на дом можно выбрать дом )
Route::apiResource('slides', 'App\Http\Controllers\SlidesController');
// это слайдер для главной страницы в хэдэре тоесть сюда ты добовляешь фотки и у тебя они все выводяться в слайдере на главной
Route::apiResource('r_c_house_hovers', 'App\Http\Controllers\RCHouseHoversController');

Route::apiResource('houses', 'App\Http\Controllers\HousesController');
Route::apiResource('house_hovers', 'App\Http\Controllers\HouseHoversController');

Route::apiResource('floors', 'App\Http\Controllers\FloorsController');
Route::apiResource('floor_hovers', 'App\Http\Controllers\FloorHoversController');

Route::apiResource('appartments', 'App\Http\Controllers\AppartmentsController');
