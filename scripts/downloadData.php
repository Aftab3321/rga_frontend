<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/load.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $loggedinUser = current_user();
    $requestType = $db->escape($_POST['requestType']);

    if ($loggedinUser['ID'] == 1) {
        if ($requestType == "downloadCompleteData") {
            // Fetch data from the database
            $query = "SELECT
                invitee.id,
                invitee.name,
                COALESCE(profiles.profile_title, 'Quiz Not Taken Yet') AS Profile_title,
                COALESCE(invitee.language_preference, 'Language Not Selected Yet') AS language_preference,
                COALESCE(invitee.mobile_number, 'Quiz Not Taken Yet') AS mobile_number,
                invitee.unique_link,
                COALESCE(admins.name, 'Self Created Profile') AS invited_by_name,
                invitee.created_on
            FROM
                invitee
            LEFT JOIN
                profiles ON invitee.profile_id = profiles.id
            LEFT JOIN
                admins ON invitee.invited_by = admins.id;";
            $result = $db->query($query);

            $filename = tempnam(sys_get_temp_dir(), 'invitee_data_');
            $output = fopen($filename, 'w');

            if ($db->num_rows($result) > 0) {
                
                // Set the CSV headers for download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="invitee_data.csv"');
                //output the CSV header
                fputcsv($output, array('ID', 'Name', 'Profile Title', 'Language Selected', 'Mobile Number', 'Unique Link', 'Uploaded By', 'Date'));

                //output data
                while($row = $db->fetch_assoc($result)) {
                    fputcsv($output, $row);
                }

                //close the file pointer
                fclose($output);


                // Read the file and output it directly to the browser
                readfile($filename);

                // Remove the temporary file
                unlink($filename);
            } else {
                http_response_code(404);
                $response_message = ["message" => "No data to download"];
                header("Content-Type: Application/json");
                echo json_encode($response_message);
            }
        } elseif ($requestType == "downloadHalfData") {

            // Fetch data from the database
            $query = "SELECT
                invitee.id,
                COALESCE(profiles.profile_title, 'Quiz Not Taken Yet') AS Profile_title,
                COALESCE(invitee.mobile_number, 'Quiz Not Taken Yet') AS mobile_number,
                invitee.unique_link,
                invitee.created_on
            FROM
                invitee
            LEFT JOIN
                profiles ON invitee.profile_id = profiles.id";
            $result = $db->query($query);

            $filename = tempnam(sys_get_temp_dir(), 'invitee_data_');
            $output = fopen($filename, 'w');

            if ($db->num_rows($result) > 0) {
                
                // Set the CSV headers for download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="invitee_data.csv"');
                //output the CSV header
                fputcsv($output, array('ID', 'Profile Title', 'Mobile Number', 'Unique Link', 'Date'));

                //output data
                while($row = $db->fetch_assoc($result)) {
                    fputcsv($output, $row);
                }

                //close the file pointer
                fclose($output);


                // Read the file and output it directly to the browser
                readfile($filename);

                // Remove the temporary file
                unlink($filename);
            } else {
                http_response_code(404);
                $response_message = ["message" => "No data to download"];
                header("Content-Type: Application/json");
                echo json_encode($response_message);
            }
            
        }
    } else {
        http_response_code(400);
        $response_message = ["message" => "You are not allowed to perform this action"];
        header("Content-Type: Application/json");
        echo json_encode($response_message);
    }
} else {
    http_response_code(400);
    $response_message = ["message" => "Failed to submit the data"];
    header("Content-Type: Application/json");
    echo json_encode($response_message);
}



?>