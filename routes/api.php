<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\AktivitasKegiatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\DetailEkskulController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InformasiUmumController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AnggotaEkskulController;
use App\Http\Controllers\InformasiEkskulController;
use App\Http\Controllers\EkskulGalleryController;
use App\Http\Controllers\KegiatanEkskulController;

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::post('addUser', [AuthController::class, 'register']);
Route::get('/users', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUserData']); // User data API
Route::get('/recent-activity', [ActivityController::class, 'index']);
Route::prefix('kegiatan')->group(function () {
    // GET /api/kegiatan
    Route::get('/', [AktivitasKegiatanController::class, 'index']);

    // POST /api/kegiatan
    Route::post('/', [AktivitasKegiatanController::class, 'store']);  
    
    // GET /api/kegiatan/{id}
    Route::get('/{id}', [AktivitasKegiatanController::class, 'show']);

    // PUT /api/kegiatan/{id}
    Route::put('/{id}', [AktivitasKegiatanController::class, 'update']);

    // DELETE /api/kegiatan/{id}
    Route::delete('/{id}', [AktivitasKegiatanController::class, 'destroy']);

    // GET /api/kegiatan/{id}/peserta
    Route::get('/{id}/peserta', [AktivitasKegiatanController::class, 'getPeserta']);
});

Route::apiResource('absensi', AbsensiController::class);

Route::post('/ekskul', [EkskulController::class, 'store']);

Route::apiResource('detail-ekskul', DetailEkskulController::class);

Route::get('/jumlahUser', [UserController::class, 'getUserCounts']);

Route::get('/siswa', [UserController::class, 'getAllSiswa']);
Route::get('/guru', [UserController::class, 'getAllGuru']);
Route::get('/total-user', [UserController::class, 'getUsersWithTotal']);

Route::middleware('auth:sanctum')->get('/user-profile', [UserController::class, 'getProfile']);

Route::middleware('auth:sanctum')->put('/edit-profile', [UserController::class, 'updateProfile']);

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{date}', [EventController::class, 'destroy']);

Route::get('/informasi', [InformasiUmumController::class, 'index']);
Route::post('/informasi', [InformasiUmumController::class, 'store']);
Route::put('/informasi/{id}', [InformasiUmumController::class, 'update']);
Route::delete('/informasi/{id}', [InformasiUmumController::class, 'destroy']);

Route::get('/ekskul/by-name/{name}', [EkskulController::class, 'getByName']);

Route::get('/ekskul', [EkskulController::class, 'index']);
Route::post('/ekskul', [EkskulController::class, 'store']);

Route::post('/ekskul/upload-photo', [EkskulController::class, 'uploadPhoto'])->middleware('auth:api');


// routes/api.php
Route::get('/ekskul/{id}', [EkskulController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::post('/ekskul', [EkskulController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/ekskul/{id}/description', [EkskulController::class, 'getDescription']);
    Route::put('/ekskul/{id}/description', [EkskulController::class, 'updateDescription']);
});

Route::post('/ekskul/{id}/achievements', [EkskulController::class, 'storeAchievement']);
Route::get('/ekskul/{id}/achievements', [EkskulController::class, 'getAchievements']);
Route::put('/achievements/{id}', [AchievementController::class, 'update']);
Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);

Route::middleware('auth:api')->get('/users', [UserController::class, 'index']);

Route::prefix('ekskul/{ekskul}/anggota')->group(function () {
    Route::get('/', [\App\Http\Controllers\AnggotaEkskulController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\AnggotaEkskulController::class, 'store']);
});
Route::get('/anggota-tersedia', [AnggotaEkskulController::class, 'anggotaTersedia']);
Route::delete('/ekskul/anggota/{id}', [AnggotaEkskulController::class, 'destroy']);
Route::get('/siswa-tersedia', [AnggotaEkskulController::class, 'siswaTersedia']);

Route::get('/ekskul/{id}/informasi', [InformasiEkskulController::class, 'index']);
Route::post('/ekskul/{id}/informasi', [InformasiEkskulController::class, 'store']);
Route::put('/informasi/{id}', [InformasiEkskulController::class, 'update']);
Route::delete('/informasi/{id}', [InformasiEkskulController::class, 'destroy']);

Route::get('/ekskul/{id}/galeri', [EkskulGalleryController::class, 'index']);
Route::post('/ekskul/{id}/galeri', [EkskulGalleryController::class, 'store']);
Route::delete('/galeri/{id}', [EkskulGalleryController::class, 'destroy']);

Route::prefix('ekskul/{ekskulId}')->group(function () {
    Route::get('kegiatan', [KegiatanEkskulController::class, 'index']);
    Route::post('kegiatan', [KegiatanEkskulController::class, 'store']);
});

Route::put('/ekskul/{ekskulId}/kegiatan/{id}', [KegiatanEkskulController::class, 'update']);
Route::delete('kegiatan/{id}', [KegiatanEkskulController::class, 'destroy']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
