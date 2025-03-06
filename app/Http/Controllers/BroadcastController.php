<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\TracerStudy;
use App\Models\Broadcast; // Pastikan untuk mengimpor model Broadcast

class BroadcastController extends Controller
{
    public function showForm()
    {
        // Return the broadcast view
        return view('broadcast');
    }

    private function getDeviceInfoFromApi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/device',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: KbT1byBescHGGFYxPk5M' // Replace with your actual token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Decode the JSON response
        $deviceInfo = json_decode($response, true);

        // Check if the response is valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null; // Return null if there's an error
        }

        return $deviceInfo; // Return the device information
    }

    public function create()
    {
        $alumnis = Alumni::with(['mahasiswa', 'tracerStudy'])->get();
        $broadcasts = Broadcast::with(['alumni.mahasiswa'])->get();
        // Return the view for creating a new broadcast
        return view('broadcast.create', compact('alumnis', 'broadcasts')); // Ensure this view exists
    }
    public function index()
    {
        // Retrieve all alumni with related mahasiswa and tracer_study data
        $alumnis = Alumni::with(['mahasiswa', 'tracerStudy'])->get();
        $broadcasts = Broadcast::with(['alumni.mahasiswa'])->get();
        // Get device information
        $deviceInfo = $this->getDeviceInfoFromApi(); // Call a new method to get device info

        // Return the view with alumni data and device information
        return view('broadcast.index', compact('alumnis', 'deviceInfo', 'broadcasts'));
    }

    public function sendMessage(Request $request)
    {
        // Validate input
        $request->validate([
            'message' => 'required|string|max:255',
            'targets' => 'required|array', // Validate array of targets
            'targets.*' => 'string', // Validate each element in the array
        ]);

        $messageTemplate = $request->input('message'); // Get message from input
        $targets = $request->input('targets'); // Get target numbers from input

        $preparedMessages = []; // Array to store prepared messages
        
        foreach ($targets as $target) {
            // Split the target value into alumni ID, phone number, and name
            list($alumniId, $phoneNumber, $name) = explode('|', $target);

            // Replace placeholders with actual values
            $message = str_replace('{name}', $name, $messageTemplate);
            $message = str_replace('{id}', $alumniId, $message); // Replace {id} with the alumni ID

            // Store prepared data in the array
            $preparedMessages[] = [
                'alumni_id' => $alumniId, // Store the alumni ID
                'target' => $phoneNumber, // Use phone number
                'message' => $message,
                'name' => $name,
            ];
        }

        // Send messages to API
        $token = "KbT1byBescHGGFYxPk5M"; // Replace with your actual API token
        $finalResults = []; // Array to store final results for database insertion

        foreach ($preparedMessages as $preparedMessage) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'target' => $preparedMessage['target'],
                    'message' => $preparedMessage['message'],
                )),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token", // Ensure Bearer format
                ),
            ));

            $response = curl_exec($curl);
            
            if ($response === false) {
                // Handle cURL error
                return response()->json(['error' => 'Curl error: ' . curl_error($curl)], 500);
            }

            curl_close($curl);

            // Decode the JSON response
            $decodedResponse = json_decode($response, true);

            // Check if decoding was successful and fields exist
            if (isset($decodedResponse['id']) && isset($decodedResponse['detail'])) {
                $id = $decodedResponse['id'][0]; // Get the first ID from the array
                $detail = $decodedResponse['detail'];

                // Prepare data for database insertion
                $finalResults[] = [
                    'alumni_id' => $preparedMessage['alumni_id'], // Store the alumni ID
                    'api_id' => $id, // Store the ID from the API response
                    'detail' => $detail, // Store the detail from the API response
                    'message' => $preparedMessage['message'], // Store the message
                    'target' => $preparedMessage['target'], // Store the target phone number
                ];
                $this->insertBroadcasts($finalResults);
                session()->flash('success', 'Messages sent successfully!');

                // Redirect to the broadcast index
                return redirect()->route('admin.broadcast.index');
            } else {
                // Handle case where required fields are missing
                session()->flash('error', 'Required fields are missing in the response.');

                // Redirect to the broadcast index
                return redirect()->route('admin.broadcast.index');
                // return response()->json(['error' => 'Required fields are missing in the response.'], 500);
            }
        }

    }

    private function insertBroadcasts(array $broadcasts)
    {
        foreach ($broadcasts as $broadcastData) {
            // Create a new instance of the Broadcast model
            $broadcast = new Broadcast();
            $broadcast->alumni_id = $broadcastData['alumni_id'];
            $broadcast->api_id = $broadcastData['api_id'];
            $broadcast->detail = $broadcastData['detail'];
            $broadcast->message = $broadcastData['message'];
            $broadcast->target = $broadcastData['target'];

            // Save the broadcast data to the database
            $broadcast->save();
        }
    }
}