<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalFreights = DB::table('freights')->count();
        $paymentPending = DB::table('freights')->where('freightStatus', '1')->count();
        $pendingDispatch = DB::table('freights')->where('freightStatus', '2')->count();
        $inTransit = DB::table('freights')->where('freightStatus', '3')->count();
        $Delivered = DB::table('freights')->where('freightStatus', '4')->count();

        return view('dashboard', compact('totalFreights', 'paymentPending', 'pendingDispatch', 'inTransit', 'Delivered'));
    }



    public function showTrips(Request $req)
    {
        $trips = DB::table('trips')
            ->join('drivers', 'trips.driverID', '=', 'drivers.id')
            ->join('vehicles', 'trips.vehicleID', '=', 'vehicles.id')
            ->select(
                'trips.id as trip_id',
                'trips.*',
                'drivers.id as driver_id',
                'drivers.name as driver_name',
                'vehicles.id as vehicle_id',
                'vehicles.regNumber as vehicle_reg_number'
            )
            ->get();

        return view('trips', ['trips' => $trips]);
    }
    public function deleteTrip($id)
    {
        // DD($id);
        DB::table('trips')->where('id', $id)->delete();
        return redirect()->route('manage.trips')->with('success', 'Trip deleted successfully');
    }
    public function addTrips()
    {
        $drivers = DB::table('drivers')->get();
        $vehicles = DB::table('vehicles')->get();
        // DD($vehicles);
        return view('tripsForm', ['drivers' => $drivers, 'trip' => null, 'vehicles' => $vehicles]);
    }

    public function storeTrips(Request $req)
    {
        $tripdata = $req->validate([
            'vehicleID' => 'required',
            'driverID' => 'required',
            'startingpoint' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distancecovered' => 'required|numeric',
            'charges' => 'required|numeric',
        ]);
        $store = DB::table('trips')->insert([
            'vehicleID' => $tripdata['vehicleID'],
            'driverID' => $tripdata['driverID'],
            'startingPoint' => $tripdata['startingpoint'],
            'destination' => $tripdata['destination'],
            'distanceCovered' => $tripdata['distancecovered'],
            'charges' => $tripdata['charges'],
        ]);
        if ($store) {
            return redirect()->route('manage.trips');
        }
    }

    public function editTrip($id)
    {
        // Fetch the trip and drivers
        $trip = DB::table('trips')->where('id', $id)->first();
        $drivers = DB::table('drivers')->get();
        $vehicles = DB::table('vehicles')->get();
        // Pass the trip and drivers to the view
        return view('tripsForm', ['trip' => $trip, 'drivers' => $drivers, 'vehicles' => $vehicles]);
    }


    public function updateTrip(Request $req, $id)
    {
        $req->validate([
            'vehicleID' => 'required|numeric',
            'driverID' => 'required|numeric',
            'startingpoint' => 'required|string',
            'destination' => 'required|string',
            'distancecovered' => 'required|numeric',
            'charges' => 'required|numeric',
        ]);

        DB::table('trips')->where('id', $id)->update([
            'vehicleID' => $req->input('vehicleID'),
            'driverID' => $req->input('driverID'),
            'startingPoint' => $req->input('startingpoint'),
            'destination' => $req->input('destination'),
            'distanceCovered' => $req->input('distancecovered'),
            'charges' => $req->input('charges'),
        ]);

        return redirect()->route('manage.trips')->with('success', 'Trip updated successfully!');
    }



    public function addExpense(Request $req)
    {
        return view('expenseForm', ['expense' => null]);
    }

    public function storeExpense(Request $req)
    {
        $expenseData = $req->validate([
            'expensetype' => 'required|string|max:255',
            'expenseamount' => 'required|numeric',
            'expensedate' => 'required|date',
        ], [
            'expensetype.required' => 'The expense type is required',
            'expenseamount.required' => 'The expense amount is required',
            'expensedate.required' => 'The expense date is required',
        ]);
        $data = DB::table('expenses')->insert([
            'type' => $expenseData['expensetype'],
            'amount' => $expenseData['expenseamount'],
            'date' => $expenseData['expensedate'],
        ]);

        if ($data) {
            return redirect()->route('manage.expense');
        }
    }

    public function editExpense($id)
    {

        $expense = DB::table('expenses')->where('id', $id)->first();

        return view('expenseForm', ['expense' => $expense]);
    }


    public function updateExpense(Request $req, $id)
    {
        $expenseData = $req->validate([
            'expensetype' => 'required|string|max:255',
            'expenseamount' => 'required|numeric',
            'expensedate' => 'required|date',
        ], [
            'expensetype.required' => 'The expense type is required',
            'expenseamount.required' => 'The expense amount is required',
            'expensedate.required' => 'The expense date is required',
        ]);
        // DD($expenseData);
        $data = DB::table('expenses')->where('id', $id)
            ->update([
                'type' => $expenseData['expensetype'],
                'amount' => $expenseData['expenseamount'],
                'date' => $expenseData['expensedate'],
            ]);
        if ($data) {
            return redirect()->route('manage.expense');
        }
    }


    public function incomeForm(Request $req)
    {
        return view('incomeForm', ['income' => null]);
    }

    public function storeIncome(Request $req)
    {
        $incomeData = $req->validate([
            'incomesource' => 'required|string|max:255',
            'incomeamount' => 'required|numeric',
            'incomedate' => 'required|date',
        ], [
            'incomesource.required' => 'The income Source is required',
            'incomeamount.required' => 'The income amount is required',
            'incomedate.required' => 'The income date is required',
        ]);
        $data = DB::table('incomes')->insert([
            'source' => $incomeData['incomesource'],
            'amount' => $incomeData['incomeamount'],
            'date' => $incomeData['incomedate'],
        ]);

        if ($data) {
            return redirect()->route('manage.income');
        }
    }

    public function editIncome($id)
    {

        $income = DB::table('incomes')->where('id', $id)->first();

        return view('incomeForm', ['income' => $income]);
    }

    public function updateIncome(Request $req, $id)
    {
        $incomeData = $req->validate([
            'incomesource' => 'required|string|max:255',
            'incomeamount' => 'required|numeric',
            'incomedate' => 'required|date',
        ], [
            'incomesource.required' => 'The income Source is required',
            'incomeamount.required' => 'The income amount is required',
            'incomedate.required' => 'The income date is required',
        ]);
        $data = DB::table('incomes')->where('id', $id)
            ->update([
                'source' => $incomeData['incomesource'],
                'amount' => $incomeData['incomeamount'],
                'date' => $incomeData['incomedate'],
            ]);
        // DD( $incomeData);
        if ($data) {
            return redirect()->route('manage.income');
        }
    }

    public function driverForm(Request $req)
    {
        return view('driverForm', ['driver' => null]);
    }
    public function storeDriver(Request $req)
    {
        // dd($req->driverNumber);
        $driverData = $req->validate([
            'drivername' => 'required|string|max:255',
            'driverLicense' => 'required|numeric ',
            'driverNumber' => 'required|numeric | digits:11',
        ], [
            'drivername.required' => 'The driver name is required',
            'driverLicense.required' => 'The driver license is required',
            'driverNumber.required' => 'The driver number is required',
            'driverNumber.size' => 'The driver number must be exactly 11 digits.',
        ]);
        // dd($driverData);
        $data = DB::table('drivers')->insert([
            'name' => $driverData['drivername'],
            'licenseNumber' => $driverData['driverLicense'],
            'phoneNumber' => $driverData['driverNumber'],
        ]);

        if ($data) {
            return redirect()->route('manage.driver');
        }
    }

    public function editDriver($id)
    {
        $driver = DB::table('drivers')->where('id', $id)->first();

        return view('driverForm', ['driver' => $driver]);
    }
    public function updateDriver(Request $req, $id)
    {
        $driverData = $req->validate([
            'drivername' => 'required|string|max:255',
            'driverLicense' => 'required|numeric',
            'driverNumber' => 'required|numeric',
        ], [
            'drivername.required' => 'The driver name is required',
            'driverLicense.required' => 'The driver license is required',
            'driverNumber.required' => 'The driver number is required',
        ]);
        // DD($driverData);
        $data = DB::table('drivers')->where('id', $id)
            ->update([
                'name' => $driverData['drivername'],
                'licenseNumber' => $driverData['driverLicense'],
                'phoneNumber' => $driverData['driverNumber'],
            ]);

        if ($data) {
            return redirect()->route('manage.driver');
        }
    }

    public function showPendingFreights(Request $req)
    {
        $freights = DB::table('freights')
            ->join('users', 'freights.userID', '=', 'users.id')
            ->join('freight_status', 'freights.freightStatus', '=', 'freight_status.id')
            ->select('freights.*', 'users.name as user_name', 'freight_status.status as freight_status')
            ->get();

        $status = DB::table('freight_status')->get();
        return view('adminPanel', data: ['freights' => $freights, 'status' => $status]);
    }

    public function getFreightsByStatus($statusId)
    {
        if ($statusId == 0) {
            return $this->getAllFreights();
        }
    
        $freights = DB::table('freights')
            ->join('users', 'freights.userID', '=', 'users.id')
            ->join('freight_status', 'freights.freightStatus', '=', 'freight_status.id')
            ->where('freights.freightStatus', $statusId) 
            ->select('freights.*', 'users.name as user_name' , 'freight_status.status as freight_status' )
            ->get();
    
        return response()->json($freights);
    }
    
    public function getAllFreights()
    {
        $freights = DB::table('freights')
            ->join('users', 'freights.userID', '=', 'users.id')
            ->join('freight_status', 'freights.freightStatus', '=', 'freight_status.id')
            ->select('freights.*', 'users.name as user_name' , 'freight_status.status as freight_status' )
            ->get();
    
        return response()->json($freights);
    }
    

    // public function showDeliveredFreights(Request $req)
    // {
    //     $deliveredFreights = DB::table('freights')
    //         ->where('freightStatus', '=', 'Delivered')
    //         ->get();
    //     return view('deliveredFreight', ['freights' => $deliveredFreights]);
    // }


    public function editFreights($id)
    {
        $freight = DB::table('freights')->where('freightID', $id)->first();
        // $status = DB::table('freight_status')->where('id', '>=', $freight->freightStatus)->get();
        $status = DB::table('freight_status')->get();
    //    DD($status);
        return view('editFreight', ['freight' => $freight , 'status' => $status]);
    }

    public function updateFreights(Request $request, $id)
    {
        $request->validate([
            'currentLocation' => 'required|string',
            'freightStatus' => 'required|string',
        ]);

        $updated = DB::table('freights')
            ->where('freightID', $id)
            ->update([
                'currentLocation' => $request->currentLocation,
                'freightStatus' => $request->freightStatus,
            ]);
        if ($updated) {
            return redirect()->route('admin.panel')->with('success', 'Freight updated successfully');
        } else {
            return back()->with('error', 'Failed to update freight');
        }
    }








    public function showExpense(Request $req)
    {
        $expenses = DB::table('expenses')->get();
        return view('expense', ['expenses' => $expenses]);
    }
    public function deleteExpense($id)
    {
        DB::table('expenses')->where('id', $id)->delete();
        return redirect()->route('manage.expense')->with('success', 'expense deleted successfully');
    }


    public function showIncome(Request $req)
    {
        $incomes = DB::table('incomes')->get();
        return view('income', ['incomes' => $incomes]);
    }

    public function deleteIncome($id)
    {
        DB::table('incomes')->where('id', $id)->delete();

        return redirect()->route('manage.income')->with('success', 'income deleted successfully');
    }
    public function showDriver(Request $req)
    {
        $drivers = DB::table('drivers')->get();
        return view('driver', ['drivers' => $drivers]);
    }

    public function deleteDriver($id)
    {
        DB::table('drivers')->where('id', $id)->delete();

        return redirect()->route('manage.driver')->with('success', 'driver deleted successfully');
    }

    public function storeVehicle(Request $req)
    {
        $driverData = $req->validate([
            'vehicleregistration' => 'required|string|max:255',
            'vehiclemodel' => 'required|numeric',
            'companyName' => 'required|string',
        ], [
            'vehicleregistration.required' => 'The vehicle registration number is required',
            'vehiclemodel.required' => 'The vehicle model is required',
            'companyName.required' => 'The company name is required',
        ]);
        $data = DB::table('vehicles')->insert([
            'regNumber' => $driverData['vehicleregistration'],
            'model' => $driverData['vehiclemodel'],
            'companyName' => $driverData['companyName'],
        ]);

        if ($data) {
            return redirect()->route('manage.vehicle');
        }
    }

    public function editVehicle($id)
    {
        $vehicle = DB::table('vehicles')->where('id', $id)->first();

        return view('vehicleForm', ['vehicle' => $vehicle]);
    }

    public function updateVehicle(Request $req, $id)
    {
        $driverData = $req->validate([
            'vehicleregistration' => 'required|string|max:255',
            'vehiclemodel' => 'required|numeric',
            'companyName' => 'required|string',
        ], [
            'vehicleregistration.required' => 'The vehicle registration number is required',
            'vehiclemodel.required' => 'The vehicle model is required',
            'companyName.required' => 'The company name is required',
        ]);
        // DD($driverData);
        $data = DB::table('vehicles')->where('id', $id)
            ->update([
                'regNumber' => $driverData['vehicleregistration'],
                'model' => $driverData['vehiclemodel'],
                'companyName' => $driverData['companyName'],
            ]);

        if ($data) {
            return redirect()->route('manage.vehicle');
        }
    }

    public function showVehicleForm(Request $req)
    {
        return view('vehicleForm', ['vehicle' => null]);
    }
    public function showVehicles(Request $req)
    {
        $vehicles = DB::table('vehicles')->get();
        return view('vehicle', ['vehicles' => $vehicles]);
    }

    public function deleteVehicles($id)
    {
        DB::table('vehicles')->where('id', $id)->delete();

        return redirect()->route('manage.vehicle')->with('success', 'Vehicle deleted successfully');
    }


    public function generateReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $expenses = [];
        $incomes = [];

        if ($start_date && $end_date) {
            $expenses = DB::table('expenses')->whereBetween('date', [$start_date, $end_date])->get();

            $incomes = DB::table('incomes')->whereBetween('date', [$start_date, $end_date])->get();
        }

        $totalExpense = $expenses->sum('amount');
        $totalIncome = $incomes->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        return view('report', compact('expenses', 'incomes', 'totalExpense', 'totalIncome', 'netProfit'));
    }


    public function showLocations()
    {
        $rates = DB::table('rates')
            ->join('cities as origin_city', 'rates.origin', '=', 'origin_city.id')
            ->join('cities as destination_city', 'rates.destination', '=', 'destination_city.id')
            ->select('rates.*', 'origin_city.name as origin_name', 'destination_city.name as destination_name')
            ->get();
        return view('locations', ['rates' => $rates]);
    }

    public function createLocation()
    {
        $cities = DB::table('cities')->get();
        return view('locationsForm', ['rate' => null, 'cities' => $cities]);
    }

    public function storeLocation(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'rate' => 'required|numeric',
            'isActive' => 'required|boolean',
        ]);

        $exists = DB::table('rates')
            ->where('origin', $validated['origin'])
            ->where('destination', $validated['destination'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'This origin-destination combination already exists.']);
        }

        DB::table('rates')->insert($validated);
        return redirect()->route('locations')->with('success', 'Location added successfully!');
    }

    public function editLocation($id)
    {
        $cities = DB::table('cities')->get();
        $rate = DB::table('rates')->where('id', $id)->first();
        return view('locationsForm', ['rate' => $rate, 'cities' => $cities]);
    }

    public function updateLocation(Request $request, $id)
    {
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'rate' => 'required|numeric',
            'isActive' => 'required|boolean',
        ]);

        $exists = DB::table('rates')
            ->where('origin', $validated['origin'])
            ->where('destination', $validated['destination'])
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'This origin-destination combination already exists.']);
        }

        DB::table('rates')->where('id', $id)->update($validated);
        return redirect()->route('locations')->with('success', 'Location updated successfully!');
    }

    public function destroyLocation($id)
    {
        DB::table('rates')->where('id', $id)->delete();
        return redirect()->route('locations')->with('success', 'Location deleted successfully!');
    }
}
