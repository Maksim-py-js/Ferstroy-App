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
Route::apiResource('footers', 'App\Http\Controllers\FootersController');
Route::apiResource('years', 'App\Http\Controllers\YearsController');


Route::apiResource('menus', 'App\Http\Controllers\MenusController');
Route::apiResource('menu_items', 'App\Http\Controllers\MenuItemsController');

Route::apiResource('features_residential_complexes', 'App\Http\Controllers\FeaturesResidentialComplexesController');
Route::apiResource('features_appartments', 'App\Http\Controllers\FeaturesAppartmentsController');
Route::apiResource('construction_progress', 'App\Http\Controllers\ConstructionProgressController');
Route::apiResource('residential_house_descriptions', 'App\Http\Controllers\ResidentialComplexHouseDescriptionsController');
Route::apiResource('comments', 'App\Http\Controllers\CommentsController');
Route::apiResource('advantages', 'App\Http\Controllers\AdvantagesController');

// with images
Route::apiResource('advantages_icons', 'App\Http\Controllers\AdvantagesIconsController');
Route::apiResource('advertisements', 'App\Http\Controllers\AdvertisementsController');
Route::apiResource('construction_progress_gallery', 'App\Http\Controllers\ConstructionProgressGalleryController');
Route::apiResource('developers', 'App\Http\Controllers\DevelopersController');
Route::apiResource('gallery_residential_complexes', 'App\Http\Controllers\GalleryResidentialComplexesController');
Route::apiResource('map_markers', 'App\Http\Controllers\MapMarkersController');
Route::apiResource('residential_complexes', 'App\Http\Controllers\ResidentialComplexesController');
Route::apiResource('residential_complex_houses', 'App\Http\Controllers\ResidentialComplexHousesController');
Route::apiResource('slides', 'App\Http\Controllers\SlidesController');
