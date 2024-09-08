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
    // $state = State::find(1665);
    $state = State::find(1666);

    // $cities = [
    //     ['city' => 'Agna', 'lat' => 45.1453, 'lng' => 12.0557],
    //     ['city' => 'Albignasego', 'lat' => 45.3439, 'lng' => 11.8712],
    //     ['city' => 'Anguillara Veneta', 'lat' => 45.1603, 'lng' => 11.7877],
    //     ['city' => 'Arre', 'lat' => 45.1988, 'lng' => 11.9369],
    //     ['city' => 'Arzergrande', 'lat' => 45.2719, 'lng' => 12.0292],
    //     ['city' => 'Bagnoli di Sopra', 'lat' => 45.1631, 'lng' => 11.8755],
    //     ['city' => 'Baone', 'lat' => 45.2421, 'lng' => 11.6638],
    //     ['city' => 'Barbona', 'lat' => 45.1282, 'lng' => 11.6344],
    //     ['city' => 'Battaglia Terme', 'lat' => 45.2776, 'lng' => 11.7842],
    //     ['city' => 'Boara Pisani', 'lat' => 45.0652, 'lng' => 11.7603],
    //     ['city' => 'Borgoricco', 'lat' => 45.5169, 'lng' => 11.9368],
    //     ['city' => 'Bosaro', 'lat' => 45.0138, 'lng' => 11.7269],
    //     ['city' => 'Cadoneghe', 'lat' => 45.4601, 'lng' => 11.9061],
    //     ['city' => 'Campodarsego', 'lat' => 45.5263, 'lng' => 11.9281],
    //     ['city' => 'Campodoro', 'lat' => 45.5281, 'lng' => 11.7396],
    //     ['city' => 'Camposampiero', 'lat' => 45.5662, 'lng' => 11.9298],
    //     ['city' => 'Campo San Martino', 'lat' => 45.5583, 'lng' => 11.7889],
    //     ['city' => 'Candiana', 'lat' => 45.1784, 'lng' => 11.9614],
    //     ['city' => 'Carceri', 'lat' => 45.1844, 'lng' => 11.5944],
    //     ['city' => 'Carmignano di Brenta', 'lat' => 45.6329, 'lng' => 11.6918],
    //     ['city' => 'Cartura', 'lat' => 45.2552, 'lng' => 11.8359],
    //     ['city' => 'Casale di Scodosia', 'lat' => 45.1772, 'lng' => 11.5276],
    //     ['city' => 'Casalserugo', 'lat' => 45.3014, 'lng' => 11.8942],
    //     ['city' => 'Castelbaldo', 'lat' => 45.1466, 'lng' => 11.4653],
    //     ['city' => 'Cervarese Santa Croce', 'lat' => 45.4645, 'lng' => 11.6782],
    //     ['city' => 'Cinto Euganeo', 'lat' => 45.2885, 'lng' => 11.6343],
    //     ['city' => 'Cittadella', 'lat' => 45.6442, 'lng' => 11.7848],
    //     ['city' => 'Conselve', 'lat' => 45.2332, 'lng' => 11.8721],
    //     ['city' => 'Correzzola', 'lat' => 45.2339, 'lng' => 12.0285],
    //     ['city' => 'Curtarolo', 'lat' => 45.5444, 'lng' => 11.8186],
    //     ['city' => 'Due Carrare', 'lat' => 45.2923, 'lng' => 11.8265],
    //     ['city' => 'Este', 'lat' => 45.2287, 'lng' => 11.6609],
    //     ['city' => 'Fontaniva', 'lat' => 45.6145, 'lng' => 11.7289],
    //     ['city' => 'Galliera Veneta', 'lat' => 45.6479, 'lng' => 11.7695],
    //     ['city' => 'Galzignano Terme', 'lat' => 45.3081, 'lng' => 11.7457],
    //     ['city' => 'Grantorto', 'lat' => 45.5843, 'lng' => 11.6981],
    //     ['city' => 'Granze', 'lat' => 45.1472, 'lng' => 11.7181],
    //     ['city' => 'Legnaro', 'lat' => 45.3439, 'lng' => 11.9588],
    //     ['city' => 'Limena', 'lat' => 45.4796, 'lng' => 11.8538],
    //     ['city' => 'Loreggia', 'lat' => 45.5743, 'lng' => 11.9438],
    //     ['city' => 'Lozzo Atestino', 'lat' => 45.2856, 'lng' => 11.5818],
    //     ['city' => 'Masera di Padova', 'lat' => 45.3214, 'lng' => 11.8632],
    //     ['city' => 'Masi', 'lat' => 45.0902, 'lng' => 11.5119],
    //     ['city' => 'Megliadino San Vitale', 'lat' => 45.1973, 'lng' => 11.5269],
    //     ['city' => 'Merlara', 'lat' => 45.1511, 'lng' => 11.4675],
    //     ['city' => 'Mestrino', 'lat' => 45.4762, 'lng' => 11.7423],
    //     ['city' => 'Monselice', 'lat' => 45.2396, 'lng' => 11.7478],
    //     ['city' => 'Montagnana', 'lat' => 45.2308, 'lng' => 11.4668],
    //     ['city' => 'Montegrotto Terme', 'lat' => 45.3412, 'lng' => 11.7867],
    //     ['city' => 'Noventa Padovana', 'lat' => 45.4206, 'lng' => 11.9376],
    //     ['city' => 'Ospedaletto Euganeo', 'lat' => 45.2185, 'lng' => 11.6005],
    //     ['city' => 'Padova', 'lat' => 45.4064, 'lng' => 11.8768],
    //     ['city' => 'Pernumia', 'lat' => 45.2572, 'lng' => 11.7763],
    //     ['city' => 'Piacenza d\'Adige', 'lat' => 45.1255, 'lng' => 11.5335],
    //     ['city' => 'Piazzola sul Brenta', 'lat' => 45.5487, 'lng' => 11.7877],
    //     ['city' => 'Piombino Dese', 'lat' => 45.5954, 'lng' => 11.9573],
    //     ['city' => 'Polverara', 'lat' => 45.3075, 'lng' => 11.9617],
    //     ['city' => 'Ponso', 'lat' => 45.1844, 'lng' => 11.6463],
    //     ['city' => 'Pontelongo', 'lat' => 45.2722, 'lng' => 12.0327],
    //     ['city' => 'Pozzonovo', 'lat' => 45.1877, 'lng' => 11.7723],
    //     ['city' => 'Rovolon', 'lat' => 45.3948, 'lng' => 11.6761],
    //     ['city' => 'Rubano', 'lat' => 45.4591, 'lng' => 11.8031],
    //     ['city' => 'Saccolongo', 'lat' => 45.4429, 'lng' => 11.7438],
    //     ['city' => 'San Giorgio delle Pertiche', 'lat' => 45.5536, 'lng' => 11.9314],
    //     ['city' => 'San Giorgio in Bosco', 'lat' => 45.6084, 'lng' => 11.7682],
    //     ['city' => 'San Martino di Lupari', 'lat' => 45.6443, 'lng' => 11.8106],
    //     ['city' => 'San Pietro Viminario', 'lat' => 45.2281, 'lng' => 11.7911],
    //     ['city' => 'Santa Giustina in Colle', 'lat' => 45.5761, 'lng' => 11.8753],
    //     ['city' => 'Sant\'Angelo di Piove di Sacco', 'lat' => 45.3353, 'lng' => 11.9566],
    //     ['city' => 'Sant\'Elena', 'lat' => 45.1933, 'lng' => 11.6762],
    //     ['city' => 'Selvazzano Dentro', 'lat' => 45.4109, 'lng' => 11.7965],
    //     ['city' => 'Solesino', 'lat' => 45.1756, 'lng' => 11.7238],
    //     ['city' => 'Stanghella', 'lat' => 45.1234, 'lng' => 11.7327],
    //     ['city' => 'Teolo', 'lat' => 45.3585, 'lng' => 11.6881],
    //     ['city' => 'Terrassa Padovana', 'lat' => 45.2365, 'lng' => 11.8816],
    //     ['city' => 'Tombolo', 'lat' => 45.6331, 'lng' => 11.8004],
    //     ['city' => 'Torreglia', 'lat' => 45.3263, 'lng' => 11.7443],
    //     ['city' => 'Trebaseleghe', 'lat' => 45.5707, 'lng' => 12.0123],
    //     ['city' => 'Tribano', 'lat' => 45.2291, 'lng' => 11.8238],
    //     ['city' => 'Urbana', 'lat' => 45.1759, 'lng' => 11.4622],
    //     ['city' => 'Veggiano', 'lat' => 45.4637, 'lng' => 11.7267],
    //     ['city' => 'Vescovana', 'lat' => 45.1289, 'lng' => 11.7243],
    //     ['city' => 'Vighizzolo d\'Este', 'lat' => 45.1633, 'lng' => 11.6354],
    //     ['city' => 'Vigodarzere', 'lat' => 45.4601, 'lng' => 11.8866],
    //     ['city' => 'Vigonza', 'lat' => 45.4327, 'lng' => 11.9454],
    //     ['city' => 'Villa Estense', 'lat' => 45.1837, 'lng' => 11.5875],
    //     ['city' => 'Villafranca Padovana', 'lat' => 45.5011, 'lng' => 11.7867],
    //     ['city' => 'Villanova di Camposampiero', 'lat' => 45.5077, 'lng' => 11.9537],
    //     ['city' => 'Vo\'', 'lat' => 45.3232, 'lng' => 11.6502]
    // ];
    
    foreach ($cities as $key => $value) {
        City::create([
            'name' => $value['city'],
            'state_id' => $state->id,
            'state_code' => $state->country_code,
            'country_id' => $state->country_id,
            'country_code' => $state->country_code,
            'latitude' => $value['lat'],
            'longitude' => $value['lng'],
            'created_at' => now(),
            'updated_at' => now(),
            'flag' => 1,
            'wikiDataId' => $state->wikiDataId ?? null,
        ]);
    }

    return "Success";
});
