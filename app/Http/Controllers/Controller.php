<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

class Controller extends BaseController
{
    public function check_fullname_phos_person(Request $request)
    {
        try
        {
            $results = DB::connection('mysql2.9-phos_db-no-utf8')->table('phos_person')
            ->where('phos_cid', '=', $request->phos_cid)
            ->get();
            if($results->IsEmpty())
            {
                return response()->json(
                    [
                        'status_code' => '200',
                        'status_message' => 'No_Data'
                    ]);
            }
            else
            {
                $data = array('fullname' => iconv("TIS-620", "UTF-8",$results[0]->phos_title." ".$results[0]->phos_firstname." ".$results[0]->phos_lastname));
                return json_encode($data);
            }

            // $results = DB::connection('mysql2.9-phos_db')->select("SELECT phos_person.phos_title FROM phos_person where phos_cid = ".$request->phos_cid.";");
            // //echo $request->phos_cid;
            // $data = array(
            //     'phos_title' => iconv("TIS-620", "UTF-8",$results[0]->phos_title)
            //    );
            //    return json_encode($data);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }

    public function insert_adr_v3_from_hie(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");

            $results = DB::connection('mysql4.20-hosxpv3')->table('opd_allergy')
            ->insertGetId(
                [
                    "hn" => trim($request->hn),
                    "report_date" => trim($request->report_date),
                    "agent" => trim($request->agent),
                    "symptom" => trim($request->symptom),
                    "reporter" => trim($request->reporter),
                    "relation_level" => trim($request->relation_level),
                    "note" => trim($request->note),
                    "allergy_type" => trim($request->allergy_type),
                    "display_order" => trim($request->display_order),
                    "begin_date" => trim($request->begin_date),
                    "allergy_group_id" => trim($request->allergy_group_id),
                    "seriousness_id" => trim($request->seriousness_id),
                    "allergy_result_id" => trim($request->allergy_result_id),
                    "allergy_relation_id" => trim($request->allergy_relation_id),
                    "ward" => trim($request->ward),
                    "department" => trim($request->department),
                    "spclty" => $request->spclty,
                    "entry_datetime" => trim($request->entry_datetime),
                    "update_datetime" => trim($request->update_datetime),
                    "depcode" => trim($request->depcode),
                    "no_alert" => trim($request->no_alert),
                    "naranjo_result_id" => trim($request->naranjo_result_id),
                    "force_no_order" => trim($request->force_no_order),
                    "opd_allergy_alert_type_id" => trim($request->opd_allergy_alert_type_id),
                    "hos_guid" => trim($request->hos_guid),
                    "adr_preventable_score" => trim($request->adr_preventable_score),
                    "preventable" => trim($request->preventable),
                    "patient_cid" => trim($request->patient_cid),
                    "adr_consult_dialog_id" => trim($request->adr_consult_dialog_id),
                    "opd_allergy_report_type_id" => trim($request->opd_allergy_report_type_id),
                    "hos_guid_ext" => trim($request->hos_guid_ext),
                    "agent_code24" => trim($request->agent_code24),
                    "officer_confirm" => trim($request->officer_confirm),
                    "icode" => $request->icode,
                    "opd_allergy_symtom_type_id" => trim($request->opd_allergy_symtom_type_id),
                    "opd_allergy_id" => trim($request->opd_allergy_id),
                    "cross_group_check" => trim($request->cross_group_check),
                    "opd_allergy_source_id" => trim($request->opd_allergy_source_id),
                    "opd_allergy_type_id" => trim($request->opd_allergy_type_id),
                    "doctor_code" => trim($request->doctor_code),
                    "dosage_text" => trim($request->dosage_text),
                    "usage_text" => trim($request->usage_text),
                    "lab_text" => trim($request->lab_text)
                ]
            );

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Insert Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function submitAddappointment(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");

            $results = DB::connection('mysql2.11-we-chair')->table('request')
            ->insertGetId(
                [
                    "hn" => str_pad($request->hn,9,"0",STR_PAD_LEFT),
                    "vn" => $request->vn,
                    "pname" => $request->pname,
                    "fname" => $request->fname,
                    "lname" => $request->lname,
                    "pt_name" => $request->pt_name,
                    "dept" => $request->dept,
                    "ward" => $request->ward,
                    "wheelchair" => $request->wheelchair,
                    "sleepingcart" => $request->sleepingcart,
                    // "oxygen" => $request->oxygen,
                    "origin" => $request->origin,
                    "destination" => $request->destination,
                    "destination_name" => $request->destination_name,
                    "request_datetimes" => $request->request_datetimes,
                    "non_urgency" => $request->non_urgency,
                    "semi_urgency" => $request->semi_urgency,
                    "urgency" => $request->urgency,
                    "req_status_id" => 1,
                    "chair_type_id" => $request->chair_type_id,
                    "patient_type_id" => $request->patient_type_id
                ]
            );

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Insert Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function submitWorker(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");

            $results = DB::connection('mysql2.11-we-chair')->table('request')
            ->where('id', $request->req_id)
            ->update(['req_status_id' => $request->req_status_id]);

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Update Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function submitWorkerUpdateStatus(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");

            $results = DB::connection('mysql2.11-we-chair')->table('request')
            ->where('id', $request->req_id)
            ->update(['req_status_id' => $request->req_status_id]);

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Update Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function submitWorkerUpdateStatus_success(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");

            $results = DB::connection('mysql2.11-we-chair')->table('request')
            ->where('id', $request->req_id)
            ->update(['req_status_id' => $request->req_status_id,
            'worker_id' => $request->worker_id,
            'station_depcode' => $request->station_depcode]
            );

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Update Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function insert_adr_from_local_hosp_to_hie(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");
            //echo $request->hn;
            $results = DB::connection('mysql2.11-HIE_drug_allergy')->table('opd_allergy')
            ->insert(
                [
                    "hn" => trim($request->hn),
                    "report_date" =>trim($request->report_date),
                    "agent"=>trim($request->agent),
                    "symptom"=>trim($request->symptom),
                    "reporter"=>trim($request->reporter),
                    "relation_level"=>trim($request->relation_level),
                    "note"=>trim($request->note),
                    "allergy_type"=>trim($request->allergy_type),
                    "display_order"=>trim($request->display_order),
                    "begin_date"=>trim($request->begin_date),
                    "allergy_group_id"=>trim($request->allergy_group_id),
                    "seriousness_id"=>trim($request->seriousness_id),
                    "allergy_result_id"=>trim($request->allergy_result_id),
                    "allergy_relation_id"=>trim($request->allergy_relation_id),
                    "ward"=>trim($request->ward),
                    "department"=>trim($request->department),
                    "spclty"=>trim($request->spclty),
                    "entry_datetime"=>trim($request->entry_datetime),
                    "update_datetime"=>trim($request->update_datetime),
                    "depcode"=>trim($request->depcode),
                    "no_alert"=>trim($request->no_alert),
                    "naranjo_result_id"=>trim($request->naranjo_result_id),
                    "force_no_order"=>trim($request->force_no_order),
                    "opd_allergy_alert_type_id"=>trim($request->opd_allergy_alert_type_id),
                    "hos_guid"=>trim($request->hos_guid),
                    "adr_preventable_score"=>trim($request->adr_preventable_score),
                    "preventable"=>trim($request->preventable),
                    "patient_cid"=>trim($request->patient_cid),
                    "adr_consult_dialog_id"=>trim($request->adr_consult_dialog_id),
                    "opd_allergy_report_type_id"=>trim($request->opd_allergy_report_type_id),
                    "hos_guid_ext"=>trim($request->hos_guid_ext),
                    "agent_code24"=>trim($request->agent_code24),
                    "officer_confirm"=>trim($request->officer_confirm),
                    "icode"=>trim($request->icode),
                    "opd_allergy_symtom_type_id"=>trim($request->opd_allergy_symtom_type_id),
                    "opd_allergy_id"=>trim($request->opd_allergy_id),
                    "cross_group_check"=>trim($request->cross_group_check),
                    "opd_allergy_source_id"=>trim($request->opd_allergy_source_id),
                    "opd_allergy_type_id"=>trim($request->opd_allergy_type_id),
                    "doctor_code"=>trim($request->doctor_code),
                    "dosage_text"=>trim($request->dosage_text),
                    "usage_text"=>trim($request->usage_text),
                    "lab_text"=>trim($request->lab_text),
                    "hospcode"=>trim($request->hospcode),
                    "hospcode_hn_opd_allergy_id"=>trim($request->hospcode_hn_opd_allergy_id)
                ]
            );

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Insert Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function insert_adr_from_hie_to_v4(Request $request)
    {
        try
        {
            //$results = DB::connection('mysql2.11-testnodejs')->select("INSERT INTO member (username,password,bdate) VALUES ('".$request->username."','".$request->password."', '".$request->birthdate."') ;");
            //echo $request->hn;
            $serial_opd_allergy_id = DB::connection('hosxp4_SIT-1.6')->select("SELECT get_serialnumber('opd_allergy_id');");
            $serial_opd_allergy_id = $serial_opd_allergy_id[0]->get_serialnumber;

            echo "<br><br>";
            echo "hn " , trim($request->hn),"<br>";
            echo "report_date " ,trim($request->report_date),"<br>";
            echo "agent ",trim($request->agent),"<br>";
            echo "symptom ",trim($request->symptom),"<br>";
            echo "reporter ",trim($request->reporter),"<br>";
            echo "relation_level ",trim($request->relation_level),"<br>";
            echo "note ",trim($request->note),"<br>";
            echo "allergy_type ",trim($request->allergy_type),"<br>";
            echo "display_order ",trim($request->display_order),"<br>";
            echo "begin_date ",trim($request->begin_date),"<br>";
            echo "allergy_group_id ",trim($request->allergy_group_id),"<br>";
            echo "seriousness_id ",trim($request->seriousness_id),"<br>";
            echo "allergy_result_id ",trim($request->allergy_result_id),"<br>";
            echo "allergy_relation_id ",trim($request->allergy_relation_id),"<br>";
            echo "ward ",trim($request->ward),"<br>";
            echo "department ",trim($request->department),"<br>";
            echo "spclty ",trim($request->spclty),"<br>";
            echo "entry_datetime ",trim($request->entry_datetime),"<br>";
            echo "update_datetime ",trim($request->update_datetime),"<br>";
            echo "depcode ",trim($request->depcode),"<br>";
            echo  "no_alert ",trim($request->no_alert),"<br>";
            echo "naranjo_result_id ",trim($request->naranjo_result_id),"<br>";
            echo "force_no_order ",trim($request->force_no_order),"<br>";
            echo "opd_allergy_alert_type_id ",trim($request->opd_allergy_alert_type_id),"<br>";
            echo "hos_guid ",trim($request->hos_guid),"<br>";
            echo "adr_preventable_score ",trim($request->adr_preventable_score),"<br>";
            echo "preventable ",trim($request->preventable),"<br>";
            echo "patient_cid ",trim($request->patient_cid),"<br>";
            echo "adr_consult_dialog_id ",trim($request->adr_consult_dialog_id),"<br>";
            echo "opd_allergy_report_type_id ",trim($request->opd_allergy_report_type_id),"<br>";
            echo "hos_guid_ext ",trim($request->hos_guid_ext),"<br>";
            echo "agent_code24 ",trim($request->agent_code24),"<br>";
            echo "officer_confirm ",trim($request->officer_confirm),"<br>";
            echo "icode ",trim($request->icode),"<br>";
            echo "opd_allergy_symtom_type_id ",trim($request->opd_allergy_symtom_type_id),"<br>";
            echo "cross_group_check ",trim($request->cross_group_check),"<br>";
            echo "opd_allergy_source_id ",trim($request->opd_allergy_source_id),"<br>";
            echo "opd_allergy_type_id ",trim($request->opd_allergy_type_id),"<br>";
            echo "doctor_code ",trim($request->doctor_code),"<br>";
            echo "dosage_text ",trim($request->dosage_text),"<br>";
            echo "usage_text ",trim($request->usage_text),"<br>";
            echo "lab_text ",trim($request->lab_text),"<br><br>";
            // var_dump($request->opd_allergy_type_id);
            // if($request->opd_allergy_type_id == '')
            // {
            //     $request->opd_allergy_type_id = NULL;
            // }
            function IsNullOrEmptyString($str){
                if(!isset($str) || trim($str) === '')
                {
                    return null;
                }
            }
            

            $results = DB::connection('hosxp4_SIT-1.6')->table('opd_allergy')
            ->insert(
                [
                    "hn" => trim($request->hn),
                    "report_date" =>trim($request->report_date),
                    "agent"=>trim($request->agent),
                    "symptom"=>trim($request->symptom),
                    "reporter"=>trim($request->reporter),
                    "relation_level"=>trim($request->relation_level),
                    "note"=>trim($request->note),
                    "allergy_type"=>trim($request->allergy_type),
                    "display_order"=>IsNullOrEmptyString(trim($request->display_order)),
                    "begin_date"=>trim($request->begin_date),
                    "allergy_group_id"=>IsNullOrEmptyString(trim($request->allergy_group_id)),
                    "seriousness_id"=>IsNullOrEmptyString(trim($request->seriousness_id)),
                    "allergy_result_id"=>IsNullOrEmptyString(trim($request->allergy_result_id)),
                    "allergy_relation_id"=>IsNullOrEmptyString(trim($request->allergy_relation_id)),
                    "ward"=>trim($request->ward),
                    "department"=>trim($request->department),
                    "spclty"=>trim($request->spclty),
                    "entry_datetime"=>trim($request->entry_datetime),
                    "update_datetime"=>trim($request->update_datetime),
                    "depcode"=>trim($request->depcode),
                    "no_alert"=>trim($request->no_alert),
                    "naranjo_result_id"=>IsNullOrEmptyString(trim($request->naranjo_result_id)),
                    "force_no_order"=>trim($request->force_no_order),
                    "opd_allergy_alert_type_id"=>IsNullOrEmptyString(trim($request->opd_allergy_alert_type_id)),
                    "hos_guid"=>trim($request->hos_guid),
                    "adr_preventable_score"=>IsNullOrEmptyString(trim($request->adr_preventable_score)),
                    "preventable"=>trim($request->preventable),
                    "patient_cid"=>trim($request->patient_cid),
                    "adr_consult_dialog_id"=>IsNullOrEmptyString(trim($request->adr_consult_dialog_id)),
                    "opd_allergy_report_type_id"=>IsNullOrEmptyString(trim($request->opd_allergy_report_type_id)),
                    "hos_guid_ext"=>trim($request->hos_guid_ext),
                    "agent_code24"=>trim($request->agent_code24),
                    "officer_confirm"=>trim($request->officer_confirm),
                    "icode"=>trim($request->icode),
                    "opd_allergy_symtom_type_id"=>IsNullOrEmptyString(trim($request->opd_allergy_symtom_type_id)),
                    "opd_allergy_id"=>trim($serial_opd_allergy_id),
                    "cross_group_check"=>trim($request->cross_group_check),
                    "opd_allergy_source_id"=>trim($request->opd_allergy_source_id),
                    "opd_allergy_type_id"=>IsNullOrEmptyString(trim($request->opd_allergy_type_id)),
                    "doctor_code"=>trim($request->doctor_code),
                    "dosage_text"=>trim($request->dosage_text),
                    "usage_text"=>trim($request->usage_text),
                    "lab_text"=>trim($request->lab_text)
                ]
            );

            return response()->json(
                [
                    'status_code' => '200',
                    'status_message' => 'Insert Success',
                    'info_message' => $results
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'info_message' => $e
                ]);
        }
    }

    public function delete_adr_hie_not_10715(Request $request)
    {
        $agent = trim($request->agent);
        $reporter = trim($request->hospcode_hn_opd_allergy_id);
        //$note = trim($request->note);
        $hospcode = trim($request->hospcode);
        switch ($hospcode) {
            case "10715":
              $note = "ประวัติแพ้ยาจาก รพ.แพร่";
              break;
            case "11452":
              $note = "ประวัติแพ้ยาจาก รพ.สมเด็จพระยุพราชเด่นชัย";
              break;
            case "11166":
              $note = "ประวัติแพ้ยาจาก รพ.ร้องกวาง";
              break;
            case "11167":
              $note = "ประวัติแพ้ยาจาก รพ.ลอง";
              break;
            case "11169":
              $note = "ประวัติแพ้ยาจาก รพ.สูงเม่น";
              break;
            case "11170":
              $note = "ประวัติแพ้ยาจาก รพ.สอง";
              break;
            case "11171":
              $note = "ประวัติแพ้ยาจาก รพ.วังชิ้น";
              break;
            case "11172":
              $note = "ประวัติแพ้ยาจาก รพ.หนองม่วงไข่";
              break;  
            default:
            $note = "NULL";
          }
        //   echo "agent ",$agent,"<br>";
        //   echo "reporter ",$reporter,"<br>";
        //   echo "hospcode ",$hospcode,"<br><br>";
        //   echo "note ",$note,"<br>";
        try
        {
            $results = DB::connection('hosxp4_SIT-1.6')->select("DELETE from opd_allergy WHERE agent LIKE '%$agent%' and note LIKE '%$note%' and reporter LIKE '%$reporter%';");

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Delete Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }
    public function delete_adr_log_after_ins_del(Request $request)
    {
        try
        {
 
            $results = DB::connection('hosxp4_SIT-1.6')->table('phraehosp_opd_allergy_log')
            ->delete();

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Delete Log Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }
    public function chk_dupicate_from_adr_to_v4(Request $request)
    {
        $hn = strtoupper($request->hn);
        $agent = strtoupper($request->agent);
        try
        {
            $results = DB::connection('hosxp4_SIT-1.6')->select("SELECT COUNT(*) AS Count from opd_allergy WHERE hn = '$hn' and UPPER(agent) LIKE '$agent';");

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'No record',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }
    public function check_stage_adr_inserts_local(Request $request)
    {
        try
        {
 
            $results = DB::connection('mysql2.11-HIE_drug_allergy')->table('check_stage')
            ->insert(
                [
                    "status" => trim($request->hospcode)
                ]
            );
            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Insert Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }
    public function delete_check_stage_adr_local(Request $request)
    {
        try
        {
 
            $results = DB::connection('mysql2.11-HIE_drug_allergy')->table('check_stage')
            ->delete();

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Delete Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }

    public function update_durable_good_check_mc(Request $request)
    {
        try
        {
            // echo $request->inv_durable_good_id,"<br>";
            // echo $request->inv_durable_good_code,"<br>";
            // echo $request->inv_durable_good_name,"<br>";
            // echo $request->inv_durable_good_date_receive,"<br>";
            // echo $request->inv_durable_good_brand_name,"<br>";
            // echo $request->inv_durable_good_model,"<br>";
            // echo $request->inv_durable_good_air_size,"<br>";
            // echo $request->inv_durable_good_installation_type,"<br>";
            // echo $request->inv_durable_good_building,"<br>";
            // echo $request->inv_durable_good_floor,"<br>";
            // echo $request->inv_durable_good_room,"<br>";
            // echo $request->phos_cid_checker,"<br>";
            // echo $request->inv_dep_id,"<br>";
            // echo $request->status,"<br>";
            // echo $request->inv_durable_good_use_time,"<br>";
            // echo $request->inv_durable_good_use_group,"<br>";
 
            $results = DB::connection('mysql2.11-durable_good')->table('durable_good_check')
            ->where('id', $request->inv_durable_good_id)
            ->update(
                [
                    // "inv_durable_good_id" => $request->inv_durable_good_id,
                    "inv_durable_good_code" => trim($request->inv_durable_good_code),
                    "inv_durable_good_name" => trim($request->inv_durable_good_name),
                    "inv_durable_good_date_receive" => trim($request->inv_durable_good_date_receive),
                    "inv_durable_good_brand_name" => trim($request->inv_durable_good_brand_name),
                    "inv_durable_good_model" => trim($request->inv_durable_good_model),
                    "inv_durable_good_air_size" => trim($request->inv_durable_good_air_size),
                    "inv_durable_good_installation_type" => trim($request->inv_durable_good_installation_type),
                    "inv_durable_good_building_id" => trim($request->inv_durable_good_building),
                    "inv_durable_good_floor" => trim($request->inv_durable_good_floor),
                    "inv_durable_good_room" => trim($request->inv_durable_good_room),
                    "phos_cid_checker" => trim($request->phos_cid_checker),
                    "inv_dep_id" => trim($request->inv_dep_id),
                    "status" => trim($request->status),
                    "inv_durable_good_use_time" => trim($request->inv_durable_good_use_time),
                    "inv_durable_good_use_group" => trim($request->inv_durable_good_use_group)
                ]
            );

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Update Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }
    public function delete_durable_good_check_mc(Request $request)
    {
        try
        {
 
            $results = DB::connection('mysql2.11-durable_good')->table('durable_good_check')
            ->where('id', $request->inv_durable_good_id)
            ->delete();

            return response()->json(
                [
                    'status_code' => '200OK',
                    'status_message' => 'Delete Success',
                    'info' => $results
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'status_code' => '500',
                    'status_message' => 'Server Error',
                    'error_message' => $e
                ]);
        }
    }

    
}
