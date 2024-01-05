<?php session_start();

    //admin manage ctrl
    require_once('../controller/adminManageCtrl/setAdminCtrl.php');
    require_once('../controller/adminManageCtrl/adminConnexionCtrl.php');

    //admin management ctrl
    require_once('../controller/adminManagementCtrl/addProductCtrl.php');
    require_once('../controller/adminManagementCtrl/modifyProductCtrl.php');
    require_once('../controller/adminManagementCtrl/deleteProductCtrl.php');
    require_once('../controller/productsManagerCtrl/sortProductsCtrl.php');

    //user manager ctrl
    require_once('../controller/usersManagerCtrl/setUserNSetProductInCartCtrl.php');
    require_once('../controller/usersManagerCtrl/getUserDataForLoginCtrl.php');
    require_once('../controller/userForgottenPwd/getUserDataForResetEmailCtrl.php');
    require_once('../controller/userForgottenPwd/resetEmailCtrl.php');
    require_once('../controller/usersSettingsManagerCtrl/updateEmailCtrl.php');
    require_once('../controller/usersSettingsManagerCtrl/updatePhoneCtrl.php');
    require_once('../controller/usersSettingsManagerCtrl/delAccountCtrl.php');

    //product manager ctrl
    //require_once('../controller/productsManagerCtrl/setProductInCartCtrl.php');
    require_once('../controller/productsManagerCtrl/setOrderProcessedCtrl.php');

    //suggestion manager ctrl
    require_once('../controller/suggestionsManagerCtrl/setSuggestionCtrl.php');
    require_once('../controller/suggestionsManagerCtrl/removeSuggestionCtrl.php');
    require_once('../controller/suggestionsManagerCtrl/removeAllSuggestionCtrl.php');

    use App\Exceptions\AdminManageExceptions\AdminManageExceptions;
    use App\exceptions\adminManagementExceptions\ProductsExceptions;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;
    use App\exceptions\productManagerExceptions\ProductInCartManagerExceptions;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;
    use App\exceptions\suggestionsExceptions\SuggestionsManagerExceptions;
    use App\exceptions\usersManagerExceptions\SetUserNSetProductInCartExceptions;


    if(isset($_GET['action'])) {
        $action = $_GET['action'];

        switch($action) {

            //admin registration
            case 'setAdminCtrl':
                try {
                    setAdminCtrl();

                    header('location: ../../frontend/views/admins/homepage/adminHomepage.php');
                }
                catch(AdminManageExceptions $e) {
                    $error_admin_registration = $e->getMessage();

                    require_once('../../frontend/views/admins/admin_regist_auth/adminRegistration.php');
                }
            break;


            //admin login
            case 'adminConnexionCtrl':
                try {
                    adminConnexionCtrl();

                    header('location: ../../frontend/views/admins/homepage/adminHomepage.php');
                }
                catch(AdminManageExceptions $e) {
                    $error_admin_login = $e->getMessage();

                    require_once('../../frontend/views/admins/admin_regist_auth/adminLogin.php');
                }
            break;


            //add product by admin
            case 'addProductCtrl':
                try {
                    addProductCtrl();

                    header('location: ../../frontend/views/admins/manageByAdmins/products/productsList.php');
                }
                catch(ProductsExceptions $e) {
                    $error_product_insertion = $e->getMessage();

                    require_once('../../frontend/views/admins/manageByAdmins/products/addProduct.php');
                }
            break;


            //modify product by admin
            case 'modifyProductCtrl':
                try {
                    modifyProductCtrl();

                    header('location: ../../frontend/views/admins/homepage/adminHomepage.php');
                }
                catch(ProductsExceptions $e) {
                    $error_product_modification = $e->getMessage();

                    require_once('../../frontend/views/admins/manageByAdmins/products/modifyProduct.php');
                }
            break;


            //delete product by admin
            case 'deleteProductCtrl':
                try {
                    deleteProductCtrl();

                    header('location: ../../frontend/views/admins/homepage/adminHomepage.php');
                }
                catch(ProductsExceptions $e) {
                    $error_product_deletion = $e->getMessage();

                    require_once('../../frontend/views/admins/manageByAdmins/products/delProduct.php');
                }
            break;


            //sort products by admin
            case 'sortProductsCtrl':
                try {
                    sortProductsCtrl();

                    header('location: ../../frontend/views/users/products/productsSortsBy.php');
                }
                catch(ProductsExceptions $e) {
                    $error_sort_product = $e->getMessage();

                    require_once('../../index.php');
                }
            break;


            //setUserNSetProductInCartCtrl
            case 'setUserNSetProductInCartCtrl':
                try {
                    setUserNSetProductInCartCtrl();

                    header('Location: ../../frontend/views/users/products/cart.php');
                }
                catch(SetUserNSetProductInCartExceptions $e) {
                    $error_setUser_n_setProductInCart = $e->getMessage();

                    require_once('../../frontend/views/users/products/putAproductInCart.php');
                }
            break;



            //get user for login
            case 'getUserDataForLoginCtrl':
                try {
                    getUserDataForLoginCtrl();

                    header('Location: ../../../index.php');
                }
                catch(UsersManagerExceptions $e)  {
                    $error_user_login = $e->getMessage();

                    require_once('../../frontend/views/users/regist_auth/login.php');
                }
            break;



            //set an order processed
            case 'setOrderProcessedCtrl':
                try {
                    setOrderProcessedCtrl();
                }
                catch(ProductInCartManagerExceptions $e) {
                    $error_order_processed = $e->getMessage();

                    require_once('../../frontend/views/admins/manageByAdmins/products/orderConfirmation.php');
                }
            break;



            //get user full during reset email about forgotten pwd
            case 'getFullNameCtrl':
                try {
                    getFullNameCtrl();
                }
                catch(UsersManagerExceptions $e) {
                    $errorGetFullName = $e->getMessage();

                    require_once('../../frontend/views/users/forgottenPwd/datasChecking.php');
                }
            break;


            //reset user's pwd in forgotten pwd
            case 'resetEmailCtrl':
                try {
                    resetEmailCtrl();

                    header('location: ../../frontend/views/users/regist_auth/login.php');
                }
                catch(UsersManagerExceptions $e) {
                    $errorResetEmail = $e->getMessage();

                    require_once('../../frontend/views/users/forgottenPwd/resetEmailForm.php');
                }
            break;


            //email update in user settings
            case 'updateEmailCtrl':
                try {
                    updateEmailCtrl();

                    header('location: ../../../../frontend/views/users/regist_auth/login.php');
                }
                catch(UsersSettingsExceptions $e) {
                    $error_email_update = $e->getMessage();

                    require_once('../../frontend/views/users/settings/userSettings.php');
                }
            break;


            //password update in user settings
            case 'updatePhoneCtrl':
                try {
                    updatePhoneCtrl();

                    header('location: ../../frontend/views/users/regist_auth/login.php');
                }
                catch(UsersSettingsExceptions $e) {
                    $error_phone_update = $e->getMessage();

                    require_once('../../frontend/views/users/settings/userSettings.php');
                }
            break;


            //deletion user account
            case 'delAccountCtrl':
                try {
                    delAccountCtrl();

                    header('location: ../../../index.php');
                }
                catch(UsersSettingsExceptions $e) {
                    $error_del_account = $e->getMessage();

                    require_once('../../frontend/views/users/settings/delAccountForm.php');
                }
            break;


            //set suggestion by user
            case 'setSuggestionCtrl':
                try {
                    setSuggestionCtrl();

                    header('location: ../../../index.php');
                    exit();
                }
                catch(SuggestionsManagerExceptions $e) {
                    $error_set_suggestion = $e->getMessage();

                    require_once('../../frontend/views/users/suggestions/contact.php');
                }
            break;


            //del suggestion by admin
            case 'removeSuggestionCtrl':
                try {
                    removeSuggestionCtrl();

                    header('Location: ../../frontend/views/admins/homepage/adminHomepage.php');
                    exit();
                }
                catch(SuggestionsManagerExceptions $e) {
                    $error_delete_suggestion = $e->getMessage();

                    require_once('../../frontend/views/admins/message/delMessage.php');
                }
            break;


            //remove all suggestions by admin
            case 'removeAllSuggestionCtrl':
                try {
                    removeAllSuggestionCtrl();

                    header('Location: ../../frontend/views/admins/homepage/adminHomepage.php');
                    exit();
                }
                catch(SuggestionsManagerExceptions $e) {
                    $error_delete_all_suggestion = $e->getMessage();

                    require_once('../../frontend/views/admins/message/delAllMessage.php');
                }
            break;
        }
    }