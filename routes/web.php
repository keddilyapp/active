<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\FollowSellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Payment\AamarpayController;
use App\Http\Controllers\Payment\AuthorizenetController;
use App\Http\Controllers\Payment\BkashController;
use App\Http\Controllers\Payment\CybersourceController;
use App\Http\Controllers\Payment\InstamojoController;
use App\Http\Controllers\Payment\IyzicoController;
use App\Http\Controllers\Payment\MercadopagoController;
use App\Http\Controllers\Payment\NagadController;
use App\Http\Controllers\Payment\NgeniusController;
use App\Http\Controllers\Payment\PayhereController;
use App\Http\Controllers\Payment\PaykuController;
use App\Http\Controllers\Payment\PaymobController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\SslcommerzController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\TapController;
use App\Http\Controllers\Payment\VoguepayController;
use App\Http\Controllers\ProductQueryController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SizeChartController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::controller(DemoController::class)->group(function () {
    Route::get('/demo/cron_1', 'cron_1');
    Route::get('/demo/cron_2', 'cron_2');
    Route::get('/convert_assets', 'convert_assets');
    Route::get('/convert_category', 'convert_category');
    Route::get('/convert_tax', 'convertTaxes');
    Route::get('/set-category', 'setCategoryToProductCategory');
    Route::get('/insert_product_variant_forcefully', 'insert_product_variant_forcefully');
    Route::get('/update_seller_id_in_orders/{id_min}/{id_max}', 'update_seller_id_in_orders');
    Route::get('/migrate_attribute_values', 'migrate_attribute_values');
});

Route::get('/refresh-csrf', function () {
    return csrf_token();
});

// AIZ Uploader
Route::controller(AizUploadController::class)->group(function () {
    Route::post('/aiz-uploader', 'show_uploader');
    Route::post('/aiz-uploader/upload', 'upload');
    Route::get('/aiz-uploader/get-uploaded-files', 'get_uploaded_files');
    Route::post('/aiz-uploader/get_file_by_ids', 'get_preview_files');
    Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
});

Route::group(['middleware' => ['prevent-back-history','handle-demo-login']], function () {
    Auth::routes(['verify' => true]);
});

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout');
    Route::get('/social-login/redirect/{provider}', 'redirectToProvider')->name('social.login');
    Route::get('/social-login/{provider}/callback', 'handleProviderCallback')->name('social.callback');
    //Apple Callback
    Route::post('/apple-callback', 'handleAppleCallback');
    Route::get('/account-deletion', 'account_deletion')->name('account_delete');
    //Route::get('/handle-demo-login', 'handle_demo_login')->name('handleDemoLogin');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/resend', 'resend')->name('verification.resend');
    Route::get('/verification-confirmation/{code}', 'verification_confirmation')->name('email.verification.confirmation');
});

Route::resource('shops', ShopController::class)->middleware('handle-demo-login');
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop/registration/verification', 'verifyRegEmailorPhone')->name('shop-reg.verification');
    Route::post('/shop/registration/verification-code-send', 'sendRegVerificationCode')->name('shop-reg.verification_code_send');
    Route::get('/shop/registration/verify-code/{id}', 'regVerifyCode')->name('shop-reg.verify_code');
    Route::post('/shop/registration/verification-code-confirmation', 'regVerifyCodeConfirmation')->name('shop-reg.verify_code_confirmation');

});

Route::controller(HomeController::class)->group(function () {
    Route::get('/registration/verification', 'verifyRegEmailorPhone')->name('registration.verification');
    Route::post('/registration/verification-code-send', 'sendRegVerificationCode')->name('customer-reg.verification_code_send');
    Route::get('/registration/verify-code/{id}', 'regVerifyCode')->name('customer-reg.verify_code');
    Route::post('/registration/verification-code-confirmation', 'regVerifyCodeConfirmation')->name('customer-reg.verify_code_confirmation');
    Route::get('/email-change/callback', 'email_change_callback')->name('email_change.callback');
    Route::post('/password/reset/email/submit', 'reset_password_with_code')->name('password.update');

    Route::get('/users/login', 'login')->name('user.login')->middleware('handle-demo-login');
    Route::get('/seller/login', 'login')->name('seller.login')->middleware('handle-demo-login');
    Route::get('/deliveryboy/login', 'login')->name('deliveryboy.login')->middleware('handle-demo-login');
    Route::get('/users/registration', 'registration')->name('user.registration')->middleware('handle-demo-login');
    Route::post('/users/login/cart', 'cart_login')->name('cart.login.submit')->middleware('handle-demo-login');

    Route::post('/import-data', 'import_data');

    //Home Page
    Route::get('/', 'index')->name('home');

    Route::post('/home/section/featured', 'load_featured_section')->name('home.section.featured');
    Route::post('/home/section/todays-deal', 'load_todays_deal_section')->name('home.section.todays_deal');
    Route::post('/home/section/best-selling', 'load_best_selling_section')->name('home.section.best_selling');
    Route::post('/home/section/newest-products', 'load_newest_product_section')->name('home.section.newest_products');
    Route::post('/home/section/home-categories', 'load_home_categories_section')->name('home.section.home_categories');
    Route::post('/home/section/best-sellers', 'load_best_sellers_section')->name('home.section.best_sellers');
    Route::post('/home/section/preorder-products', 'load_preorder_featured_products_section')->name('home.section.preorder_products');

    //category dropdown menu ajax call
    Route::post('/category/nav-element-list', 'get_category_items')->name('category.elements');

    //Flash Deal Details Page
    Route::get('/flash-deals', 'all_flash_deals')->name('flash-deals');
    Route::get('/flash-deal/{slug}', 'flash_deal_details')->name('flash-deal-details');

    //Todays Deal Details Page
    Route::get('/todays-deal', 'todays_deal')->name('todays-deal');

    Route::get('/product/{slug}', 'product')->name('product');
    Route::post('/product/variant-price', 'variant_price')->name('products.variant_price');
    Route::get('/shop/{slug}', 'shop')->name('shop.visit');
    Route::get('/shop/{slug}/{type}', 'filter_shop')->name('shop.visit.type');

    Route::get('/customer-packages', 'premium_package_index')->name('customer_packages_list_show');

    Route::get('/brands', 'all_brands')->name('brands.all');
    Route::get('/categories', 'all_categories')->name('categories.all');
    Route::get('/sellers', 'all_seller')->name('sellers');
    Route::get('/coupons', 'all_coupons')->name('coupons.all');
    Route::get('/inhouse', 'inhouse_products')->name('inhouse.all');


    // Policies
    Route::get('/seller-policy', 'sellerpolicy')->name('sellerpolicy');
    Route::get('/return-policy', 'returnpolicy')->name('returnpolicy');
    Route::get('/support-policy', 'supportpolicy')->name('supportpolicy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy-policy', 'privacypolicy')->name('privacypolicy');

    Route::get('/track-your-order', 'trackOrder')->name('orders.track');
});

// Language Switch
Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');

// Currency Switch
Route::post('/currency', [CurrencyController::class, 'changeCurrency'])->name('currency.change');

// Size Chart Show
Route::get('/size-charts-show/{id}', [SizeChartController::class, 'show'])->name('size-charts-show');

Route::get('/sitemap.xml', function () {
    return base_path('sitemap.xml');
});

// Classified Product
Route::controller(CustomerProductController::class)->group(function () {
    Route::get('/customer-products', 'customer_products_listing')->name('customer.products');
    Route::get('/customer-products?category={category_slug}', 'search')->name('customer_products.category');
    Route::get('/customer-products?city={city_id}', 'search')->name('customer_products.city');
    Route::get('/customer-products?q={search}', 'search')->name('customer_products.search');
    Route::get('/customer-product/{slug}', 'customer_product')->name('customer.product');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'index')->name('search');
    Route::get('/search?keyword={search}', 'index')->name('suggestion.search');
    Route::post('/ajax-search', 'ajax_search')->name('search.ajax');
    Route::get('/category/{category_slug}', 'listingByCategory')->name('products.category');
    Route::get('/brand/{brand_slug}', 'listingByBrand')->name('products.brand');
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart/show-cart-modal', 'showCartModal')->name('cart.showCartModal');
    Route::post('/cart/addtocart', 'addToCart')->name('cart.addToCart');
    Route::post('/cart/removeFromCart', 'removeFromCart')->name('cart.removeFromCart');
    Route::post('/cart/updateQuantity', 'updateQuantity')->name('cart.updateQuantity');
    Route::post('/cart/updateCartStatus', 'updateCartStatus')->name('cart.updateCartStatus');
});

//Paypal START
Route::controller(PaypalController::class)->group(function () {
    Route::get('/paypal/payment/done', 'getDone')->name('payment.done');
    Route::get('/paypal/payment/cancel', 'getCancel')->name('payment.cancel');
});
//Cybersource START
Route::controller(CybersourceController::class)->group(function () {
    Route::post('/cyber-source/payment/process', 'process')->name('cybersource.process');
    Route::any('/cyber-source/payment/callback', 'callback')->name('cybersource.callback');
    Route::any('/cyber-source/payment/webhook', 'webhook')->name('cybersource.webhook');
    Route::get('/cyber-source/payment/cancel', 'getCancel')->name('cybersource.cancel');
});

//Mercadopago START
Route::controller(MercadopagoController::class)->group(function () {
    Route::any('/mercadopago/payment/done', 'paymentstatus')->name('mercadopago.done');
    Route::any('/mercadopago/payment/cancel', 'callback')->name('mercadopago.cancel');
});
//Mercadopago

// SSLCOMMERZ Start
Route::controller(SslcommerzController::class)->group(function () {
    Route::get('/sslcommerz/pay', 'index');
    Route::POST('/sslcommerz/success', 'success');
    Route::POST('/sslcommerz/fail', 'fail');
    Route::POST('/sslcommerz/cancel', 'cancel');
    Route::POST('/sslcommerz/ipn', 'ipn');
});
//SSLCOMMERZ END

//Stipe Start
Route::controller(StripeController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('/stripe/create-checkout-session', 'create_checkout_session')->name('stripe.get_token');
    Route::any('/stripe/payment/callback', 'callback')->name('stripe.callback');
    Route::get('/stripe/success', 'success')->name('stripe.success');
    Route::get('/stripe/cancel', 'cancel')->name('stripe.cancel');
});
//Stripe END

// Compare
Route::controller(CompareController::class)->group(function () {
    Route::get('/compare', 'index')->name('compare');
    Route::get('/compare/reset', 'reset')->name('compare.reset');

    //Sitemap
    Route::get('/sitemap.xml', function(){
        return base_path('sitemap.xml');
    });
});
```

This commit closes the tenant middleware group in web.php by adding a closing brace.