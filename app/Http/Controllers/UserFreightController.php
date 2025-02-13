<?php

namespace App\Http\Controllers;
use Cache;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserFreightController extends Controller
{




    
    public function showFreightForm()
    {
        $cities = DB::table('cities')
            ->join('rates', function ($join) {
                $join->on('cities.id', '=', 'rates.origin');
            })
            ->where('rates.isActive', 1)
            ->select('cities.*')
            ->distinct()
            ->get();

        return view('freightBooking', compact('cities'));
    }

    public function showCalculator()
    {
        $cities = DB::table('cities')
            ->join('rates', function ($join) {
                $join->on('cities.id', '=', 'rates.origin');
            })
            ->where('rates.isActive', 1)
            ->select('cities.*')
            ->distinct()
            ->get();

            // $check = Cache::put('name', 'ansar',1);
            // $value = Cache::get('name');

            // DD($value);
        return view('rateCalculator', compact('cities'));
    }


    public function getDestinations($origin)
    {
        $destinations = DB::table('cities')
            ->join('rates', 'cities.id', '=', 'rates.destination')
            ->where('rates.origin', $origin)
            ->where('rates.isActive', 1)
            ->select('cities.id', 'cities.name')
            ->distinct()
            ->get();

        return response()->json($destinations);
    }



    public function getFreightPrice(Request $request)
    {
        
        $request->validate([
            'origin' => 'required|integer',
            'destination' => 'required|integer',
        ]);

        $origin = $request->input('origin');
        $destination = $request->input('destination');

        
        $rate = DB::table('rates')
            ->where('origin', $origin)
            ->where('destination', $destination)
            ->where('isActive', 1)
            ->first();

        if ($rate) {
            return response()->json([
                'success' => true,
                'price' => $rate->rate
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No rates found for the selected route.'
            ]);
        }
    }



    public function bookFreight(Request $req)
    {
        // DD('yes');
        $freightDetails = $req->validate([
            'originAddress' => 'required|string',
            'originCityId' => 'required|integer',
            'destinationAddress' => 'required|string',
            'destinationCityId' => 'required|integer',
            'date' => 'required|date',
            'weight' => 'required|numeric',
            'price' => 'required|integer',
        ]);

        
        // \Log::info('Freight Booking Data:', $freightDetails);

        $prefix = 'FR-';
        $userID = Auth::id();
        $freightID = $prefix . $userID . time();

      
        $data = DB::table('freights')->insert([
            'origin' => $freightDetails['originAddress'],
            'currentLocation' => $freightDetails['originAddress'],
            'destination' => $freightDetails['destinationAddress'],
            'weight' => $freightDetails['weight'],
            'charges' => $freightDetails['price'],
            'freightDate' => $freightDetails['date'],
            'freightID' => $freightID,
            'freightStatus' => '1',
            'userID' => $userID,
        ]);

        // DD('$data');
        if ($data) {
            return redirect()->back()->with('freightID', $freightID);
        } else {
            return redirect()->back()->with('freightID', "Failed booking");
        }
     
    }




    public function trackShipment(Request $req)
    {
        $validatedData = $req->validate([
            'freightID' => 'required',
        ], [
            'freightID.required' => 'Enter Freight ID.',
        ]);
        $freightID = $validatedData['freightID'];

        $shipmentData = DB::table('freights')
        ->where('freightID', $freightID)
        ->join('freight_status', 'freights.freightStatus', '=', 'freight_status.id')
        ->select('freights.*', 'freight_status.status as freight_status' )
        ->first();
        if ($shipmentData) {
            $shipmentData->estimatedArrivalDate = Carbon::parse($shipmentData->freightDate)->addDays(3)->toDateString();
        } else {
            $shipmentData = 1;

        }
        
        return view('trackShipments', ['shipment' => $shipmentData]);
    }

    public function showPayments()
    {
        $userID = Auth::id();
        $freights = DB::table('freights')
            ->where('userID', $userID)
            ->get();

        return view('payments', ['freights' => $freights]);
    }

    public function cancelFreight($freightID)
    {
        $freight = DB::table('freights')->where('freightID', $freightID)->first();

        if ($freight) {
            DB::table('freights')->where('freightID', $freightID)->delete();
            return redirect()->back()->with('success', 'Freight cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Freight not found.');
    }
    public function doPayment($freightID)
    {
        $data = DB::table('freights')
            ->where('freightID', $freightID)
            ->update([
                'freightStatus' => '2',
            ]);

        if ($data) {
            return redirect()->route('payments')->with('success', 'Freight status updated to pending');
        } else {
            return back()->with('error', 'Failed to update freight status');
        }
    }


}
