<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Service;
use App\Models\AppointmentStatus;
use Illuminate\Support\Facades\Validator;


class AppointmentController extends Controller
{
    public function showList(Request $request)
    {
        $hospitalId = session('LoggedInfo')->HospitalId;

        // Get the filter date from the request
        $filterDate = $request->input('filter_date');

        // Fetch appointments filtered by date if filter_date is provided
        $appointmentsQuery = Appointment::with(['doctor', 'patient', 'service', 'status'])
            ->where('HospitalId', $hospitalId);

        if ($filterDate) {
            $appointmentsQuery->whereDate('DateTime', $filterDate); // Filter by date
        }

        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        $appointments = $appointmentsQuery->get();

        //dd($appointments);
        $patients = Patient::all();

        return view('admin.appointment.list', compact('appointments', 'PatientNo', 'patients'));
    }


    public function createForm($id)
    {
        // dd("Create New Appointment.",$id);
        $hospitalId = session('LoggedInfo')->HospitalId;
        $patient = Patient::where('Id', $id)->first();
        $doctors = User::query()->select('Id', 'FirstName', 'LastName')
            ->where('HospitalId', $hospitalId)
            ->where('RoleId', 3)
            ->get();
        $service = Service::all();
        $status = AppointmentStatus::all();
        // dd($patient, $doctors, $service, $status);

        return view('admin.appointment.create', compact('patient', 'status', 'doctors', 'service'));

        // $AppointmentNo = '21';
        // $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        // $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;
        // return view('admin.appointment.create', compact('PatientNo','AppointmentNo'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'DoctorId' => 'required',
            'ServiceId' => 'required',
            'StatusId' => 'required',
            'Duration' => 'required',
            'Date' => 'required',
            'Hour' => 'required',
            'Minute' => 'required',
            'AmPm' => 'required',
            'ReferBy' => 'nullable',
        ]);
        $hospitalId = session('LoggedInfo')->HospitalId;
        $appointment = $appointment = Appointment::where('HospitalId', 1)
            ->orderBy('id', 'desc')
            ->first();

        $newAppointmentNumber = $appointment['AppointmentTokenNo'] + 1;
        // dd($appointment['AppointmentTokenNo']);
        $appointment = new Appointment();

        $time = $this->convertTo24HourFormat($request->Hour, $request->Minute, $request->AmPm);

        $dateTime = $request->Date . ' ' . $time;

        $appointment->AppointmentTokenNo = $newAppointmentNumber;
        $appointment->DoctorId = $request->DoctorId;
        $appointment->PatientId = $id;
        $appointment->ServiceId = $request->ServiceId;
        $appointment->StatusId = $request->StatusId ?? '';
        $appointment->ReffernceBy = $request->ReferBy ?? null;
        $appointment->DateTime = $dateTime;
        $appointment->Duration = $request->Duration;
        $appointment->HospitalId = $hospitalId;

        $appointment->save();
        // Return a success message
        return redirect()->route('admin.appointment')->with('success', 'Patient updated successfully!');
    }


    public function createPatientForm()
    {
        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;
        return view('admin.appointment.create-patient', compact('PatientNo'));
    }

    public function storePatientForm(Request $request)
    {

        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'MobileNo' => 'required|digits:10',
        ]);

        $patient = new Patient();

        $patient->FirstName = $request->FirstName;
        $patient->LastName = $request->LastName;
        $patient->Email = $request->Email;
        $patient->MobileNo = $request->MobileNo;
        $patient->Address = $request->Address;
        $patient->Dob = $request->Dob;
        $patient->Gender = $request->Gender;
        $patient->Age = $request->Age;
        $patient->BloodGroup = $request->BloodGroup;
        $patient->City = $request->City;
        $patient->Pin = $request->Pin;
        $patient->HospitalId = session('LoggedInfo')->HospitalId;
        $patient->PatientNo = $request->input('PatientNo');

        // $doctors = Doctor::all();
        // $services = Service::all();

        $patient->save();
        $insertedId = $patient->id;

        return redirect()->route('admin.appointment.add', ['id' => $insertedId])->with('success', 'Patient updated successfully!');

        // return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        // $patient = Patient::findOrFail($id);
        // $patient->delete();
        $patient = Appointment::where('Id', $id)->delete();

        return redirect()->route('admin.appointment')->with('success', 'Appointment deleted successfully.');
    }

    private function convertTo24HourFormat($hour, $minute, $amPm)
    {
        // Convert to 24-hour time format
        $hour = (int) $hour;
        $minute = (int) $minute;

        if ($amPm == 'PM' && $hour != 12) {
            $hour += 12;
        }

        if ($amPm == 'AM' && $hour == 12) {
            $hour = 0;
        }

        return sprintf('%02d:%02d:00', $hour, $minute);
    }

    public function editForm($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'service', 'status'])->where('Id', $id)->first();

        if (!$appointment) {
            abort(404, 'Appointment not found');
        }
        $hospitalId = session('LoggedInfo')->HospitalId;

        $doctors = User::query()->select('Id', 'FirstName', 'LastName')
            ->where('HospitalId', $hospitalId)
            ->where('RoleId', 3)
            ->get();
        $services = Service::all();
        $statuses = AppointmentStatus::all();
        return view('admin.appointment.edit', [
            'appointment' => $appointment,
            'doctors' => $doctors,
            'services' => $services,
            'statuses' => $statuses,
        ]);
    }

    public function update(Request $request, $id)
    {

        // Validation
        // $request->validate([
        //     'DoctorId' => 'required|exists:doctor,Id',
        //     'ServiceId' => 'required|exists:service,Id',
        //     'StatusId' => 'required|exists:appointmentstatus,Id',
        //     'Duration' => 'required'
        // ]);

        // Combine Date, Hour, Minute, and AmPm to create a DateTime string
        $date = $request->input('Date');
        $hour = $request->input('Hour');
        $minute = $request->input('Minute');
        $ampm = $request->input('AmPm');

        // Convert 12-hour format to 24-hour format
        if ($ampm == 'PM' && $hour != 12) {
            $hour += 12; // Convert PM hour to 24-hour format
        } elseif ($ampm == 'AM' && $hour == 12) {
            $hour = 0; // Convert 12 AM to 00 in 24-hour format
        }

        // Combine into a DateTime string
        $dateTimeString = $date . ' ' . sprintf('%02d', $hour) . ':' . sprintf('%02d', $minute) . ':00';

        $updateData = [
            'AppointmentTokenNo' => $request->input('AppointmentTokenNo'),
            'DoctorId' => $request->input('DoctorId'),
            'ServiceId' => $request->input('ServiceId'),
            'StatusId' => $request->input('StatusId'),
            'ReffernceBy' => $request->input('ReffernceBy'),
            'DateTime' => $dateTimeString,
            'Duration' => $request->input('Duration'),
        ];

        // Save the appointment
        $appointment = Appointment::where('Id', $id)->update($updateData);

        // Redirect or return response
        return redirect()->route('admin.appointment')->with('success', 'appointment updated successfully!');

    }

}
