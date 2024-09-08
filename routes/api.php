<?php


use App\Http\Controllers\Api\SupportedBanksController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\KycController;
use App\Http\Controllers\Api\BeneficiaryController;
use App\Http\Controllers\Api\BeneficiaryAccountController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\ShippingRateController;
use App\Http\Controllers\WalkInCustomerOrder;
use App\Models\City;
use App\Models\State;
use App\Models\SupportedBanks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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



Route::post('/login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('password-reset-request', [AuthController::class, 'requestPasswordReset']);
Route::post('password-reset-otp', [AuthController::class, 'passwordResetOTP']);
Route::post('password-reset-change', [AuthController::class, 'passwordResetChange']);

Route::get('/countries', [CountriesController::class, 'index']);
Route::get('/receiving-countries', [CountriesController::class, 'receiving']);
Route::get('/sending-countries', [CountriesController::class, 'sending']);
Route::get('/payout-channels', [CountriesController::class, 'getpayoutChannels']);
Route::get('/payout-channels/by-country', [CountriesController::class, 'getpayoutChannelsByCountry']);

Route::get('/supported-banks', [SupportedBanksController::class, 'index']);
Route::get('/supported-banks/by-country', [SupportedBanksController::class, 'listByCountry']);

Route::post('/webhook/stripe', [WebhookController::class, 'handleStripeWebhook']);

//api endpoint for extimating shipping cost
Route::get('/rates-fetch-api', [ShippingRateController::class, 'rates_fetch_api'])->name('rates.fetch.api');
Route::post('/external-app-order', [WalkInCustomerOrder::class, 'external_app_order'])->name('external.app.order');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('/user-kyc-status/{userId}', [UserController::class, 'getKycInfo']);

    Route::get('/kyc/document-types', [KycController::class, 'documentTypes']);
    Route::get('/kyc/proof-of-address-types', [KycController::class, 'addressProofTypes']);
    Route::post('/kyc/personal-information', [KycController::class, 'submitPersonalInformation']);
    Route::post('/kyc/document-verification', [KycController::class, 'submitDocumentVerification']);
    Route::post('/kyc/selfie', [KycController::class, 'submitSelfie']);
    Route::post('/kyc/proof-of-address', [KycController::class, 'submitProofOfAddress']);


    Route::middleware(['kyc.required'])->group(function () {
        Route::post('/beneficiary/add-new-beneficiary', [BeneficiaryController::class, 'store']);
        Route::get('/beneficiary/search-beneficiaries', [BeneficiaryController::class, 'search']);
        Route::get('/beneficiary/get-beneficiaries', [BeneficiaryController::class, 'index']);

        Route::post('/beneficiary/add-beneficiary-account', [BeneficiaryAccountController::class, 'store']);
        Route::get('/beneficiaries/bank-accounts', [BeneficiaryAccountController::class, 'index']);
        Route::delete('/beneficiaries/bank-accounts/{account_id}', [BeneficiaryAccountController::class, 'delete']);


        Route::post('/transfer-money', [TransactionController::class, 'store']);
        Route::get('/get-transactions', [TransactionController::class, 'index']);

        // Route::get('/receiving-countries', [CountriesController::class, 'receiving']);
        // Route::get('/sending-countries', [CountriesController::class, 'sending']);

        Route::post('/create-payment-intent', [TransferController::class, 'createPaymentIntent']);
        Route::post('/create-transaction', [TransactionController::class, 'createPaymentIntent']);

        Route::post('/beneficiaries', [BeneficiaryController::class, 'create'])->name('beneficiaries.post');
        Route::put('/beneficiaries/{beneficiaryId}', [BeneficiaryController::class, 'updateBeneficiary'])->name('beneficiaries.put');
        Route::get('/beneficiaries', [BeneficiaryController::class, 'getBeneficiaries'])->name('beneficiaries.get');
        Route::delete('/beneficiaries/{beneficiaryId}', [BeneficiaryController::class, 'deleteBeneficiary']);
    });
});


Route::get('/test', function () {
    $states = State::whereDoesntHave('city')->get();
    foreach ($states as $key => $state) {
        City::create([
            'name' => $state->name,
            'state_id' => $state->id,
            'state_code' => $state->country_code,
            'country_id' => $state->country_id,
            'country_code' => $state->country_code,
            'latitude' => $state->latitude,
            'longitude' => $state->longitude,
            'created_at' => now(),
            'updated_at' => now(),
            'flag' => 1,
            'wikiDataId' => $state->wikiDataId ?? null,
        ]);
    }

    return "Success";
});
