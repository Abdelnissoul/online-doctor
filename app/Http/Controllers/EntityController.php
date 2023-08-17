<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Entity;
use App\Models\EntityCopy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mikehaertl\pdftk\Pdf;

class EntityController extends Controller
{
    public function entity_copy()
    {
        // $ent = EntityCopy::where('copy_name','Copy Certified of%')->get();
        $ent = EntityCopy::where('copy_name', 'like', 'Copy Plain of%')->get();

        return response()->json($ent);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $service)
    {
        // $data = $request->validate([
        //     'entity_name' => 'required',
        // ]);
        if ($service == 6) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_document_category = $request->entity_document_category;
            if ($request->entity_document_category == "Business Entity") {
                $entity->entity_file_type = $request->entity_file_type;
                $entity->entity_location = $request->entity_location;
                $entity->entity_type = $request->entity_type;
            } else if ($request->entity_document_category == "Lien") {
                $entity->entity_lien_type = $request->entity_lien_type;
                $entity->entity_lien_creditor = $request->entity_lien_creditor;
                $entity->entity_lien_secured_party = $request->entity_lien_secured_party;
            } else if ($request->entity_document_category == "Statement of Information (SOI)") {
                $entity->entity_statement_type = $request->entity_statement_type;
            } else {

            }

            $entity->entity_corporate_number = $request->entity_corporate_number;

            $entity->entity_corporate_kit = $request->entity_corporate_kit;
            $entity->entity_prepare_documents = $request->entity_prepare_documents;
            $entity->entity_registered_agent = $request->entity_registered_agent;
            $entity->entity_ucc_monitor_status = $request->entity_ucc_monitor_status;

            $entity->entity_rush_type = $request->entity_rush_type;

            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->business_name != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Business Name Availabity";
                $entity_copy->save();
            } else {

            }
            if ($request->preclearance != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Preclearance : " . $request->preclearance;
                $entity_copy->save();
            } else {

            }

            if ($request->number_pages != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Number Of Pages";
                // console . log($request->number_pages);
                $entity_copy->copy_quantity = $request->number_pages;

                $entity_copy->save();
            } else {

            }

            if ($request->plain_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copies";
                $entity_copy->copy_quantity = $request->plain_copies;
                $entity_copy->save();
            } else {

            }
            if ($request->certified_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Certified Copies";
                $entity_copy->copy_quantity = $request->certified_copies;
                $entity_copy->save();
            } else {

            }
        } else if ($service == 5) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_document_category = $request->entity_document_category;
            $entity->entity_type = $request->entity_type;
            $entity->entity_location = $request->entity_location;
            $entity->entity_file_type = $request->entity_file_type;
            $entity->entity_lien_type = $request->entity_lien_type;
            $entity->entity_lien_secured_party = $request->entity_lien_secured_party;
            $entity->entity_lien_creditor = $request->entity_lien_creditor;
            $entity->entity_statement_type = $request->entity_statement_type;
            $entity->entity_corporate_number = $request->entity_corporate_number;
            // $entity->entity_corporate_kit = $request->entity_corporate_kit;
            // $entity->entity_prepare_documents = $request->entity_prepare_documents;
            $entity->entity_registered_agent = $request->entity_registered_agent;
            $entity->entity_ucc_monitor_status = $request->entity_ucc_monitor_status;
            $entity->entity_rush = $request->entity_rush;

            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            // $date_ = date("Y-m-d");
            // $data = [
            //     'date' => $date_,
            //     'mail' => 'Yes'
            // ];
            // $filename = 'document_retrieval_entity_' . $entity->entity_id . '.pdf';
            // $pdf = new Pdf('C:\\xampp\\htdocs\\CORP2000\\public\\pdf\\doc_retrieval.pdf');
            // $pdf->fillForm($data)->saveAs('C:\\xampp\\htdocs\\CORP2000\\public\\pdf\\'.$filename);
            // var_dump($pdf);

            if ($request->bring_down_letter != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Bring Down Letter";
                $entity_copy->copy_quantity = $request->bring_down_letter;
                $entity_copy->save();
            } else {

            }
            if ($request->certificate_of_status_good_standing != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Certificate of Status";
                $entity_copy->copy_quantity = $request->certificate_of_status_good_standing;
                $entity_copy->save();
            } else {

            }
            if ($request->franchise_tax_board != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Franchise Tax Board (FTB)";
                $entity_copy->copy_quantity = $request->franchise_tax_board;
                $entity_copy->save();
            } else {

            }

            if ($request->all_document_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "All document plain";
                $entity_copy->copy_quantity = $request->all_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->all_document_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "All document certified";
                $entity_copy->copy_quantity = $request->all_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->formation_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Formation plain";
                $entity_copy->copy_quantity = $request->formation_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->formation_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Formation certified";
                $entity_copy->copy_quantity = $request->formation_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->amendments_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Amendments plain";
                $entity_copy->copy_quantity = $request->amendments_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->amendments_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Amendments certified";
                $entity_copy->copy_quantity = $request->amendments_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->restated_forward_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Restated Forward plain";
                $entity_copy->copy_quantity = $request->restated_forward_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->restated_forward_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Restated Forward certified";
                $entity_copy->copy_quantity = $request->restated_forward_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->last_complete_soi_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Last complete SOI plain";
                $entity_copy->copy_quantity = $request->last_complete_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->last_complete_soi_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Last Complete SOI certified";
                $entity_copy->copy_quantity = $request->last_complete_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->last_no_change_soi_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Last No Change SOI plain";
                $entity_copy->copy_quantity = $request->last_no_change_soi_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->last_no_change_soi_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Last No Change SOI certified";
                $entity_copy->copy_quantity = $request->last_no_change_soi_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->all_soi_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "All Statements of Information Plain";
                $entity_copy->copy_quantity = $request->all_soi_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->all_soi_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "All Statements of Information Certified";
                $entity_copy->copy_quantity = $request->all_soi_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->specific_copies_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Specific Copies Plain";
                $entity_copy->copy_quantity = $request->specific_copies_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->specific_copies_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Specific Copies certified";
                $entity_copy->copy_quantity = $request->specific_copies_quantity;
                $entity_copy->save();
            } else {

            }

            if ($request->other_document_plain != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = 'Copy Plain of ' . $request->other;
                $entity_copy->copy_quantity = $request->other_quantity;
                $entity_copy->save();
            } else {

            }
            if ($request->other_document_certified != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = 'Copy Certified of ' . $request->other;
                $entity_copy->copy_quantity = $request->other_quantity;
                $entity_copy->save();
            } else {

            }

        } else if ($service == 2) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_official_name = $request->entity_official_name;
            $entity->entity_rush = $request->entity_rush;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();
            if ($request->number_authentications != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Authentications";
                $entity_copy->copy_quantity = $request->number_authentications;
                $entity_copy->save();
            } else {

            }
        } else if ($service == 1) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_location = $request->entity_location;
            $entity->entity_ucc_monitor_status = $request->entity_ucc_monitor_status;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();
        } else if ($service == 3) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_rush_type = $request->entity_rush_type;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->preclearance != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Preclearance : " . $request->preclearance;
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copies";
                $entity_copy->copy_quantity = $request->plain_copies;
                $entity_copy->save();
            } else {

            }
            if ($request->certified_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Certified Copies";
                $entity_copy->copy_quantity = $request->certified_copies;
                $entity_copy->save();
            } else {

            }
        } else if ($service == 4) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_numbers_of_shares = $request->entity_numbers_of_shares;
            $entity->entity_file_date = $request->entity_file_date;
            $entity->entity_corporate_number = $request->entity_corporate_number;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();
        } else if ($service == 7) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_search_scope = $request->entity_search_scope;
            $entity->entity_search_type = $request->entity_search_type;
            $entity->entity_search_federal_bankruptcy = $request->entity_search_federal_bankruptcy;
            $entity->entity_rush = $request->entity_rush;
            $entity->entity_search_federal_district = $request->entity_search_federal_district;
            $entity->entity_search_superior_municipal = $request->entity_search_superior_municipal;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->search_type != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Search Type : " . $request->search_type;
                $entity_copy->save();
            } else {

            }

            if ($request->search_federal_bankruptcy != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Search Federal Bankruptcy";
                $entity_copy->copy_quantity = $request->search_federal_bankruptcy;
                $entity_copy->save();
            } else {

            }
            if ($request->search_federal_district != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Search Federal District";
                $entity_copy->copy_quantity = $request->search_federal_district;
                $entity_copy->save();
            } else {

            }
            if ($request->search_superior_municipal != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Search Superior Municipal";
                $entity_copy->copy_quantity = $request->search_superior_municipal;
                $entity_copy->save();
            } else {

            }

            if ($request->plain_copy_report_only != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Report Only";
                $entity_copy->save();
            } else {

            }

            if ($request->plain_copy_complaint != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Complaint";
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copy_entire_case_file != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Entire Case File";
                $entity_copy->save();
            } else {

            }
            if ($request->complaint != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Complaint";
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copy_docket != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Docket";
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copy_answer_response_pleading != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Answer Response Pleading";
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copy_final_judgment != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copy Final Judgment";
                $entity_copy->save();
            } else {

            }

        } else if ($service == 8) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_primary_service = $request->entity_primary_service;
            $entity->entity_type = $request->entity_type;

            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->all_names != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Reserve All Names";
                $entity_copy->save();
            } else {

            }

        } else if ($service == 9) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

        } else if ($service == 10) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_rush_type = $request->entity_rush_type;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->preclearance != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Preclearance : " . $request->preclearance;
                $entity_copy->save();
            } else {

            }
            if ($request->plain_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copies";
                $entity_copy->copy_quantity = $request->plain_copies;
                $entity_copy->save();
            } else {

            }
            if ($request->certified_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Certified Copies";
                $entity_copy->copy_quantity = $request->certified_copies;
                $entity_copy->save();
            } else {

            }

        } else if ($service == 11) {
            $entity = new Entity();
            $entity->work_order_id = $id;
            $entity->entity_name = $request->entity_name;
            $entity->entity_rush = $request->entity_rush;
            $entity->entity_ucc_monitor_status = $request->entity_ucc_monitor_status;
            $entity->entity_type = "OTHER";
            $entity->entity_state = "CA";
            $entity->entity_jurisdiction = "Secretary of State";
            $entity->entity_status = "New";
            $entity->entity_primary_service = $service;
            $entity->entity_owner_user_id = Auth::user()->user_id;
            $entity->save();

            if ($request->search_certified_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Certified Copies";
                $entity_copy->copy_quantity = $request->d_search_forward_date;
                $entity_copy->save();
            } else {

            }

            if ($request->search_plain_copies != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Plain Copies";
                $entity_copy->copy_quantity = $request->d_search_forward_date;
                $entity_copy->save();
            } else {

            }

            if ($request->search_report_only != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Report Only Copies";
                $entity_copy->copy_quantity = $request->d_search_forward_date;
                $entity_copy->save();
            } else {

            }

            if ($request->search_to_reflect != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = $request->search_to_reflect;
                $entity_copy->save();
            } else {

            }

            if ($request->all != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "All(UCC/FTL/STL/JMT)";
                $entity_copy->save();
            } else {

            }

            if ($request->county_tax_lien != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "County Tax";
                $entity_copy->save();
            } else {

            }

            if ($request->federal_tax_lien_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Federal Tax";
                $entity_copy->save();
            } else {

            }

            if ($request->fixture_filing != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Fixture Filing";
                $entity_copy->save();
            } else {

            }

            if ($request->judgment_lien_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Judgment Lien";
                $entity_copy->save();
            } else {

            }

            if ($request->mechanic_lien_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Mechanic Lien";
                $entity_copy->save();
            } else {

            }

            if ($request->dot_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "Deed of Trust";
                $entity_copy->save();
            } else {

            }

            if ($request->state_tax_lien_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "State Tax Lien";
                $entity_copy->save();
            } else {

            }

            if ($request->district_tax_lien != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "District Tax Lien";
                $entity_copy->save();
            } else {

            }

            if ($request->ucc_search != null) {
                $entity_copy = new EntityCopy();
                $en = DB::table('entity')->pluck('entity_id')->last();
                error_log($en);
                $entity_copy->entity_id = $en;
                $entity_copy->copy_name = "UCC";
                $entity_copy->save();
            } else {

            }

        } else {

        }

        return response()->json(['success' => 'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Entity::find($id);
        $contact = Contact::where('contact_id', $entity->entity_contact_id)->first();
        $entity->setAttribute('contact', $contact);
        if ($entity->entity_primary_service == 5) {

            $entity_copy_all_document_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'All document plain')->first();
            if (isset($entity_copy_all_document_plain)) {
                $entity->setAttribute('entity_copy_all_document_plain', $entity_copy_all_document_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_all_document_plain', '');
            }

            $entity_copy_all_document_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'All document certified')->first();
            if (isset($entity_copy_all_document_certified)) {
                $entity->setAttribute('entity_copy_all_document_certified', $entity_copy_all_document_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_all_document_certified', '');
            }

            $entity_copy_formation_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Formation plain')->first();
            if (isset($entity_copy_formation_plain)) {
                $entity->setAttribute('entity_copy_formation_plain', $entity_copy_formation_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_formation_plain', '');
            }

            $entity_copy_formation_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Formation certified')->first();
            if (isset($entity_copy_formation_certified)) {
                $entity->setAttribute('entity_copy_formation_certified', $entity_copy_formation_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_formation_certified', '');
            }

            $entity_copy_amendments_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Amendments plain')->first();
            if (isset($entity_copy_amendments_plain)) {
                $entity->setAttribute('entity_copy_amendments_plain', $entity_copy_amendments_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_amendments_plain', '');
            }

            $entity_copy_amendments_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Amendments certified')->first();
            if (isset($entity_copy_amendments_certified)) {
                $entity->setAttribute('entity_copy_amendments_certified', $entity_copy_amendments_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_amendments_certified', '');
            }

            $entity_copy_restated_forward_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Restated Forward plain')->first();
            if (isset($entity_copy_restated_forward_plain)) {
                $entity->setAttribute('entity_copy_restated_forward_plain', $entity_copy_restated_forward_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_restated_forward_plain', '');
            }

            $entity_copy_restated_forward_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Restated Forward certified')->first();
            if (isset($entity_copy_restated_forward_certified)) {
                $entity->setAttribute('entity_copy_restated_forward_certified', $entity_copy_restated_forward_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_restated_forward_certified', '');
            }

            $entity_copy_last_complete_soi_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Last complete SOI plain')->first();
            if (isset($entity_copy_last_complete_soi_plain)) {
                $entity->setAttribute('entity_copy_last_complete_soi_plain', $entity_copy_last_complete_soi_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_last_complete_soi_plain', '');
            }

            $entity_copy_last_complete_soi_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Last Complete SOI certified')->first();
            if (isset($entity_copy_last_complete_soi_certified)) {
                $entity->setAttribute('entity_copy_last_complete_soi_certified', $entity_copy_last_complete_soi_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_last_complete_soi_certified', '');
            }

            $entity_copy_last_no_change_soi_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Last No Change SOI plain')->first();
            if (isset($entity_copy_last_no_change_soi_plain)) {
                $entity->setAttribute('entity_copy_last_no_change_soi_plain', $entity_copy_last_no_change_soi_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_last_no_change_soi_plain', '');
            }

            $entity_copy_last_no_change_soi_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Last No Change SOI certified')->first();
            if (isset($entity_copy_last_no_change_soi_certified)) {
                $entity->setAttribute('entity_copy_last_no_change_soi_certified', $entity_copy_last_no_change_soi_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_last_no_change_soi_certified', '');
            }

            $entity_copy_all_statements_of_information_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'All Statements of Information Plain')->first();
            if (isset($entity_copy_all_statements_of_information_plain)) {
                $entity->setAttribute('entity_copy_all_statements_of_information_plain', $entity_copy_all_statements_of_information_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_all_statements_of_information_plain', '');
            }

            $entity_copy_all_statements_of_information_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'All Statements of Information Certified')->first();
            if (isset($entity_copy_all_statements_of_information_certified)) {
                $entity->setAttribute('entity_copy_all_statements_of_information_certified', $entity_copy_all_statements_of_information_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_all_statements_of_information_certified', '');
            }

            $entity_copy_specific_copies_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Specific Copies Plain')->first();
            if (isset($entity_copy_specific_copies_plain)) {
                $entity->setAttribute('entity_copy_specific_copies_plain', $entity_copy_specific_copies_plain->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_specific_copies_plain', '');
            }

            $entity_copy_specific_copies_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Specific Copies certified')->first();
            if (isset($entity_copy_specific_copies_certified)) {
                $entity->setAttribute('entity_copy_specific_copies_certified', $entity_copy_specific_copies_certified->copy_quantity);
            } else {
                $entity->setAttribute('entity_copy_specific_copies_certified', '');
            }

            $entity_copy_other_plain = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'like', 'Copy Plain of%')->first();
            if (isset($entity_copy_other_plain)) {
                $entity->setAttribute('entity_copy_other_plain', $entity_copy_other_plain->copy_quantity);
                $name = str_replace('Copy Plain of', ' ', $entity_copy_other_plain->copy_name);
                $entity->setAttribute('entity_copy_other_name', $name);
            } else {
                $entity->setAttribute('entity_copy_other_plain', '');
            }

            $entity_copy_other_certified = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'like', 'Copy Certified of%')->first();
            if (isset($entity_copy_other_certified)) {
                $entity->setAttribute('entity_copy_other_certified', $entity_copy_other_certified->copy_quantity);
                $name = str_replace('Copy Certified of', ' ', $entity_copy_other_certified->copy_name);
                $entity->setAttribute('entity_copy_other_name', $name);

            } else {
                $entity->setAttribute('entity_copy_other_certified', '');
            }

            $certificate_of_status = EntityCopy::where('entity_id', $entity->entity_id)->where('copy_name', 'Certificate of Status')->first();
            if (isset($certificate_of_status)) {
                $entity->setAttribute('certificate_of_status', $certificate_of_status->copy_quantity);
            } else {
                $entity->setAttribute('certificate_of_status', '');
            }

        }
        return response()->json($entity);
    }

    public function pdf(Request $request, $id)
    {
        if ($request->mail == true) {
            $mail = 'Yes';
        } else {
            $mail = '';
        }

        if ($request->pick_up == true) {
            $pick_up = 'Yes';
        } else {
            $pick_up = '';
        }

        if ($request->entity_type_other == true) {
            $entity_type_other = 'Yes';
        } else {
            $entity_type_other = '';
        }

        if ($request->entity_type_corp == true) {
            $corp = 'Yes';
        } else {
            $corp = '';
        }

        if ($request->entity_type_llc == true) {
            $llc = 'Yes';
        } else {
            $llc = '';
        }

        if ($request->entity_type_lp == true) {
            $lp = 'Yes';
        } else {
            $lp = '';
        }

        if ($request->entity_type_gp == true) {
            $gp = 'Yes';
        } else {
            $gp = '';
        }

        if ($request->entity_type_llp == true) {
            $llp = 'Yes';
        } else {
            $llp = '';
        }

        if ($request->copies_12 == true) {
            $copies_12 = 'Yes';
        } else {
            $copies_12 = '';
        }

        if ($request->copies_12_1 == true) {
            $copies_12_1 = 'Yes';
        } else {
            $copies_12_1 = '';
        }

        $data = [
            'date' => $request->date,
            'attention' => $request->attention,
            'wo_number' => $request->wo_number,
            'sender_name' => $request->sender_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'mail' => $mail,
            'pick_up' => $pick_up,

            'entity_name' => $request->entity_name,
            'entity_number' => $request->entity_number,
            'entity_type_corp' => $corp,
            'entity_type_llc' => $llc,
            'entity_type_lp' => $lp,
            'entity_type_gp' => $gp,
            'entity_type_llp' => $llp,
            'entity_type_other' => $entity_type_other,
            'entity_type_other_text' => $request->entity_type_other_text,

            'copies_count_101' => $request->copies_count_101,
            'copies_count_1' => $request->copies_count_1,

            'copies_count_202' => $request->copies_count_202,
            'copies_count_2' => $request->copies_count_2,

            'copies_count_303' => $request->copies_count_303,
            'copies_count_3' => $request->copies_count_3,

            'copies_count_404' => $request->copies_count_404,
            'copies_count_4' => $request->copies_count_4,

            'copies_count_505' => $request->copies_count_505,
            'copies_count_5' => $request->copies_count_5,

            'copies_count_606' => $request->copies_count_606,
            'copies_count_6' => $request->copies_count_6,

            'copies_count_111' => $request->copies_count_111,
            'copies_count_222' => $request->copies_count_222,

            'other_doc' => $request->other_doc,
            'copies_count_707' => $request->copies_count_707,
            'copies_count_7' => $request->copies_count_7,

            'copies_count_8' => $request->copies_count_8,
            'copies_count_9' => $request->copies_count_9,
            'copies_count_10' => $request->copies_count_10,
            'copies_count_11' => $request->copies_count_11,

            'copies_12' => $copies_12,
            'copies_12_1' => $copies_12_1,
            'fax_number' => $request->fax_number,
            'signature' => $request->signature,

        ];
        $filename = 'document_retrieval_entity_' . $id . '.pdf';
        $pdf = new Pdf(public_path('/pdf/doc_retrieval.pdf'));
        $pdf->fillForm($data)->flatten()->saveAs(public_path('/pdf/' . $filename));
        // $pdf->fillForm($data)->saveAs(public_path('/pdf/' . $filename));
        var_dump($pdf);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
