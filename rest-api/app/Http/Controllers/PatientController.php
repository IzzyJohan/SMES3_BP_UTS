<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    #Fungsi index untuk menerima (GET) data pasien
    public function index()
    {
        $patients = Patient::all();

        if ($patients) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'message' => 'Data is empty',
            ];
            return response()->json($data, 200);
        }
    }

    #Fungsi store untuk upload (POST) data pasien
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => "required",
            'phone' => "required|numeric",
            'address' => "required",
            'status' => "required",
            'in_date_at' => "required|date",
            'out_date_at' => "required|date"
        ]);

        $patients = Patient::create($validateData);

        $data = [
            'message' => 'Resource is added succesfully',
            'data' => $patients       
        ];

        return response()->json($data, 201);
    }

    #Fungsi show untuk menerima (GET) data pasien by id
    public function show($id) 
    {
        $patients = Patient::find($id);

        if ($patients) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $patients
            ];

            return response() -> json($data, 200);
        }

        else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response() -> json($data, 404);
        }
    }

    #Fungsi update untuk update (PUT) data pasien 
    public function update(Request $request, $id)
    {
        $patients = Patient::find($id);

        if ($patients) {
     
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at
            ];
    
            $patients->update($input);

            $data = [
                'message' => "Resource is update successfully",
                'data' => $patients
            ];

            return response()->json($data, 200);    
        }

        else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 404);
        }
    }

    #Fungsi destroy untuk menghapus (DELETE) data pasien
    public function destroy(Request $request, $id)
    {
        $patients = Patient::find($id);

        if ($patients) {
            $patients->delete();

            $data = [
                'message' => 'Resource is delete successfully',
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 404);
        }
    }

    #Fungsi search untuk menerima data pasien (GET) by nama pasien
    public function search($name) 
    {

        $patients = Patient::where('name', 'like', '%' .$name. '%')->get();

        if ($patients) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $patients
            ];

            return response() -> json($data, 200);
        }

        else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response() -> json($data, 404);
        }
    }

    #Fungsi status untuk menerima data pasien (GET) by status pasien 
    public function status($status) 
    {

        $patient = Patient::where('status', 'like', '%' .$status. '%')->get();

        if ($patient && $status == 'positive') {
            $data = [
                'message' => 'Get positive resource',
                'data' => $patient
            ];

            return response() -> json($data, 200);
        }

        if ($patient && $status == 'recovered') {
            $data = [
                'message' => 'Get recovered resource',
                'data' => $patient
            ];

            return response() -> json($data, 200);
        }

        if ($patient && $status == 'dead') {
            $data = [
                'message' => 'Get dead resource',
                'data' => $patient
            ];

            return response() -> json($data, 200);
        }

        else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response() -> json($data, 404);
        }
    }
}

