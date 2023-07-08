<link rel="stylesheet" href="<?= base_url('app_') ?>assets/css/style.css" />
<!-- [ Main Content ] start -->

<?php //$nurseData = (isset($nurseData[0]) && !empty($nurseData[0])) ? $nurseData[0] : []; ?>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Personal Information</h4>
                <table class="table">
                    <tbody>
                       
                        <tr>
                            <td>Name</td>
                            <td><?php echo (isset($nurseData->cg_fname) && $nurseData->cg_fname != "") ? $nurseData->cg_fname.' '.$nurseData->cg_lname : ""; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Mobile No.</td>
                            <td><?php echo (isset($nurseData->cg_mobile) && $nurseData->cg_mobile != "") ? $nurseData->cg_mobile : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Profile Pic</td>
                            <td><?php echo (isset($nurseData->cg_profile_pic) && $nurseData->cg_profile_pic != "") ? '<img src="'.base_url($row->cg_profile_pic).'" width="50%" />' : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo (isset($nurseData->cg_address) && $nurseData->cg_address != "") ? $nurseData->cg_address : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo (isset($nurseData->cg_country) && $nurseData->cg_country != "") ? getCountry($nurseData->cg_country) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><?php echo (isset($nurseData->cg_state) && $nurseData->cg_state != "") ? getState($nurseData->cg_state) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo (isset($nurseData->cg_city) && $nurseData->cg_city != "") ? $nurseData->cg_city : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td><?php echo (isset($nurseData->cg_zipcode) && $nurseData->cg_zipcode != "") ? $nurseData->cg_zipcode : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Hours Completed</td>
                            <td><?php echo (isset($nurseData->hours_completed) && $nurseData->hours_completed != "") ? $nurseData->hours_completed : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Total Earned</td>
                            <td><?php echo (isset($nurseData->total_earned) && $nurseData->total_earned != "") ? $nurseData->total_earned : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Average Rating</td>
                            <td><?php echo (isset($nurseData->average_rating) && $nurseData->average_rating != "") ? $nurseData->average_rating : ""; ?></td>
                        </tr>
                        <tr>
                            <td>License State</td>
                            <td><?php echo (isset($nurseData->license_state) && $nurseData->license_state != "") ? getKeyword($nurseData->license_state) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Speciality</td>
                            <td><?php echo (isset($nurseData->speciality) && $nurseData->speciality != "") ? getKeyword($nurseData->speciality) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>License Number</td>
                            <td><?php echo (isset($nurseData->license_number) && $nurseData->license_number != "") ? $nurseData->license_number : ""; ?></td>
                        </tr>
                        <tr>
                            <td>License Type</td>
                            <td><?php echo (isset($nurseData->license_type) && $nurseData->license_type != "") ? getKeyword($nurseData->license_type) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Search Status</td>
                            <td><?php echo (isset($nurseData->search_status) && $nurseData->search_status != "") ? $nurseData->search_status : ""; ?></td>
                        </tr>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Preferences Information</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Hourly charges</td>
                            <td><?php echo (isset($nurseData->hourly_charges) && $nurseData->hourly_charges != "") ? $nurseData->hourly_charges : ""; ?></td>
                        </tr>

                        <tr>
                            <td>Availability</td>
                            <td><?php echo (isset($nurseData->availability) && $nurseData->availability != "") ? getKeyword($nurseData->availability) : ""; ?></td>
                        </tr>

                        <tr>
                            <td>Shift Duration</td>
                            <td><?php echo (isset($nurseData->shift_duration) && $nurseData->shift_duration != "") ? getKeyword($nurseData->shift_duration) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Assignment duration</td>
                            <td><?php echo (isset($nurseData->assignment_duration) && $nurseData->assignment_duration != "") ? getKeyword($nurseData->assignment_duration) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Preferred shift</td>
                            <td><?php echo (isset($nurseData->preferred_shift) && $nurseData->preferred_shift != "") ? getKeyword($nurseData->preferred_shift) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Preferred geography</td>
                            <td><?php echo (isset($nurseData->preferred_geography) && $nurseData->preferred_geography != "") ? getKeyword($nurseData->preferred_geography) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Earliest Start Date</td>
                            <td><?php echo (isset($nurseData->earliest_start_date) && $nurseData->earliest_start_date != "") ? date('d-m-Y',strtotime($nurseData->earliest_start_date)) : ""; ?></td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Documents</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Resume</td>
                            <td><?php echo (isset($nurseData->resume_path) && $nurseData->resume_path != "") ? '<a href="'.base_url().'app_assets/uploads/careGiver/'.$nurseData->resume_path.'">'.$nurseData->resume.'<a>' : ""; ?></td>
                        </tr>

                        <tr>
                            <td>Experience Letters</td>
                            <td><?php 
                                    foreach($nurseData->docs as $doc){
                                        if($doc->type == 1){
                                            echo (isset($doc->filepath) && $doc->filepath != "") ? '<a href="'.base_url().'app_assets/uploads/careGiver/'.$doc->filepath.'">'.$doc->file_name.'<a>' : ""; 
                                        }  
                                    }
                            ?></td>
                        </tr>

                        <tr>
                            <td>Certificates</td>
                            <td><?php 
                                    foreach($nurseData->docs as $doc){
                                        if($doc->type == 2){
                                            echo (isset($doc->filepath) && $doc->filepath != "") ? '<a href="'.base_url().'app_assets/uploads/careGiver/'.$doc->filepath.'">'.$doc->file_name.'<a><br>' : ""; 
                                        }  
                                    }
                            ?></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Professional Information</h4>
                <table class="table">
                    <tbody>

                        <tr>
                            <td>Nurse Degree</td>
                            <td><?php echo (isset($nurseData->nurse_degree) && $nurseData->nurse_degree != "") ? getKeyword($nurseData->nurse_degree) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>University Name</td>
                            <td><?php echo (isset($nurseData->university_name) && $nurseData->university_name != "") ? $nurseData->university_name : ""; ?></td>
                        </tr>
                        <tr>
                            <td>University Country</td>
                            <td><?php echo (isset($nurseData->university_country) && $nurseData->university_country != "") ? getCountry($nurseData->university_country) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>University State</td>
                            <td><?php echo (isset($nurseData->university_state) && $nurseData->university_state != "") ? getState($nurseData->university_state) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>University city</td>
                            <td><?php echo (isset($nurseData->university_city) && $nurseData->university_city != "") ? $nurseData->university_city : ""; ?></td>
                        </tr>

                        <tr>
                            <td>Slot</td>
                            <td><?php echo (isset($nurseData->slot) && $nurseData->slot != "") ? getKeyword($nurseData->slot) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Job title</td>
                            <td><?php echo (isset($nurseData->job_title) && $nurseData->job_title != "") ? getKeyword($nurseData->job_title) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Feedback</td>
                            <td><?php echo (isset($nurseData->feedback) && $nurseData->feedback != "") ? $nurseData->feedback : ""; ?></td>
                        </tr>
                        <tr> 
                            <td>Search Credentials</td>
                            <td><?php echo (isset($nurseData->search_cred) && $nurseData->search_cred != "") ? getKeyword($nurseData->search_cred) : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Expiration date</td>
                            <td><?php echo (isset($nurseData->expiration_date) && $nurseData->expiration_date != "") ? date('d-m-Y',strtotime($nurseData->expiration_date)) : ""; ?></td>
                        </tr>

                        <tr>
                            <td>Effective date</td>
                            <td><?php echo (isset($nurseData->effective_date) && $nurseData->effective_date != "") ? date('d-m-Y',strtotime($nurseData->effective_date)) : ""; ?></td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>