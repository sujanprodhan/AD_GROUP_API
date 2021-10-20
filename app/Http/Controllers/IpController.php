<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class IpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    } //end __construct()


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ipList = DB::table('ips')->paginate(15);
        return response()->json($ipList->toArray());
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'label'     => 'required|string',
                'ip'      => 'required|ip'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        $ipTable            = new Ip();
        $ipTable->label     = $request->label;
        $ipTable->ip      = $request->ip;
        $ipTable->description = $request->description;

        if ($ipTable->save()) {
            // Add log for audit table
            $user = JWTAuth::parseToken()->authenticate();
            $auditTable = new Audit();
            $auditTable->user_id = $user->id; // Logged user id
            $auditTable->ip_id = $ipTable->id; // ip table id
            $auditTable->operation_type = "add"; // add or update type
            $auditTable->description = "add new ip"; // add or update ip
            $auditTable->save();
            if( $auditTable->save()){
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully save new ip.',
                    ]
                );
            }
            else{
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Failed!, audit log!',
                    ]
                );
            }


        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the ip  could not be saved!',
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function show(Ip $ip)
    {
        $audits = DB::table('audits')->paginate(15); // show-audit list 
        return response()->json($audits->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function edit(Ip $ip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ip $ip)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'label'     => 'required|string',
                'id' => 'required|integer',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        $ipTable            = new Ip();
        $ipTable->label     = $request->label;
        //$ipTable->ip      = $request->ip;
        $ipTable->description = $request->description;

        $ipTable->exists = true;
        $ipTable->id = $request->id; //already exists in database.

        if ($ipTable->save()) {
            // Add log for audit table
            $user = JWTAuth::parseToken()->authenticate();
            $auditTable = new Audit();
            $auditTable->user_id = $user->id; // Logged user id
            $auditTable->ip_id = $ipTable->id; // ip table id
            $auditTable->operation_type = "update"; // add or update type
            $auditTable->description = "update label"; // add or update ip
            $auditTable->save();
            if ($auditTable->save()) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully updated  ip label.',
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Failed!, audit log!',
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Sorry, the ip  could not be ipdated!',
                ]
            );
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ip $ip)
    {
        //
    }


    protected function guard()
    {
        return Auth::guard();
    } //end guard()



}
