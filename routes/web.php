<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\DB;

$router->get('/api/origin/info', function () use ($router) {
    phpinfo();
});

// $router->get('/api/khun/get_data_request/{id}', function ($id) use ($router) {
//     $results = DB::connection('mysql2.11-we-chair')->select("SELECT * FROM request req
//     LEFT JOIN chair_type ct ON req.chair_type_id = ct.chair_id
//     LEFT JOIN patient_type ptt ON req.patient_type_id = ptt.patient_type_id
//     LEFT JOIN request_status req_st ON req.req_status_id = req_st.req_status_id where req.id = '".$id."';");
//     return $results;
// });

// $router->post('/api/khun/submitAddappointment/', 'Controller@submitAddappointment');
// $router->post('/api/khun/submitWorker/', 'Controller@submitWorker');
// $router->post('/api/khun/submitWorkerUpdateStatus/', 'Controller@submitWorkerUpdateStatus');
// $router->post('/api/khun/submitWorkerUpdateStatus_success/', 'Controller@submitWorkerUpdateStatus_success');

?>