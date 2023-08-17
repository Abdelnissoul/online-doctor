<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Entity;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function ordermax()
    {
        $ordermax = DB::table('orders')->orderbydesc('order_id')->pluck('order_id')->first();
        return response()->json($ordermax);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('order_primary_contact_id', '!=', null)->orderbydesc('created_at')->get();
        foreach ($orders as $order) {
            $contact = DB::table('contacts')->where('contact_id', $order->order_primary_contact_id)->first();
            if ($contact != null) {
                $order->setAttribute('contact', $contact);
                $count = DB::table('entity')->where('work_order_id', $order->order_id)->count();
                $order->setAttribute('count', $count);
            }
        }
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        $order->save();
        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('order_id', $id)->first();
        $array = Entity::where('entity_status', 'New')->where('work_order_id', $order->order_id)->distinct()->pluck('entity_primary_service');
        $entities = Entity::where('entity_status', 'New')->where('work_order_id', $order->order_id)->get();
        foreach ($entities as $entity) {
            $service = Service::where('service_id', $entity->entity_primary_service)->first();
            $entity->setAttribute('service', $service);
            $user = User::where('user_id', $entity->entity_owner_user_id)->first();
            $entity->setAttribute('user', $user);
        }
        $company = Company::where('clientid', $order->order_primary_contact_id)->first();
        $services = Service::whereIn('service_id', $array)->get();
        $contact = Contact::where('contact_id', $order->order_primary_contact_id)->first();
        $user_owner = User::where('user_id', $order->order_owner_user_id)->first();
        $user_create = User::where('user_id', $order->order_create_user_id)->first();
        $order->setAttribute('entities', $entities);
        $order->setAttribute('contact', $contact);
        $order->setAttribute('services', $services);
        $order->setAttribute('company', $company);
        $order->setAttribute('user_owner', $user_owner);
        $order->setAttribute('user_create', $user_create);
        return response()->json($order);
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
        $order = Order::where('order_id', $id)->update([
            'order_matter_num' => $request->input('order_matter_num'),
            'order_primary_contact_id' => $request->input('order_primary_contact_id'),
            'order_additional_note' => $request->input('order_additional_note'),
            'order_special_note' => $request->input('order_special_note'),
            'order_shipping_type' => $request->input('order_shipping_type'),
            'order_account_number' => $request->input('order_account_number'),
            'order_status' => 'New',
            'order_owner_user_id' => Auth::user()->user_id,
            'order_create_user_id' => Auth::user()->user_id,
        ]);

        $entities = Entity::where('work_order_id', $id)->get();
        foreach ($entities as $entity) {
            $ent = Entity::find($entity->entity_id);
            $ent->entity_contact_id = $request->input('order_primary_contact_id');
            $ent->save();
            // if ($ent->entity_primary_service == 5) {
            //     $corp = '';
            //     $llc = '';
            //     $llp = '';
            //     $gp = '';
            //     $other = '';

            //     if ($ent->entity_type == "Corporation (CORP)") {
            //         $corp = 'Yes';
            //     } else if ($ent->entity_type == "Limited Liability Company") {
            //         $llc = 'Yes';
            //     } else if ($ent->entity_type == "Limited Liability Partnership (LLP)") {
            //         $llp = 'Yes';
            //     } else if ($ent->entity_type == "General Partnership (GP)") {
            //         $gp = 'Yes';
            //     } else if ($ent->entity_type == "Other Business Filings (Other)") {
            //         $other = 'Yes';
            //     } else {

            //     }

            //     $entity_copy_all_document_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'All document plain')->first();
            //     $entity_copy_all_document_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'All document certified')->first();
            //     $entity_copy_formation_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Formation plain')->first();
            //     $entity_copy_formation_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Formation certified')->first();
            //     $entity_copy_amendments_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Amendments plain')->first();
            //     $entity_copy_amendments_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Amendments certified')->first();
            //     $entity_copy_restated_forward_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Restated Forward plain')->first();
            //     $entity_copy_restated_forward_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Restated Forward certified')->first();
            //     $entity_copy_last_complete_soi_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Last complete SOI plain')->first();
            //     $entity_copy_last_complete_soi_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Last Complete SOI certified')->first();
            //     $entity_copy_last_no_change_soi_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Last No Change SOI plain')->first();
            //     $entity_copy_last_no_change_soi_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Last No Change SOI certified')->first();
            //     $entity_copy_all_statements_of_information_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'All Statements of Information Plain')->first();
            //     $entity_copy_all_statements_of_information_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'All Statements of Information Certified')->first();
            //     $entity_copy_specific_copies_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Specific Copies Plain')->first();
            //     $entity_copy_specific_copies_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Specific Copies certified')->first();
            //     $entity_copy_other_plain = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'like', 'Copy Plain of%')->first();
            //     $entity_copy_other_certified = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'like', 'Copy Certified of%')->first();

            //     $certificate_of_status = EntityCopy::where('entity_id', $ent->entity_id)->where('copy_name', 'Certificate of Status')->first();

            //     $date_ = date("Y-m-d");

            //     $contact = Contact::where('contact_id', $ent->entity_contact_id)->first();

            //     $all_document_plain = '';
            //     $all_document_certified = '';
            //     if (isset($entity_copy_all_document_plain)) {
            //         $all_document_plain = $entity_copy_all_document_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_all_document_certified)) {
            //         $all_document_certified = $entity_copy_all_document_certified->copy_quantity;
            //     }

            //     $formation_plain = '';
            //     $formation_certified = '';
            //     if (isset($entity_copy_formation_plain)) {
            //         $formation_plain = $entity_copy_formation_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_formation_certified)) {
            //         $formation_certified = $entity_copy_formation_certified->copy_quantity;
            //     }

            //     $amendments_plain = '';
            //     $amendments_certified = '';
            //     if (isset($entity_copy_amendments_plain)) {
            //         $amendments_plain = $entity_copy_amendments_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_amendments_certified)) {
            //         $amendments_certified = $entity_copy_amendments_certified->copy_quantity;
            //     }

            //     $last_complete_soi_plain = '';
            //     $last_complete_soi_certified = '';
            //     if (isset($entity_copy_last_complete_soi_plain)) {
            //         $last_complete_soi_plain = $entity_copy_last_complete_soi_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_last_complete_soi_certified)) {
            //         $last_complete_soi_certified = $entity_copy_last_complete_soi_certified->copy_quantity;
            //     }

            //     $last_no_change_soi_plain = '';
            //     $last_no_change_soi_certified = '';
            //     if (isset($entity_copy_last_no_change_soi_plain)) {
            //         $last_no_change_soi_plain = $entity_copy_last_no_change_soi_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_last_no_change_soi_certified)) {
            //         $last_no_change_soi_certified = $entity_copy_last_no_change_soi_certified->copy_quantity;
            //     }

            //     $all_statements_of_information_plain = '';
            //     $all_statements_of_information_certified = '';
            //     if (isset($entity_copy_all_statements_of_information_plain)) {
            //         $all_statements_of_information_plain = $entity_copy_all_statements_of_information_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_all_statements_of_information_certified)) {
            //         $all_statements_of_information_certified = $entity_copy_all_statements_of_information_certified->copy_quantity;
            //     }

            //     $specific_copies_plain = '';
            //     $specific_copies_certified = '';
            //     if (isset($entity_copy_specific_copies_plain)) {
            //         $specific_copies_plain = $entity_copy_specific_copies_plain->copy_quantity;
            //     }
            //     if (isset($entity_copy_specific_copies_certified)) {
            //         $specific_copies_certified = $entity_copy_specific_copies_certified->copy_quantity;
            //     }

            //     $other_plain = '';
            //     $other_certified = '';
            //     $name = '';
            //     if (isset($entity_copy_other_plain)) {
            //         $other_plain = $entity_copy_other_plain->copy_quantity;
            //         $name = str_replace('Copy Plain of', ' ', $entity_copy_other_plain->copy_name);
            //     }
            //     if (isset($entity_copy_other_certified)) {
            //         $other_certified = $entity_copy_other_certified->copy_quantity;
            //         $name = str_replace('Copy Certified of', ' ', $entity_copy_other_certified->copy_name);
            //     }

            //     $certificate = '';
            //     if (isset($certificate_of_status)) {
            //         $certificate = $certificate_of_status->copy_quantity;
            //     }

            //     $data = [
            //         'date' => $date_,
            //         'attention' => $contact->contact_fname . ' ' . $contact->contact_lname,
            //         'wo_number' => $ent->work_order_id,
            //         'sender_name' => 'Corp2000',
            //         'address' => '720 14th Street',
            //         'city' => 'Sacramento',
            //         'state' => 'CA',
            //         'zip' => '95814',
            //         'phone1' => '916',
            //         'phone2' => '448',
            //         'phone3' => '1397',
            //         'mail' => '',
            //         'pick_up' => 'Yes',

            //         'entity_name' => $ent->entity_name,
            //         'entity_number' => '',
            //         'entity_type_corp' => $corp,
            //         'entity_type_llc' => $llc,
            //         'entity_type_lp' => '',
            //         'entity_type_gp' => $gp,
            //         'entity_type_llp' => $llp,
            //         'entity_type_other' => $other,
            //         'entity_type_other_text' => '',

            //         'copies_count_101' => $all_document_plain,
            //         'copies_count_1' => $all_document_certified,

            //         'copies_count_202' => $formation_plain,
            //         'copies_count_2' => $formation_certified,

            //         'copies_count_303' => $amendments_plain,
            //         'copies_count_3' => $amendments_certified,

            //         'copies_count_404' => $last_complete_soi_plain,
            //         'copies_count_4' => $last_complete_soi_certified,

            //         'copies_count_505' => $last_no_change_soi_plain,
            //         'copies_count_5' => $last_no_change_soi_certified,

            //         'copies_count_606' => $all_statements_of_information_plain,
            //         'copies_count_6' => $all_statements_of_information_certified,

            //         'copies_count_111' => $specific_copies_plain,
            //         'copies_count_222' => $specific_copies_certified,

            //         'other_doc' => $name,
            //         'copies_count_707' => $other_plain,
            //         'copies_count_7' => $other_certified,

            //         'copies_count_8' => $certificate,
            //         'copies_count_9' => '',
            //         'copies_count_10' => '',
            //         'copies_count_11' => '',

            //         'copies_12' => '',
            //         'copies_12_1' => '',
            //         'fax_number' => '',

            //     ];

            //     $filename = 'document_retrieval_entity_' . $ent->entity_id . '.pdf';
            //     $pdf = new Pdf('C:\\xampp\\htdocs\\CORP2000\\public\\pdf\\doc_retrieval.pdf');
            //     $pdf->fillForm($data)->saveAs('C:\\xampp\\htdocs\\CORP2000\\public\\pdf\\' . $filename);
            // }

        }
        return $this->refresh();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        $orders = Order::where('order_primary_contact_id', '!=', null)->orderbydesc('created_at')->get();
        foreach ($orders as $order) {
            $contact = DB::table('contacts')->where('contact_id', $order->order_primary_contact_id)->first();
            if ($contact != null) {
                $order->setAttribute('contact', $contact);
                $count = DB::table('entity')->where('work_order_id', $order->order_id)->count();
                $order->setAttribute('count', $count);
            }
        }
        return response()->json($orders);
    }

    public function orders_new()
    {
        return view('orders.status.new');
    }

    public function new_orders()
    {

        $orders = Order::where('order_primary_contact_id', '!=', null)->where('order_status', 'New')->orderbydesc('created_at')->get();
        foreach ($orders as $order) {
            $count = Entity::where('entity_status', 'New')->where('work_order_id', $order->order_id)->count();
            $order->setAttribute('count', $count);
            $company = Company::where('clientid', $order->order_primary_contact_id)->first();
            $order->setAttribute('company', $company);

        }
        return response()->json($orders);
    }

    function new () {
        return view('orders.new');
    }

    private function refresh()
    {
        $orders = Order::where('order_primary_contact_id', '!=', null)->orderbydesc('created_at')->get();
        foreach ($orders as $order) {
            $contact = DB::table('contacts')->where('contact_id', $order->order_primary_contact_id)->first();
            if ($contact != null) {
                $order->setAttribute('contact', $contact);
                $count = DB::table('entity')->where('work_order_id', $order->order_id)->count();
                $order->setAttribute('count', $count);
            }
        }
        return response()->json($orders);
    }

}
