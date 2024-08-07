<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once APPPATH . '../vendor/autoload.php';
// Create a new Xlsx writer instance

class Firstpage extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("crud_model");
    }

	public function index()
	{
		    // Load pagination library
		$this->load->library('pagination');

			// Define pagination configuration
		$config['base_url'] = base_url('Firstpage/index');
		$config['total_rows'] = $this->crud_model->countEmployeeData();
		$config['per_page'] = 3; // Number of records per page
		$config['uri_segment'] = 3; // URI segment containing the page number
		
			// Initialize pagination
		$this->pagination->initialize($config);
		
		// Get page number from URI segment
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
			// Fetch employee data for the current page
		$data['Employee_details'] = $this->crud_model->getEmployeeDatapage($config['per_page'], $page);
		
			// Pass pagination links to the view
		$data['pagination_links'] = $this->pagination->create_links();

		// Get search query from the URL
		$search_query = $this->input->get('search');
	
		// Get filter options from the URL
		$filter_option = $this->input->get('filter');
	
		// Fetch employee data based on search query and filter option
		$data['Employee_details'] = $this->crud_model->getEmployeeData($search_query, $filter_option);
	
		// Load view with data
		$this->load->view('crud-view', $data);
	
	}

	public function exportDatasss()
{
	$this->load->model("crud_model");
    // Get search query from the URL
    $search_query = $this->input->get('search');

    // Get filter options from the URL
    $filter_option = $this->input->get('filter');

    // Fetch filtered employee data based on search query and filter option
    $filtered_data = $this->crud_model->getEmployeeData($search_query, $filter_option);

    // Load the Excel library
	$this->load->model('crud_model');
    // $this->load->library('PHPExcel');

    // Create a new Excel file
    $objPHPExcel = new PHPExcel();

    // Set the spreadsheet properties
    // For example, title, creator, etc.

    // Add the data to the Excel file
    $objPHPExcel->getActiveSheet()->fromArray($filtered_data);

    // Set headers for each column if needed
    // For example: $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
    $objPHPExcel->getActiveSheet()->setCellValue('A3', 'id');
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Employee name');
    $objPHPExcel->getActiveSheet()->setCellValue('C3', 'emp_role');
    $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Department');
    $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Mobile Number');
    $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Email ID');

    // Set the file format and name
    $filename = 'employee_data_' . date('YmdHis') . '.xlsx';

    // Save the Excel file to a directory on the server
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('C:\xampp\htdocs\crud\export' . $filename);

    // Download the Excel file to the user's browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $objWriter->save('C:\xampp\htdocs\crud\export');
}

public function exportData() {
	// Get search query from the URL
	$search_query = $this->input->get('search');

	// Get filter options from the URL
	$filter_option = $this->input->get('filter');

	// Fetch filtered employee data based on search query and filter option
	$filtered_data = $this->crud_model->getEmployeeData($search_query, $filter_option);

	// Create a new Excel spreadsheet
	$spreadsheet = new Spreadsheet();

	// Get the active sheet
	$sheet = $spreadsheet->getActiveSheet();

	// Add column headers
	$sheet->setCellValue('A1', 'ID');
	$sheet->setCellValue('B1', 'Employee name');
	$sheet->setCellValue('C1', 'Role');
	$sheet->setCellValue('D1', 'Department');
	$sheet->setCellValue('E1', 'Mobile Number');
	$sheet->setCellValue('F1', 'Email ID');
	$sheet->setCellValue('G1', 'Password');
	$sheet->setCellValue('H1', 'File');
	$sheet->setCellValue('I1', 'Image');

	// Add data from the filtered_data array to the spreadsheet
	$row = 2;
	foreach ($filtered_data as $data) {
		$sheet->setCellValue('A'.$row, $data->id);
		$sheet->setCellValue('B'.$row, $data->Emp_name);
		$sheet->setCellValue('C'.$row, $data->emp_role);
		$sheet->setCellValue('D'.$row, $data->Department);
		$sheet->setCellValue('E'.$row, $data->Mobile_Number);
		$sheet->setCellValue('F'.$row, $data->Email_Id);
		$sheet->setCellValue('G'.$row, $data->password);
		$sheet->setCellValue('H'.$row, $data->file);
		$sheet->setCellValue('I'.$row, $data->image);
		$row++;
	}

	// Set the file format and name
	$filename = 'employee_data_' . date('YmdHis') . '.xlsx';

	// Save the Excel file
	$writer = new Xlsx($spreadsheet);
	$writer->save('C:/xampp/htdocs/crud/export/' . $filename);

	// Download the Excel file to the user's browser
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . $filename . '"');
	header('Cache-Control: max-age=0');

	// Output the file to the browser
	$writer->save('php://output');
}


	public function addEmployee()

	{

	    $this->form_validation->set_rules('Emp_name', 'Employee Name', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|min_length[3]|max_length[30]');
	    $this->form_validation->set_rules('emp_role', 'Employee role', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|max_length[50]');
	    $this->form_validation->set_rules('Department', 'Department', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|max_length[50]');
	    $this->form_validation->set_rules('Mobile_Number', 'Mobile Number', 'trim|required|numeric|exact_length[10]');
	    $this->form_validation->set_rules('Email_Id', 'Email ID', 'trim|required|valid_email');

	    if ($this->form_validation->run() == false) {
	        $this->load->view('addemployee');
			
	    } else {
	        $data = array(
	            'Emp_name' => $this->input->post('Emp_name'),
	            'emp_role' => $this->input->post('emp_role'),
	            'Department' => $this->input->post('Department'),
	            'Mobile_Number' => $this->input->post('Mobile_Number'),
	            'Email_Id' => $this->input->post('Email_Id')
	        );

	        $result = $this->crud_model->insertEmpdata($data);

	        if ($result) {
	            $this->session->set_flashdata('inserted', 'Your data is successfully added.');
	        }
	        redirect('dashboard');
	    }
	}
	// updateEmployee method se humne pehle fetch kiya(get kiya) id jise updata karna hai.
		public function updateEmployee($id){
		$data['singleEmp'] = $this->crud_model->getsingleEmp($id);
		$this->load->view('update_view', $data);
		
	}
		// update method se humne ab fetch kiya(get kiya)  gaya id me data daal kar vaidation kar ke updata kiya hai.
		public function update($id){
		$this->form_validation->set_rules('password', 'Password', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|min_length[8]|max_length[12]');
	    $this->form_validation->set_rules('Emp_name', 'Employee Name', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|min_length[3]|max_length[30]');
	    $this->form_validation->set_rules('emp_role', 'Employee Role', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|max_length[50]');
	    $this->form_validation->set_rules('Department', 'Department', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|max_length[50]');
	    $this->load->library('form_validation');
	    if ($this->form_validation->run() == false) {
	        // Validation failed, show the form again with validation errors
	        $data['singleEmp'] = $this->crud_model->getSingleEmp($id); // Replace with your method to fetch a single employee data
	        $this->load->view('update_view', $data); 
			// Replace 'your_update_form_view' with the actual view file name
	    } 
	    else {
	        // Validation passed, process the form data and update the database
	        $result = $this->crud_model->updateEmpdata($id, [
	            'Emp_name' => $this->input->post('Emp_name'),
	            'emp_role' => $this->input->post('emp_role'),
	            'Department' => $this->input->post('Department'),
	            'password' => $this->input->post('password')
	        ]);
				
	        if ($result) {
	            $this->session->set_flashdata('updated', 'Employee data is successfully updated');
	            redirect('dashboard/'); // Redirect to the appropriate method
	        }
	    }
	}
		public function deleteEmployee($id)
		{
			$result = $this->crud_model->deleteitem($id);
			if($result == true){
				$this->crud_model->resetAutoIncrement(); // Reset auto-increment counter

				$this->session->set_flashdata('deleted', 'the employee data is deleted successfully!');

			}
		redirect('dashboard');
		}

		//method for uploading image /importing image into db and table---------process 
		public function uploadimage() {
			$config['upload_path'] = 'C:\xampp\htdocs\crud\application\upload\sanjeev';
			$config['allowed_types'] = 'jpg|jpeg|png'; // Add more allowed file types if needed
			$config['max_size'] = 5120; // 5MB limit
		
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				$data['error'] = $error;  // Corrected line
				$this->load->view('upload_error', $data); 
			} else {
				$data = array('upload_data' => $this->upload->data());
				// Save the image path or data in your database
				$this->crud_model->save_image_data($data['upload_data']['file_name']);
		
				// Set success message
				$success_message = 'Image uploaded successfully.';
				// Load the view with success message and uploaded file data
				$this->load->view('Firstpage', array('success_message' => $success_message, 'upload_data' => $data['upload_data']));
			}
		}
		
		

}

?>
